# FPX Payment Gateway Integration Documentation

## Overview
This document outlines the complete FPX (Financial Process Exchange) payment gateway integration process, requirements, and implementation details based on the JariahFund project implementation.

## Table of Contents
1. [FPX Overview](#fpx-overview)
2. [System Requirements](#system-requirements)
3. [PAYNET Integration](#paynet-integration)
4. [Transaction ID Generation](#transaction-id-generation)
5. [Database Models](#database-models)
6. [Integration Flow](#integration-flow)
7. [API Endpoints](#api-endpoints)
8. [Security Requirements](#security-requirements)
9. [Implementation Steps](#implementation-steps)
10. [Testing](#testing)
11. [Troubleshooting](#troubleshooting)

## FPX Overview

FPX (Financial Process Exchange) is Malaysia's national payment gateway that enables online payments through Malaysian banks. It allows customers to make payments using their online banking credentials.

### Key Features
- Real-time payment processing
- Support for all major Malaysian banks
- Secure authentication via bank credentials
- Automatic transaction status updates
- Digital receipt generation

## System Requirements

### Technical Requirements
- **Framework**: Django 3.0+
- **Python**: 3.7+
- **Database**: PostgreSQL/MySQL
- **Cryptography**: PyCrypto or Cryptodome for RSA signing
- **HTTP Library**: Requests for API calls

### FPX Account Requirements
- **Seller Exchange ID**: EX00010946 (example)
- **Seller ID**: SE00039889 (example)
- **RSA Private Key**: EX00010946.key
- **FPX Version**: 7.0
- **Currency**: MYR (Malaysian Ringgit)

### Dependencies
```python
# Required Python packages
pycryptodome==3.9.9
requests==2.25.1
django==3.0.6
crispy-forms==1.14.0
```

## PAYNET Integration

### Overview
PAYNET (Payment Network Malaysia Sdn Bhd) is Malaysia's national payment network infrastructure provider. While FPX is the primary payment gateway used in this project, understanding PAYNET integration provides context for enhanced payment capabilities and future expansion.

### PAYNET Services

#### 1. Core Payment Systems
- **FPX** (Financial Process Exchange) - Online banking payments
- **MEPS** (Malaysian Electronic Payment System) - Interbank transfers
- **DuitNow** - Real-time payments
- **JomPAY** - Bill payments
- **MyDebit** - Debit card payments

#### 2. PAYNET_MERCHANT_KEY

**Purpose**: Authentication key for accessing PAYNET merchant services and APIs.

**Key Characteristics**:
- **Format**: Alphanumeric string (typically 32-64 characters)
- **Scope**: Merchant-specific authentication
- **Usage**: API authentication, transaction signing, service access
- **Security**: Must be kept secure and rotated regularly

**Source**: **OBTAINED FROM PAYNET** - This key is provided by PAYNET when you register as a merchant.

**Configuration**:
```python
# settings.py
PAYNET_SETTINGS = {
    'MERCHANT_KEY': 'your-paynet-merchant-key-here',  # PROVIDED BY PAYNET
    'API_BASE_URL': 'https://api.paynet.com.my',      # PAYNET PROVIDED URL
    'ENVIRONMENT': 'production',  # or 'sandbox'
    'SERVICE_ENDPOINTS': {
        'fpx': '/api/v1/fpx',        # PAYNET PROVIDED ENDPOINTS
        'duitnow': '/api/v1/duitnow', # PAYNET PROVIDED ENDPOINTS
        'jompay': '/api/v1/jompay',   # PAYNET PROVIDED ENDPOINTS
        'meps': '/api/v1/meps'        # PAYNET PROVIDED ENDPOINTS
    }
}
```

#### 3. PAYNET Authentication Implementation

**Basic Authentication**:
```python
import requests
from django.conf import settings

def get_paynet_headers():
    """Generate headers for PAYNET API calls"""
    return {
        'Authorization': f'Bearer {settings.PAYNET_SETTINGS["MERCHANT_KEY"]}',
        'Content-Type': 'application/json',
        'X-Paynet-Environment': settings.PAYNET_SETTINGS['ENVIRONMENT'],
        'X-Paynet-Merchant-ID': settings.FPX_SETTINGS['SELLER_ID']
    }

def authenticate_paynet_request():
    """Authenticate with PAYNET services"""
    headers = get_paynet_headers()
    response = requests.get(
        f"{settings.PAYNET_SETTINGS['API_BASE_URL']}/auth/validate",
        headers=headers
    )
    return response.status_code == 200
```

**Enhanced FPX Integration with PAYNET**:
```python
def enhanced_fpx_payment_initiation(request, donation):
    """Enhanced FPX payment with PAYNET authentication"""
    
    # PAYNET authentication
    if not authenticate_paynet_request():
        raise Exception("PAYNET authentication failed")
    
    # Standard FPX parameters
    fpx_msgType = 'AR'
    fpx_msgToken = '01'
    fpx_sellerExId = settings.FPX_SETTINGS['SELLER_EX_ID']
    fpx_sellerExOrderNo = f'JF{donation.id}'
    
    # Add PAYNET headers
    paynet_headers = {
        'X-Paynet-Merchant-Key': settings.PAYNET_SETTINGS['MERCHANT_KEY'],
        'X-Paynet-Transaction-ID': fpx_sellerExOrderNo,
        'X-Paynet-Service': 'fpx'
    }
    
    # Generate checksum with PAYNET validation
    checksum_string = generate_fpx_checksum_string(donation)
    fpx_checkSum = generate_checksum(checksum_string, settings.FPX_SETTINGS['PRIVATE_KEY_PATH'])
    
    return {
        'fpx_data': {
            'fpx_msgType': fpx_msgType,
            'fpx_sellerExOrderNo': fpx_sellerExOrderNo,
            'fpx_checkSum': fpx_checkSum,
            # ... other FPX parameters
        },
        'paynet_headers': paynet_headers
    }
```

#### 4. PAYNET Service Integration

**DuitNow Integration** (Future Enhancement):
```python
def initiate_duitnow_payment(donation):
    """Initiate DuitNow payment using PAYNET API"""
    
    headers = get_paynet_headers()
    payload = {
        'merchant_id': settings.FPX_SETTINGS['SELLER_ID'],  # SYSTEM GENERATED
        'amount': str(donation.donation_amount),             # SYSTEM GENERATED
        'reference_id': donation.ref_num,                    # SYSTEM GENERATED
        'recipient_id': donation.campaign.ngo.duitnow_id,    # PROVIDED BY PAYNET
        'description': f'Donation to {donation.campaign.title}'  # SYSTEM GENERATED
    }
    
    response = requests.post(
        f"{settings.PAYNET_SETTINGS['API_BASE_URL']}/duitnow/payment",  # PAYNET PROVIDED URL
        headers=headers,
        json=payload
    )
    
    return response.json()  # PAYNET GENERATED RESPONSE
```

**JomPAY Integration** (Future Enhancement):
```python
def initiate_jompay_payment(donation):
    """Initiate JomPAY bill payment using PAYNET API"""
    
    headers = get_paynet_headers()
    payload = {
        'merchant_id': settings.FPX_SETTINGS['SELLER_ID'],  # SYSTEM GENERATED
        'bill_code': donation.campaign.jompay_bill_code,     # PROVIDED BY PAYNET
        'amount': str(donation.donation_amount),             # SYSTEM GENERATED
        'reference_id': donation.ref_num,                    # SYSTEM GENERATED
        'payer_name': donation.user.first_name,              # SYSTEM GENERATED
        'payer_email': donation.user.email                   # SYSTEM GENERATED
    }
    
    response = requests.post(
        f"{settings.PAYNET_SETTINGS['API_BASE_URL']}/jompay/payment",  # PAYNET PROVIDED URL
        headers=headers,
        json=payload
    )
    
    return response.json()  # PAYNET GENERATED RESPONSE
```

#### 5. PAYNET Transaction Monitoring

**Transaction Status Check**:
```python
def check_paynet_transaction_status(transaction_id):
    """Check transaction status across PAYNET services"""
    
    headers = get_paynet_headers()
    response = requests.get(
        f"{settings.PAYNET_SETTINGS['API_BASE_URL']}/transaction/{transaction_id}/status",
        headers=headers
    )
    
    if response.status_code == 200:
        return response.json()
    else:
        raise Exception(f"Failed to check transaction status: {response.status_code}")
```

**Transaction Reporting**:
```python
def get_paynet_transaction_report(start_date, end_date):
    """Get transaction report from PAYNET"""
    
    headers = get_paynet_headers()
    params = {
        'start_date': start_date.strftime('%Y-%m-%d'),
        'end_date': end_date.strftime('%Y-%m-%d'),
        'merchant_id': settings.FPX_SETTINGS['SELLER_ID']
    }
    
    response = requests.get(
        f"{settings.PAYNET_SETTINGS['API_BASE_URL']}/reports/transactions",
        headers=headers,
        params=params
    )
    
    return response.json()
```

#### 6. PAYNET Security Best Practices

**Key Management**:
```python
# Environment variable configuration
PAYNET_MERCHANT_KEY = os.environ.get('PAYNET_MERCHANT_KEY')

# Key rotation implementation
def rotate_paynet_key():
    """Rotate PAYNET merchant key"""
    new_key = generate_new_merchant_key()
    update_environment_variable('PAYNET_MERCHANT_KEY', new_key)
    notify_paynet_of_key_change(new_key)
```

**Security Validation**:
```python
def validate_paynet_request(request):
    """Validate incoming PAYNET requests"""
    
    # Verify request signature
    signature = request.headers.get('X-Paynet-Signature')
    if not verify_paynet_signature(request.body, signature):
        raise SecurityException("Invalid PAYNET signature")
    
    # Verify merchant key
    merchant_key = request.headers.get('X-Paynet-Merchant-Key')
    if merchant_key != settings.PAYNET_SETTINGS['MERCHANT_KEY']:
        raise SecurityException("Invalid merchant key")
    
    return True
```

#### 7. PAYNET Error Handling

**Error Response Structure**:
```python
def handle_paynet_error(response):
    """Handle PAYNET API errors"""
    
    error_codes = {
        'AUTH_FAILED': 'PAYNET authentication failed',
        'INVALID_MERCHANT': 'Invalid merchant key or ID',
        'SERVICE_UNAVAILABLE': 'PAYNET service temporarily unavailable',
        'TRANSACTION_FAILED': 'Transaction processing failed',
        'INVALID_AMOUNT': 'Invalid transaction amount',
        'DUPLICATE_TRANSACTION': 'Duplicate transaction detected'
    }
    
    if response.status_code != 200:
        error_data = response.json()
        error_code = error_data.get('error_code', 'UNKNOWN_ERROR')
        error_message = error_codes.get(error_code, 'Unknown PAYNET error')
        
        logger.error(f"PAYNET Error: {error_code} - {error_message}")
        raise PaynetException(error_message)
    
    return response.json()
```

#### 8. PAYNET Configuration Template

**Environment Variables**:
```bash
# PAYNET Configuration
PAYNET_MERCHANT_KEY=your-paynet-merchant-key-here
PAYNET_API_BASE_URL=https://api.paynet.com.my
PAYNET_ENVIRONMENT=production
PAYNET_SERVICE_ENDPOINTS={"fpx":"/api/v1/fpx","duitnow":"/api/v1/duitnow"}

# PAYNET Security
PAYNET_KEY_ROTATION_INTERVAL=90  # days
PAYNET_REQUEST_TIMEOUT=30  # seconds
PAYNET_MAX_RETRIES=3
```

**Django Settings Integration**:
```python
# settings.py
PAYNET_SETTINGS = {
    'MERCHANT_KEY': os.environ.get('PAYNET_MERCHANT_KEY'),
    'API_BASE_URL': os.environ.get('PAYNET_API_BASE_URL', 'https://api.paynet.com.my'),
    'ENVIRONMENT': os.environ.get('PAYNET_ENVIRONMENT', 'sandbox'),
    'REQUEST_TIMEOUT': int(os.environ.get('PAYNET_REQUEST_TIMEOUT', 30)),
    'MAX_RETRIES': int(os.environ.get('PAYNET_MAX_RETRIES', 3)),
    'KEY_ROTATION_INTERVAL': int(os.environ.get('PAYNET_KEY_ROTATION_INTERVAL', 90))
}
```

#### 9. PAYNET Integration Checklist

**Setup Requirements**:
- [ ] Register for PAYNET merchant account
- [ ] Obtain PAYNET_MERCHANT_KEY
- [ ] Configure PAYNET API endpoints
- [ ] Set up environment variables
- [ ] Implement authentication headers
- [ ] Add error handling
- [ ] Configure logging
- [ ] Test in sandbox environment

**Security Checklist**:
- [ ] Store PAYNET_MERCHANT_KEY in environment variables
- [ ] Implement key rotation policy
- [ ] Add request validation
- [ ] Configure SSL/TLS
- [ ] Set up audit logging
- [ ] Implement rate limiting
- [ ] Add monitoring and alerting

#### 10. Value Generation and Sources

**SYSTEM GENERATED VALUES** (Generated by your application):
```python
# Transaction IDs and References
donation.ref_num = f'JF{get_random_string(18)}'           # Internal reference number
fpx_sellerExOrderNo = f'JF{donation.id}'                  # FPX order number
fpx_sellerTxnTime = now.strftime("%Y%m%d%H%M%S")         # Transaction timestamp

# User and Transaction Data
donation.donation_amount                                    # Donation amount
donation.user.email                                         # User email
donation.user.first_name                                    # User name
donation.campaign.title                                     # Campaign title

# Checksums and Signatures
fpx_checkSum = generate_checksum(checksum_string, key)     # RSA signature
```

**PAYNET PROVIDED VALUES** (Obtained from PAYNET):
```python
# Authentication and Configuration
PAYNET_MERCHANT_KEY                                        # Merchant authentication key
PAYNET_API_BASE_URL                                        # API base URL
PAYNET_SERVICE_ENDPOINTS                                   # Service endpoints

# Service-Specific IDs
donation.campaign.ngo.duitnow_id                           # DuitNow recipient ID
donation.campaign.jompay_bill_code                         # JomPAY bill code

# Transaction Responses
response.fpx_fpxTxnId                                      # FPX transaction ID
response.fpx_debitAuthCode                                 # Authorization code
response.fpx_creditAuthCode                                # Credit authorization code
response.fpx_fpxTxnTime                                    # FPX transaction time
```

**PAYNET GENERATED RESPONSES** (Returned by PAYNET APIs):
```python
# Transaction Status
{
    'transaction_id': 'PAYNET_TXN_123456',                 # PAYNET generated
    'status': 'SUCCESS',                                    # PAYNET generated
    'authorization_code': 'AUTH123',                       # PAYNET generated
    'settlement_date': '2023-12-01',                       # PAYNET generated
    'processing_fee': '2.50',                              # PAYNET generated
    'net_amount': '97.50'                                  # PAYNET generated
}

# Error Responses
{
    'error_code': 'AUTH_FAILED',                           # PAYNET generated
    'error_message': 'Invalid merchant key',                # PAYNET generated
    'error_timestamp': '2023-12-01T14:30:22Z'             # PAYNET generated
}
```

**Implementation Flow**:
```python
def complete_payment_flow(donation):
    """Complete payment flow showing value sources"""
    
    # STEP 1: SYSTEM GENERATES VALUES
    donation.ref_num = f'JF{get_random_string(18)}'        # System generated
    fpx_sellerExOrderNo = f'JF{donation.id}'               # System generated
    fpx_sellerTxnTime = timezone.now().strftime("%Y%m%d%H%M%S")  # System generated
    
    # STEP 2: SYSTEM USES PAYNET PROVIDED VALUES
    headers = {
        'Authorization': f'Bearer {settings.PAYNET_SETTINGS["MERCHANT_KEY"]}',  # PAYNET provided
        'X-Paynet-Service': 'fpx'                          # PAYNET provided endpoint
    }
    
    # STEP 3: SYSTEM SENDS REQUEST TO PAYNET
    payload = {
        'merchant_id': settings.FPX_SETTINGS['SELLER_ID'],  # System generated
        'amount': str(donation.donation_amount),             # System generated
        'reference_id': donation.ref_num,                    # System generated
        'recipient_id': donation.campaign.ngo.duitnow_id,   # PAYNET provided
    }
    
    # STEP 4: PAYNET GENERATES RESPONSE
    response = requests.post(
        f"{settings.PAYNET_SETTINGS['API_BASE_URL']}/payment",  # PAYNET provided URL
        headers=headers,
        json=payload
    )
    
    # STEP 5: SYSTEM PROCESSES PAYNET RESPONSE
    paynet_response = response.json()                       # PAYNET generated
    donation.fpx_fpxTxnId = paynet_response['transaction_id']  # PAYNET generated
    donation.paid = paynet_response['status'] == 'SUCCESS'     # System processed
    
    return donation
```

## Transaction ID Generation

### Overview
The FPX integration uses multiple transaction IDs for different purposes to ensure proper tracking and audit trails throughout the payment process.

### 1. Internal Reference Number (ref_num)

**Purpose**: Internal system reference for tracking donations within the application.

**Generation Method**:
```python
import random

def get_random_string(length):
    result_str = ''.join(str(random.randint(0, 9)) for i in range(length))
    return result_str

# Usage in donation creation:
donation.ref_num = f'JF{get_random_string(18)}'
```

**Format**: `JF` + 18 random digits
**Example**: `JF123456789012345678`
**Length**: 20 characters total (2 prefix + 18 digits)
**Uniqueness**: Generated using random number generation to ensure uniqueness

**Database Field**:
```python
ref_num = models.CharField(max_length=40, blank=True, default="")
```

### 2. FPX Transaction ID (fpx_fpxTxnId)

**Purpose**: External transaction identifier for FPX payment gateway communication.

**Generation Method**:
```python
# During payment initiation (AR message)
fpx_sellerExOrderNo = f'JF{donation_id_str}'

# After payment completion (AC message)
donation.fpx_fpxTxnId = fpx.fpx_fpxTxnId
```

**Format**: 
- **Seller Exchange Order No**: `JF` + donation database ID
- **FPX Transaction ID**: Assigned by FPX gateway (16 characters)

**Examples**:
- Seller Exchange Order: `JF123` (where 123 is donation ID)
- FPX Transaction ID: `FPX20231201143022` (assigned by FPX)

**Database Field**:
```python
fpx_fpxTxnId = models.CharField(max_length=16, blank=True)
```

### 3. Transaction Timestamp

**Purpose**: Timestamp for transaction tracking and audit purposes.

**Generation Method**:
```python
from django.utils import timezone

now = timezone.now()
fpx_sellerTxnTime = now.strftime("%Y%m%d%H%M%S")
```

**Format**: `YYYYMMDDHHMMSS`
**Example**: `20231201143022` (December 1, 2023, 14:30:22)

### 4. Complete Transaction ID Flow

```python
# Step 1: Donation Creation
donation = Donation.objects.create(
    user=request.user,
    campaign=campaign,
    donation_amount=amount
)
donation.ref_num = f'JF{get_random_string(18)}'
donation.save()

# Step 2: Payment Initiation (AR Message)
fpx_sellerExOrderNo = f'JF{donation.id}'
fpx_sellerTxnTime = timezone.now().strftime("%Y%m%d%H%M%S")

# Step 3: Payment Response (AC Message)
donation.fpx_fpxTxnId = fpx.fpx_fpxTxnId
donation.save()
```

### 5. Transaction ID Validation

**Internal Reference Validation**:
```python
def validate_ref_num(ref_num):
    if not ref_num.startswith('JF'):
        return False
    if len(ref_num) != 20:
        return False
    if not ref_num[2:].isdigit():
        return False
    return True
```

**FPX Transaction ID Validation**:
```python
def validate_fpx_txn_id(fpx_txn_id):
    if len(fpx_txn_id) != 16:
        return False
    return True
```

### 6. Transaction ID Usage in FPX Messages

**AR (Authorization Request) Message**:
```python
fpx_sellerExOrderNo = f'JF{donation_id}'  # Internal reference
fpx_sellerOrderNo = donation.ref_num       # Internal reference number
fpx_sellerTxnTime = now.strftime("%Y%m%d%H%M%S")  # Timestamp
```

**AC (Acknowledgement) Message**:
```python
# Received from FPX
fpx_fpxTxnId = response.fpx_fpxTxnId  # FPX-assigned transaction ID
fpx_sellerExOrderNo = response.fpx_sellerExOrderNo  # Original order number
```

### 7. Transaction ID Security Considerations

1. **Uniqueness**: All transaction IDs must be unique within their scope
2. **Traceability**: Internal IDs must be traceable to external FPX IDs
3. **Audit Trail**: All transaction IDs are stored for audit purposes
4. **Validation**: All incoming transaction IDs must be validated
5. **Encryption**: Transaction data is encrypted during transmission

### 8. Transaction ID Best Practices

1. **Prefix Usage**: Use consistent prefixes (e.g., 'JF' for JariahFund)
2. **Length Consistency**: Maintain consistent ID lengths for database efficiency
3. **Error Handling**: Implement proper error handling for ID generation failures
4. **Logging**: Log all transaction ID generation and usage for debugging
5. **Backup**: Ensure transaction IDs are backed up with transaction data

## Database Models

### 1. FPX_Bank Model
```python
class FPX_Bank(models.Model):
    Bank_ID = models.CharField(max_length=10, verbose_name='Bank ID')
    Bank_Name = models.CharField(max_length=100, verbose_name='Bank Name')
    Display_Name = models.CharField(max_length=100, verbose_name='Display Name')
    Bank_Status = models.BooleanField(default=True, verbose_name='Bank Status')
    
    def display(self):
        if self.Bank_Status:
            return self.Display_Name
        else:
            return f'{self.Display_Name} (Offline)'
```

### 2. AC (Acknowledgement) Model
```python
class AC(models.Model):
    fpx_msgType = models.CharField(max_length=2, blank=True)
    fpx_msgToken = models.CharField(max_length=2, blank=True)
    fpx_fpxTxnId = models.CharField(max_length=16, blank=True)
    fpx_sellerExId = models.CharField(max_length=10, blank=True)
    fpx_sellerExOrderNo = models.CharField(max_length=40, blank=True)
    fpx_fpxTxnTime = models.CharField(max_length=14, blank=True)
    fpx_sellerTxnTime = models.CharField(max_length=14, blank=True)
    fpx_sellerOrderNo = models.CharField(max_length=40, blank=True)
    fpx_sellerId = models.CharField(max_length=10, blank=True)
    fpx_txnCurrency = models.CharField(max_length=3, blank=True)
    fpx_txnAmount = models.CharField(max_length=16, blank=True)
    fpx_checkSum = models.CharField(max_length=512, blank=True)
    fpx_buyerName = models.CharField(max_length=40, blank=True)
    fpx_buyerBankId = models.CharField(max_length=20, blank=True)
    fpx_buyerBankBranch = models.CharField(max_length=10, blank=True)
    fpx_buyerId = models.CharField(max_length=20, blank=True)
    fpx_makerName = models.CharField(max_length=100, blank=True)
    fpx_buyerIban = models.CharField(max_length=35, blank=True)
    fpx_debitAuthCode = models.CharField(max_length=2, blank=True)
    fpx_debitAuthNo = models.CharField(max_length=10, blank=True)
    fpx_creditAuthCode = models.CharField(max_length=2, blank=True)
    fpx_creditAuthNo = models.CharField(max_length=10, blank=True)
    fpx_xtraInfo = models.CharField(max_length=6, blank=True)
```

### 3. Transaction Model (Donation in this case)
```python
class Donation(models.Model):
    # ... other fields ...
    bank = models.ForeignKey("FPX.FPX_Bank", on_delete=models.CASCADE, null=True)
    paid = models.BooleanField(default=False, verbose_name='Payment Approved')
    fpx_fpxTxnId = models.CharField(max_length=16, blank=True)
    ref_num = models.CharField(max_length=40, blank=True, default="")
```

## Integration Flow

### 1. Bank Selection Flow
```
User → Select Bank → Validate Bank Status → Proceed to Payment
```

### 2. Payment Initiation Flow (AR Message)
```
1. User selects bank and clicks "Proceed"
2. System generates AR (Authorization Request) message
3. Create checksum using RSA private key
4. Submit form to FPX gateway
5. User redirected to bank's login page
```

### 3. Payment Response Flow (AC Message)
```
1. User completes payment at bank
2. Bank sends AC (Acknowledgement) to callback URL
3. System validates AC message
4. Update transaction status
5. Generate receipt
6. Send confirmation email
```

### 4. Bank List Update Flow (BE Message)
```
1. System generates BE (Bank Enquiry) message
2. Request bank list from FPX
3. Update bank status in database
4. Disable offline banks in UI
```

## API Endpoints

### 1. FPX Gateway URLs
- **Production**: `https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp`
- **Bank List**: `https://www.mepsfpx.com.my/FPXMain/RetrieveBankList`

### 2. Application URLs
```python
urlpatterns = [
    path('', FPXView, name="merchant"),           # Bank selection page
    path('status', StatusChange, name="status"),   # Payment initiation
    path('receipt', ReceiptView, name="receipt"),  # Payment receipt
    path('direct', ACResponseDirect, name="direct"), # Direct AC response
    path('indirect', ACResponse, name="indirect"),   # Indirect AC response
    path('bank', BE_request, name='bank_list'),      # Bank list update
]
```

## Security Requirements

### 1. RSA Key Management
- **Private Key**: Must be securely stored (EX00010946.key)
- **Key Format**: RSA private key in PEM format
- **Key Size**: Minimum 2048 bits recommended

### 2. Checksum Generation
```python
import binascii
from Crypto.PublicKey import RSA
from Crypto.Signature.pkcs1_15 import PKCS115_SigScheme
from Crypto.Hash import SHA

def generate_checksum(checksum_string, private_key_path):
    key = RSA.import_key(open(private_key_path).read())
    msg = bytes(checksum_string, 'utf8')
    hash = SHA.new(msg)
    signer = PKCS115_SigScheme(key)
    signature = signer.sign(hash)
    return binascii.hexlify(signature).decode('utf-8')
```

### 3. Message Validation
- Validate all incoming AC messages
- Verify checksum integrity
- Check transaction amounts match
- Validate bank response codes

## Implementation Steps

### Step 1: Setup FPX Models
```python
# Create FPX app
python manage.py startapp FPX

# Add to INSTALLED_APPS
INSTALLED_APPS = [
    # ... other apps
    'FPX',
]

# Run migrations
python manage.py makemigrations FPX
python manage.py migrate
```

### Step 2: Configure FPX Settings
```python
# settings.py
FPX_SETTINGS = {
    'SELLER_EX_ID': 'EX00010946',
    'SELLER_ID': 'SE00039889',
    'SELLER_BANK_CODE': '01',
    'PRIVATE_KEY_PATH': 'path/to/EX00010946.key',
    'FPX_VERSION': '7.0',
    'CURRENCY': 'MYR',
    'GATEWAY_URL': 'https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp',
    'BANK_LIST_URL': 'https://www.mepsfpx.com.my/FPXMain/RetrieveBankList',
}
```

### Step 3: Implement Bank Selection View
```python
def FPXView(request):
    if 'transaction_id' not in request.session:
        return redirect('/')
    
    transaction_id = request.session['transaction_id']
    transaction = get_object_or_404(Transaction, id=transaction_id)
    
    if request.method == 'POST':
        form = SelectBankForms(request.POST, instance=transaction)
        if form.is_valid():
            form.save()
            return redirect('status')
    else:
        form = SelectBankForms(instance=transaction)
    
    context = {
        'transaction_amount': transaction.amount,
        'transaction_ref_num': transaction.ref_num,
        'form': form,
    }
    return render(request, 'FPX/check_out_page.html', context)
```

### Step 4: Implement Payment Initiation
```python
@csrf_exempt
def StatusChange(request):
    if 'transaction_id' not in request.session:
        return redirect('/')
    
    transaction_id = request.session['transaction_id']
    transaction = get_object_or_404(Transaction, id=transaction_id)
    
    # Generate FPX parameters
    now = timezone.now()
    fpx_msgType = 'AR'
    fpx_msgToken = '01'
    fpx_sellerExId = settings.FPX_SETTINGS['SELLER_EX_ID']
    fpx_sellerExOrderNo = f'JF{transaction_id}'
    fpx_sellerTxnTime = now.strftime("%Y%m%d%H%M%S")
    fpx_sellerOrderNo = transaction.ref_num
    fpx_sellerId = settings.FPX_SETTINGS['SELLER_ID']
    fpx_sellerBankCode = settings.FPX_SETTINGS['SELLER_BANK_CODE']
    fpx_txnCurrency = settings.FPX_SETTINGS['CURRENCY']
    fpx_txnAmount = transaction.amount
    fpx_buyerEmail = transaction.user.email
    fpx_buyerBankId = transaction.bank.Bank_ID
    
    # Generate checksum
    checksum_string = fpx_buyerAccNo + '|' + fpx_buyerBankBranch + '|' + fpx_buyerBankId + '|' + fpx_buyerEmail + '|' + fpx_buyerIban + '|' + fpx_buyerId + '|' + fpx_buyerName + '|' + fpx_makerName + '|' + fpx_msgToken + '|' + fpx_msgType + '|' + fpx_productDesc + '|' + fpx_sellerBankCode + '|' + fpx_sellerExId + '|' + fpx_sellerExOrderNo + '|' + fpx_sellerId + '|' + fpx_sellerOrderNo + '|' + fpx_sellerTxnTime + '|' + str(fpx_txnAmount) + '|' + fpx_txnCurrency + '|' + fpx_version
    
    fpx_checkSum = generate_checksum(checksum_string, settings.FPX_SETTINGS['PRIVATE_KEY_PATH'])
    
    data = {
        'url': settings.FPX_SETTINGS['GATEWAY_URL'],
        'fpx_msgType': fpx_msgType,
        'fpx_msgToken': fpx_msgToken,
        'fpx_sellerExId': fpx_sellerExId,
        'fpx_sellerExOrderNo': fpx_sellerExOrderNo,
        'fpx_sellerTxnTime': fpx_sellerTxnTime,
        'fpx_sellerOrderNo': fpx_sellerOrderNo,
        'fpx_sellerId': fpx_sellerId,
        'fpx_sellerBankCode': fpx_sellerBankCode,
        'fpx_txnCurrency': fpx_txnCurrency,
        'fpx_txnAmount': fpx_txnAmount,
        'fpx_buyerEmail': fpx_buyerEmail,
        'fpx_checkSum': fpx_checkSum,
        'fpx_buyerName': fpx_buyerName,
        'fpx_buyerBankId': fpx_buyerBankId,
        'fpx_buyerBankBranch': fpx_buyerBankBranch,
        'fpx_buyerAccNo': fpx_buyerAccNo,
        'fpx_buyerId': fpx_buyerId,
        'fpx_makerName': fpx_makerName,
        'fpx_buyerIban': fpx_buyerIban,
        'fpx_productDesc': fpx_productDesc,
        'fpx_version': fpx_version,
        'fpx_eaccountNum': fpx_eaccountNum,
        'fpx_ebuyerID': fpx_ebuyerID
    }
    
    return render(request, 'FPX/status.html', data)
```

### Step 5: Implement AC Response Handler
```python
@csrf_exempt
def ACResponse(request):
    if request.method == 'POST':
        form = ACForm(request.POST)
        if form.is_valid():
            fpx = form.save(commit=False)
            
            # Extract transaction ID from seller order number
            transaction_id = fpx.fpx_sellerExOrderNo[2:]  # Remove 'JF' prefix
            transaction = Transaction.objects.filter(id=transaction_id)
            
            # Update transaction with FPX transaction ID
            transaction.update(fpx_fpxTxnId=fpx.fpx_fpxTxnId)
            
            # Check payment status
            if fpx.fpx_debitAuthCode == '00':
                transaction.update(paid=True)
                # Send confirmation email
                send_payment_confirmation_email(transaction)
            
            fpx.save()
            return redirect('receipt')
    
    return render(request, 'FPX/AC_responds.html', {'form': form})
```

### Step 6: Implement Bank List Update
```python
def update_bank_list():
    fpx_msgType = 'BE'
    fpx_msgToken = '01'
    fpx_sellerExId = settings.FPX_SETTINGS['SELLER_EX_ID']
    fpx_version = settings.FPX_SETTINGS['FPX_VERSION']
    
    checksum_string = fpx_msgToken + '|' + fpx_msgType + '|' + fpx_sellerExId + '|' + fpx_version
    fpx_checkSum = generate_checksum(checksum_string, settings.FPX_SETTINGS['PRIVATE_KEY_PATH'])
    
    url = settings.FPX_SETTINGS['BANK_LIST_URL']
    data = {
        'fpx_msgType': fpx_msgType,
        'fpx_msgToken': fpx_msgToken,
        'fpx_sellerExId': fpx_sellerExId,
        'fpx_version': fpx_version,
        'fpx_checkSum': fpx_checkSum,
    }
    
    response = requests.post(url, data)
    bank_list_response = response.text
    
    # Parse bank list response
    d = dict(x.split("=") for x in bank_list_response.split("&"))
    bank_list_str = d['fpx_bankList']
    bank_status = dict(x.split("%7E") for x in bank_list_str.split("%2C"))
    
    # Update bank status in database
    for bank_id, status in bank_status.items():
        fpx_bank = FPX_Bank.objects.filter(Bank_ID=bank_id)
        if status == 'A':
            fpx_bank.update(Bank_Status=True)
        elif status == 'B':
            fpx_bank.update(Bank_Status=False)
```

## Templates

### 1. Bank Selection Page (check_out_page.html)
```html
<!DOCTYPE html>
<html>
<head>
    <title>FPX Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <section>
        <div>
            <h3>Pay with <img src="{% static 'img/FPX_Logo.png'%}" width="90px"></h3>
        </div>
        <div>
            <h4>Total : RM{{transaction_amount}}</h4>
            <h4>Reference No: {{transaction_ref_num}}</h4>
        </div>
        <div>
            <form method="post" id="select_bank">
                {% csrf_token %}
                {{ form|crispy }}
                <div>
                    <h5>By clicking "Proceed", you agree to <a href="https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp" target="_blank">FPX Terms & Conditions</a></h5>
                </div>
                <div>
                    <button type="submit">Proceed</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        // Disable offline banks
        var options = document.forms['select_bank']['bank'].options;
        for (var i = 0; i < options.length; i++) {
            if (options[i].text.includes('Offline')) {
                options[i].disabled = true;
            }
        }
    </script>
</body>
</html>
```

### 2. Payment Redirect Page (status.html)
```html
<!DOCTYPE html>
<html>
<head></head>
<body onload="document.forms['fpx'].submit()">
    <form method="post" action="{{url}}" name="fpx">
        <input type="hidden" name="fpx_msgType" value="{{fpx_msgType}}">
        <input type="hidden" name="fpx_msgToken" value="{{fpx_msgToken}}">
        <input type="hidden" name="fpx_sellerExId" value="{{fpx_sellerExId}}">
        <input type="hidden" name="fpx_sellerExOrderNo" value="{{fpx_sellerExOrderNo}}">
        <input type="hidden" name="fpx_sellerTxnTime" value="{{fpx_sellerTxnTime}}">
        <input type="hidden" name="fpx_sellerOrderNo" value="{{fpx_sellerOrderNo}}">
        <input type="hidden" name="fpx_sellerId" value="{{fpx_sellerId}}">
        <input type="hidden" name="fpx_sellerBankCode" value="{{fpx_sellerBankCode}}">
        <input type="hidden" name="fpx_txnCurrency" value="{{fpx_txnCurrency}}">
        <input type="hidden" name="fpx_txnAmount" value="{{fpx_txnAmount}}">
        <input type="hidden" name="fpx_buyerEmail" value="{{fpx_buyerEmail}}">
        <input type="hidden" name="fpx_checkSum" value="{{fpx_checkSum}}">
        <input type="hidden" name="fpx_buyerName" value="{{fpx_buyerName}}">
        <input type="hidden" name="fpx_buyerBankId" value="{{fpx_buyerBankId}}">
        <input type="hidden" name="fpx_buyerBankBranch" value="{{fpx_buyerBankBranch}}">
        <input type="hidden" name="fpx_buyerAccNo" value="{{fpx_buyerAccNo}}">
        <input type="hidden" name="fpx_buyerId" value="{{fpx_buyerId}}">
        <input type="hidden" name="fpx_makerName" value="{{fpx_makerName}}">
        <input type="hidden" name="fpx_buyerIban" value="{{fpx_buyerIban}}">
        <input type="hidden" name="fpx_productDesc" value="{{fpx_productDesc}}">
        <input type="hidden" name="fpx_version" value="{{fpx_version}}">
        <input type="hidden" name="fpx_eaccountNum" value="{{fpx_eaccountNum}}">
        <input type="hidden" name="fpx_ebuyerID" value="{{fpx_ebuyerID}}">
    </form>
</body>
</html>
```

### 3. Receipt Page (receipt.html)
```html
<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <section>
        <div>
            <h3>Pay with <img src="{% static 'img/FPX_Logo.png'%}" width="90px"></h3>
        </div>
        <div>
            {% if transaction.paid %}
            <div><i class="material-icons" style="color: green;">check_circle</i>
                <h3>Payment Successful</h3>
            </div>
            {% else %}
            <div><i class="material-icons" style="color: red;">cancel</i>
                <h3>Payment Unsuccessful</h3>
            </div>
            {% endif %}
        </div>
        <div>
            <table class="table table-bordered">
                <tbody>
                    <tr><td>Date & Time</td><td>{{ fpx_time }}</td></tr>
                    <tr><td>Transaction Amount</td><td>RM {{ transaction.amount }}</td></tr>
                    <tr><td>Reference No.</td><td>{{ transaction.ref_num }}</td></tr>
                    <tr><td>FPX Transaction ID</td><td>{{ transaction.fpx_fpxTxnId }}</td></tr>
                    <tr><td>Bank Name</td><td>{{transaction.bank}}</td></tr>
                </tbody>
            </table>
        </div>
        <div>
            <a href="/" class="btn btn-primary">Home</a>
            <button onclick="window.print()" class="btn btn-secondary">Print</button>
        </div>
    </section>
</body>
</html>
```

## Testing

### 1. Test Environment Setup
- Use FPX test credentials
- Test with FPX simulator banks
- Verify all message types (AR, AC, BE)

### 2. Test Cases
- Bank selection with valid bank
- Bank selection with offline bank
- Payment initiation with valid data
- Payment response handling
- Error handling for invalid responses
- Bank list update functionality

### 3. Test Data
```python
# Test transaction data
test_transaction = {
    'amount': '100.00',
    'ref_num': 'TEST123456789',
    'user_email': 'test@example.com',
    'bank_id': 'TEST0022'
}
```

## Troubleshooting

### Common Issues

1. **Checksum Generation Error**
   - Verify private key format
   - Check checksum string format
   - Ensure all required fields are included

2. **Bank List Not Updating**
   - Check FPX credentials
   - Verify network connectivity
   - Check response parsing logic

3. **Payment Not Processing**
   - Verify FPX account status
   - Check transaction parameters
   - Validate callback URL configuration

4. **AC Response Not Received**
   - Check callback URL accessibility
   - Verify CSRF exemption
   - Check server logs for errors

### Debug Tools
```python
# Enable debug logging
import logging
logging.basicConfig(level=logging.DEBUG)

# Log FPX requests
def log_fpx_request(data):
    logger = logging.getLogger('fpx')
    logger.info(f"FPX Request: {data}")
```

## Security Best Practices

1. **Key Management**
   - Store private keys securely
   - Use environment variables for sensitive data
   - Regular key rotation

2. **Input Validation**
   - Validate all incoming data
   - Sanitize user inputs
   - Check transaction amounts

3. **Error Handling**
   - Log all errors securely
   - Don't expose sensitive information
   - Implement proper exception handling

4. **Network Security**
   - Use HTTPS for all communications
   - Validate SSL certificates
   - Implement request timeouts

## Production Checklist

- [ ] FPX account activated
- [ ] RSA private key configured
- [ ] Callback URLs registered
- [ ] Bank list populated
- [ ] Error handling implemented
- [ ] Logging configured
- [ ] SSL certificates installed
- [ ] Load testing completed
- [ ] Security audit performed
- [ ] Documentation updated

## Support Resources

- **FPX Documentation**: https://www.mepsfpx.com.my/
- **FPX Support**: Contact FPX technical support
- **Bank Integration**: Contact individual banks for specific requirements

---

*This documentation is based on the JariahFund project implementation and should be adapted according to your specific project requirements.* 