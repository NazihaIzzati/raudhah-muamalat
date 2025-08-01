# AE (Acknowledgement Enquiry) Message Implementation

## 📋 **Overview**

The **AE (Acknowledgement Enquiry)** message type has been implemented to provide manual transaction status checking capabilities for the Paynet FPX integration. This completes the full set of 4 FPX message types.

## 🎯 **Purpose**

- **Manual Transaction Status Query**: Query transaction status when callback fails or is delayed
- **Reconciliation**: Verify transaction status for reconciliation purposes
- **Debugging**: Troubleshoot payment issues by checking transaction status directly
- **Backup Mechanism**: Alternative to callback-based status updates

## 📊 **Implementation Details**

### **Message Type: AE (Acknowledgement Enquiry)**
- **Direction**: Merchant → Paynet
- **Purpose**: Query transaction status manually
- **Parameters**: 25 FPX parameters (same as AR message)
- **Response**: AC message format with transaction status

### **File Locations**

| Component | File Location | Purpose |
|-----------|---------------|---------|
| **Service Method** | `app/Services/PaynetService.php` | Core AE message implementation |
| **Controller Method** | `app/Http/Controllers/PaymentController.php` | HTTP endpoint for AE requests |
| **Route** | `routes/web.php` | Web route for AE enquiries |
| **Test Command** | `app/Console/Commands/TestAeMessage.php` | Testing and debugging |

## 🔧 **Technical Implementation**

### **1. Service Method: `sendAcknowledgementEnquiryMessage()`**

```php
public function sendAcknowledgementEnquiryMessage($transactionId, $donationId = null)
```

**Features:**
- Retrieves transaction details from database
- Constructs 25-parameter AE payload
- Generates RSA signature using same algorithm as AR message
- Sends POST request to FPX status enquiry URL
- Parses and returns structured response

**Parameters:**
- `$transactionId`: Transaction ID to query
- `$donationId`: Optional donation ID (auto-detected if not provided)

### **2. Controller Method: `handleAcknowledgementEnquiry()`**

```php
public function handleAcknowledgementEnquiry(Request $request)
```

**Features:**
- Validates incoming request
- Calls PaynetService AE method
- Returns JSON response with transaction status
- Comprehensive error handling and logging

**Route:** `POST /payment/ae-enquiry`

**Request Format:**
```json
{
    "transaction_id": "TXN123456789"
}
```

**Response Format:**
```json
{
    "success": true,
    "message": "Transaction status queried successfully",
    "transaction_id": "TXN123456789",
    "data": {
        "success": true,
        "transaction_id": "TXN123456789",
        "response_code": "00",
        "fpx_transaction_id": "FPX987654321",
        "response_description": "Approved",
        "raw_response": {
            "fpx_msgType": "AC",
            "fpx_debitAuthCode": "00",
            "fpx_fpxTxnId": "FPX987654321"
        }
    }
}
```

### **3. Response Parser: `parseAcknowledgementEnquiryResponse()`**

```php
private function parseAcknowledgementEnquiryResponse($response, $transactionId)
```

**Features:**
- Parses FPX response format (`key=value&key=value`)
- Extracts key transaction information
- Determines success based on response codes
- Returns structured data for easy processing

## 📋 **AE Message Parameters**

The AE message uses the same 25 parameters as the AR message:

| Parameter | Value | Description |
|-----------|-------|-------------|
| `fpx_msgType` | `AE` | Acknowledgement Enquiry |
| `fpx_msgToken` | `01` | Message token |
| `fpx_sellerExId` | Merchant ID | Seller exchange ID |
| `fpx_sellerExOrderNo` | `JF{donation_id}` | Seller exchange order number |
| `fpx_sellerTxnTime` | `YYYYMMDDHHMMSS` | Seller transaction time |
| `fpx_sellerOrderNo` | Transaction ID | Seller order number |
| `fpx_sellerId` | Merchant ID | Seller ID |
| `fpx_sellerBankCode` | `01` | Seller bank code |
| `fpx_txnCurrency` | `MYR` | Transaction currency |
| `fpx_txnAmount` | Amount | Transaction amount |
| `fpx_buyerEmail` | Email | Buyer email |
| `fpx_buyerBankId` | Bank ID | Buyer bank ID |
| `fpx_productDesc` | Description | Product description |
| `fpx_version` | `7.0` | FPX version |
| `fpx_buyerName` | Name | Buyer name |
| `fpx_buyerID` | Email | Buyer ID |
| `fpx_buyerBankBranch` | Branch | Buyer bank branch |
| `fpx_buyerIBAN` | IBAN | Buyer IBAN |
| `fpx_makerName` | Name | Maker name |
| `fpx_buyerAccNo` | Account | Buyer account number |
| `fpx_sellerOrdNo` | Order No | Seller order number |
| `fpx_sellerFPXBank` | `01` | Seller FPX bank |
| `fpx_sellerID` | Merchant ID | Seller ID |
| `fpx_OrdNo` | Order No | Order number |
| `fpx_sellerTxnTime` | Time | Seller transaction time |
| `fpx_checkSum` | Signature | RSA signature |

## 🔐 **Security Features**

### **RSA Signature Generation**
- Uses same algorithm as AR message
- 20-parameter checksum string in specific order
- RSA-SHA1 signature with merchant private key
- Secure communication with FPX gateway

### **Input Validation**
- Transaction ID validation
- Database record verification
- Request parameter sanitization
- Comprehensive error handling

### **Logging**
- Detailed request/response logging
- Error tracking and debugging
- Audit trail for compliance
- Performance monitoring

## 🧪 **Testing**

### **Command Line Testing**
```bash
# Test with latest transaction
php artisan test:ae-message

# Test with specific transaction
php artisan test:ae-message TXN123456789
```

### **HTTP API Testing**
```bash
# Test via HTTP endpoint
curl -X POST http://localhost:8080/payment/ae-enquiry \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: {token}" \
  -d '{"transaction_id": "TXN123456789"}'
```

### **Expected Test Output**
```
🧪 Testing AE (Acknowledgement Enquiry) Message Implementation
========================================================
📋 Using latest transaction: TXN123456789
✅ Transaction found: TXN123456789
💰 Amount: RM 100.00
📅 Created: 2025-01-15 10:30:00
📊 Status: pending

🚀 Sending AE message to FPX...
✅ AE message sent successfully!

📊 Response Details:
   Transaction ID: TXN123456789
   Success: Yes
   Response Code: 00
   FPX Transaction ID: FPX987654321
   Description: Approved

✅ AE message test completed successfully!
```

## 🔄 **Integration with Existing System**

### **Complete FPX Message Flow**
1. **AR Message**: Initiate payment
2. **AC Message**: Receive callback confirmation
3. **BE Message**: Update bank status
4. **AE Message**: Manual status enquiry (NEW)

### **Error Handling**
- **Transaction Not Found**: Returns error with details
- **Database Errors**: Logged and handled gracefully
- **Network Errors**: Timeout and retry logic
- **FPX Errors**: Parsed and returned with descriptions

### **Logging Integration**
- Uses existing Paynet log channels
- Consistent with other FPX messages
- Debug information for troubleshooting
- Transaction tracking for audit

## 📈 **Usage Examples**

### **1. Manual Status Check**
```php
$paynetService = new PaynetService();
$result = $paynetService->sendAcknowledgementEnquiryMessage('TXN123456789');

if ($result && $result['success']) {
    echo "Transaction approved: " . $result['fpx_transaction_id'];
} else {
    echo "Transaction failed: " . $result['response_description'];
}
```

### **2. Reconciliation Process**
```php
// Get all pending transactions
$pendingTransactions = Transaction::where('status', 'pending')->get();

foreach ($pendingTransactions as $transaction) {
    $status = $paynetService->sendAcknowledgementEnquiryMessage($transaction->transaction_id);
    
    if ($status && $status['success']) {
        $transaction->update(['status' => 'completed']);
    }
}
```

### **3. Debugging Failed Payments**
```php
// Check specific failed transaction
$result = $paynetService->sendAcknowledgementEnquiryMessage('FAILED_TXN_ID');

if ($result) {
    Log::info('Transaction status check', [
        'transaction_id' => $result['transaction_id'],
        'response_code' => $result['response_code'],
        'description' => $result['response_description']
    ]);
}
```

## ✅ **Implementation Status**

| Feature | Status | Notes |
|---------|--------|-------|
| **AE Message Service** | ✅ Complete | Full implementation with 25 parameters |
| **Controller Method** | ✅ Complete | HTTP endpoint with validation |
| **Route Definition** | ✅ Complete | RESTful API endpoint |
| **Response Parser** | ✅ Complete | Structured response handling |
| **Test Command** | ✅ Complete | Command-line testing tool |
| **Documentation** | ✅ Complete | Comprehensive implementation guide |
| **Error Handling** | ✅ Complete | Robust error management |
| **Logging** | ✅ Complete | Integrated with existing log channels |

## 🎯 **Summary**

The **AE (Acknowledgement Enquiry)** message implementation is now **complete and fully functional**. This brings the total FPX message types to **4/4** (100% complete):

1. ✅ **AR** (Authorization Request) - Payment initiation
2. ✅ **AC** (Acknowledgement) - Callback processing  
3. ✅ **BE** (Bank Enquiry) - Bank status management
4. ✅ **AE** (Acknowledgement Enquiry) - Manual status checking

The implementation provides a robust, secure, and well-documented solution for manual transaction status enquiries, completing the full FPX integration suite. 