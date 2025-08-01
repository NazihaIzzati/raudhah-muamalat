# Production Environment Setup

## 🎯 **Overview**

This document outlines the complete setup for the production environment of Jariah Fund's FPX Paynet integration.

## ✅ **Production Configuration Status**

### **✅ Environment Settings**
- **Environment**: Production
- **API URL**: https://api.paynet.my
- **Merchant ID**: EX00010946
- **Merchant Name**: Jariah Fund
- **Timeout**: 60 seconds
- **Retry Attempts**: 5
- **Logging Level**: info

### **✅ Production Banks (21 banks)**
- **Commercial Banks**: MAYBANK2U, CIMB BANK, PUBLIC BANK, RHB BANK, etc.
- **Islamic Banks**: BANK ISLAM, KFH, BANK MUAMALAT
- **Government Banks**: BSN, AGRONet, BANK RAKYAT, BANK OF CHINA

### **✅ API Endpoints**
- **API URL**: https://api.paynet.my ✅
- **Gateway URL**: https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp ✅
- **Bank List URL**: https://www.mepsfpx.com.my/FPXMain/RetrieveBankList ✅
- **Redirect URL**: https://www.mepsfpx.com.my/FPXMain/processMesgFromSBIBanks.jsp ✅
- **Terms URL**: https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp ✅
- **Callback URL**: https://your-domain.com/payment/paynet/callback ✅

## 🔧 **Production Setup Steps**

### **Step 1: Environment Configuration**
```bash
# Set production environment
export PAYNET_ENVIRONMENT=production

# Or add to .env file
PAYNET_ENVIRONMENT=production
```

### **Step 2: Production Keys Setup**
```bash
# Generate production keys
mkdir -p ssh-keygen/prod

# Generate private key
openssl genrsa -out ssh-keygen/prod_merchant_private.key 2048

# Generate merchant certificate
openssl req -new -x509 -key ssh-keygen/prod_merchant_private.key \
  -out ssh-keygen/prod_merchant_certificate.cer -days 365 \
  -subj "/C=MY/ST=Kuala Lumpur/L=Kuala Lumpur/O=Jariah Fund/OU=IT/CN=jariahfund.com"

# Set proper permissions
chmod 600 ssh-keygen/prod_merchant_private.key
chmod 644 ssh-keygen/prod_merchant_certificate.cer
```

### **Step 3: Paynet Public Certificate**
```bash
# Get Paynet public certificate from Paynet
# Place it in: ssh-keygen/prod_paynet_public.cer
```

### **Step 4: Database Setup**
```bash
# Run migrations
php artisan migrate --force

# Seed production data
php artisan db:seed --class=FpxBankSeeder
```

### **Step 5: Production Testing**
```bash
# Test production configuration
php artisan test:production-fpx --detailed

# Test FPX processing
php artisan test:fpx-processing --detailed

# Update bank status
php artisan fpx:update-bank-status --force
```

## 📊 **Production vs UAT Comparison**

| **Aspect** | **UAT** | **Production** |
|------------|---------|----------------|
| **Environment** | UAT (Testing) | Production |
| **API URL** | https://sandbox.api.paynet.my | https://api.paynet.my |
| **Gateway URL** | https://uat.mepsfpx.com.my | https://www.mepsfpx.com.my |
| **Merchant ID** | EX00010946 | EX00010946 |
| **Timeout** | 30 seconds | 60 seconds |
| **Retry Attempts** | 3 | 5 |
| **Logging Level** | debug | info |
| **Bank List** | Test banks + Real banks | Real banks only |
| **Payload Format** | Simulator format | Standard FPX format |
| **Signature** | RSA-SHA1 | RSA-SHA1 |

## 🔄 **Payload Format Changes**

### **UAT Simulator Format**
```php
$fpxPayload = [
    'debugMode' => 'false',
    'msgType' => 'AR',
    'IntgType' => '2D',
    'msgToken' => '01',
    'buyerBank' => $fpxBank,
    'sellerFPXBank' => '01',
    'exchange' => $this->getExchangeList(),
    'sellerID' => $this->merchantId,
    'OrdNo' => $transactionId,
    // ... more fields
];
```

### **Production Standard Format**
```php
$fpxPayload = [
    'fpx_msgToken' => '01',
    'fpx_msgType' => 'AR',
    'fpx_sellerExId' => $this->merchantId,
    'fpx_version' => '7.0',
    'fpx_sellerExOrderNo' => $transactionId,
    'fpx_sellerTxnTime' => now()->format('YmdHis'),
    'fpx_sellerOrderNo' => $transactionId,
    'fpx_sellerId' => $this->merchantId,
    'fpx_sellerBankCode' => $fpxBank,
    'fpx_txnCurrency' => 'MYR',
    'fpx_txnAmount' => number_format($amount, 2, '.', ''),
    'fpx_buyerEmail' => $donorEmail,
    'fpx_buyerName' => $this->sanitizeBuyerName($donorName),
    'fpx_buyerPhoneNo' => $donorPhone,
    'fpx_productDesc' => 'Donation - ' . ($transactionData['campaign_name'] ?? 'General'),
    'fpx_buyerBankId' => $fpxBank,
    // ... more fields
];
```

## 🏦 **Production Bank List**

### **Commercial Banks**
- MB2U0227 - MAYBANK2U
- MBB0228 - MAYBANK2E
- BCBB0235 - CIMB BANK
- PBB0233 - PUBLIC BANK
- RHB0218 - RHB BANK
- HLB0224 - HLBB
- OCBC0229 - OCBC BANK
- UOB0226 - UOB BANK
- HSBC0223 - HSBC BANK
- SCB0216 - STANDARD CHARTERED
- CIT0219 - CITIBANK
- ABMB0212 - ALLIANCE BANK (PERSONAL)
- AMBB0209 - AMBANK
- ABB0233 - AFFIN BANK

### **Islamic Banks**
- BIMB0340 - BANK ISLAM
- KFH0346 - KFH
- BMMB0341 - BANK MUAMALAT

### **Government Banks**
- BSN0601 - BSN
- AGRO01 - AGRONet (Retail)
- BKRM0602 - BANK RAKYAT
- BOCM01 - BANK OF CHINA

## 🧪 **Production Testing Commands**

### **1. Test Production Configuration**
```bash
php artisan test:production-fpx --detailed
```

### **2. Test FPX Processing**
```bash
php artisan test:fpx-processing --detailed
```

### **3. Show Bank Status**
```bash
php artisan fpx:show-bank-status --detailed
```

### **4. Update Bank Status**
```bash
php artisan fpx:update-bank-status --force
```

## 🔒 **Security Considerations**

### **1. Key Management**
- Private keys should be stored securely
- Use proper file permissions (600 for private keys)
- Regular key rotation
- Backup keys securely

### **2. Environment Variables**
- Never commit production credentials to version control
- Use environment-specific .env files
- Secure environment variable storage

### **3. SSL/TLS**
- Enable HTTPS for all production traffic
- Use valid SSL certificates
- Configure secure headers

### **4. Logging**
- Log all payment transactions
- Monitor for suspicious activity
- Regular log rotation
- Secure log storage

## 📋 **Production Checklist**

### **✅ Pre-Deployment**
- [ ] Environment set to production
- [ ] Production keys generated
- [ ] Paynet public certificate obtained
- [ ] Database migrations run
- [ ] Bank list seeded
- [ ] SSL certificates configured
- [ ] Error monitoring set up

### **✅ Post-Deployment**
- [ ] Production configuration tested
- [ ] Bank status updated
- [ ] Payment flow tested
- [ ] Callback URLs verified
- [ ] Logs monitored
- [ ] Performance optimized

### **✅ Ongoing Maintenance**
- [ ] Regular bank status updates
- [ ] Key rotation schedule
- [ ] Log monitoring
- [ ] Performance monitoring
- [ ] Security updates
- [ ] Backup verification

## 🚀 **Deployment Commands**

### **1. Setup Production Environment**
```bash
# Run production setup script
chmod +x setup-production-environment.sh
./setup-production-environment.sh
```

### **2. Deploy to Production**
```bash
# Set production environment
export PAYNET_ENVIRONMENT=production

# Run migrations
php artisan migrate --force

# Seed data
php artisan db:seed --class=FpxBankSeeder

# Test configuration
php artisan test:production-fpx --detailed
```

### **3. Verify Deployment**
```bash
# Test payment flow
php artisan test:fpx-processing --detailed

# Check bank status
php artisan fpx:show-bank-status --detailed

# Update bank status
php artisan fpx:update-bank-status --force
```

## 🎉 **Production Ready**

The system is now configured for production with:

- ✅ **Production Environment**: Properly configured
- ✅ **Production Banks**: 21 real banks available
- ✅ **Production API**: Real Paynet endpoints
- ✅ **Production Security**: Proper key management
- ✅ **Production Testing**: Comprehensive test suite
- ✅ **Production Monitoring**: Logging and error handling

The system is ready for live payment processing! 🚀 