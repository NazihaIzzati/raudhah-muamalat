# FPX Bank Management Implementation

## Overview

This document outlines the implementation of FPX bank management features based on the official FPX documentation and best practices. The implementation includes bank status tracking, BE message handling, and comprehensive bank list management.

## 🏦 **FPX Bank Model**

### **Database Schema**
```sql
CREATE TABLE fpx_banks (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bank_id VARCHAR(10) UNIQUE NOT NULL COMMENT 'FPX Bank ID (e.g., MB2U0227)',
    bank_name VARCHAR(100) NOT NULL COMMENT 'Full bank name',
    display_name VARCHAR(100) NOT NULL COMMENT 'Display name for UI',
    bank_status BOOLEAN DEFAULT TRUE COMMENT 'Bank availability status',
    bank_code VARCHAR(10) NULL COMMENT 'Bank code for FPX',
    bank_type VARCHAR(20) DEFAULT 'commercial' COMMENT 'Bank type (commercial, islamic, etc.)',
    last_updated TIMESTAMP NULL COMMENT 'Last status update time',
    is_active BOOLEAN DEFAULT TRUE COMMENT 'Whether bank is active in system',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    INDEX idx_bank_id (bank_id),
    INDEX idx_bank_status (bank_status),
    INDEX idx_is_active (is_active)
);
```

### **Model Features**
- **Bank Status Tracking**: Real-time status updates from FPX system
- **Bank Type Classification**: Commercial, Islamic, Government, Digital banks
- **Active/Inactive Management**: Enable/disable banks in the system
- **Display Name Handling**: Smart display names with offline indicators

## 🔄 **BE Message Implementation**

### **BE Message Flow**
```
1. System generates BE (Bank Enquiry) message
2. Sends to FPX gateway with RSA signature
3. FPX responds with bank status list
4. System parses response and updates database
5. Banks marked as online/offline based on FPX status
```

### **BE Message Parameters**
```php
$bePayload = [
    'fpx_msgType' => 'BE',           // Bank Enquiry message type
    'fpx_msgToken' => '01',          // Message token
    'fpx_sellerExId' => 'EX00010946', // Seller Exchange ID
    'fpx_version' => '7.0',          // FPX version
    'fpx_checkSum' => $signature,    // RSA signature
];
```

### **Response Parsing**
```php
// FPX Response Format: fpx_bankList=bank_id~status,bank_id~status
// Status: A = Available, B = Busy/Offline

$response = 'fpx_bankList=MB2U0227~A,CIMB0229~B,RHB0218~A';
$bankStatus = [
    'MB2U0227' => 'A', // Available
    'CIMB0229' => 'B', // Busy/Offline
    'RHB0218' => 'A',  // Available
];
```

## 🛠️ **Implementation Components**

### **1. FpxBank Model**
```php
class FpxBank extends Model
{
    // Scopes for filtering
    public function scopeActive($query) { ... }
    public function scopeOnline($query) { ... }
    public function scopeOffline($query) { ... }
    
    // Status management
    public function updateStatus($status) { ... }
    public static function findByBankId($bankId) { ... }
    public static function getActiveBanks() { ... }
    public static function getBankListForFpx() { ... }
}
```

### **2. PaynetService Enhancements**
```php
class PaynetService
{
    // BE Message handling
    public function sendBankEnquiryMessage() { ... }
    private function parseBankListResponse($response) { ... }
    public function updateBankStatusFromFpx() { ... }
    public function getBankStatusSummary() { ... }
}
```

### **3. PaymentController Extensions**
```php
class PaymentController
{
    // Bank management endpoints
    public function getFpxBankList() { ... }
    public function updateFpxBankStatus() { ... }
    public function getFpxBankStatusSummary() { ... }
    public function getActiveFpxBanks() { ... }
}
```

## 📊 **Bank Status Management**

### **Status Types**
- **Online (A)**: Bank is available for transactions
- **Offline (B)**: Bank is busy or temporarily unavailable
- **Inactive**: Bank is disabled in the system

### **Status Update Process**
1. **Scheduled Updates**: Run every hour via command
2. **Manual Updates**: Via API endpoint
3. **Real-time Updates**: During payment processing

### **Bank Categories**
- **Commercial Banks**: Maybank, CIMB, RHB, etc.
- **Islamic Banks**: Bank Islam, AmBank Islamic, etc.
- **Government Banks**: BSN, Agro Bank
- **Digital Banks**: Boost, Touch n Go, GrabPay
- **Test Banks**: For development/testing

## 🔧 **API Endpoints**

### **Bank List Management**
```bash
# Get all FPX banks
GET /api/fpx/banks

# Get active banks only
GET /api/fpx/banks/active

# Update bank status from FPX
POST /api/fpx/banks/update-status

# Get bank status summary
GET /api/fpx/banks/status-summary
```

### **Response Formats**
```json
{
    "success": true,
    "banks": [
        {
            "id": "MB2U0227",
            "name": "Maybank",
            "status": "online"
        }
    ],
    "source": "api|static"
}
```

## 🚀 **Command Line Tools**

### **Bank Status Update Command**
```bash
# Update bank status from FPX
php artisan fpx:update-bank-status

# Force update (ignore recent updates)
php artisan fpx:update-bank-status --force
```

### **Command Features**
- **Rate Limiting**: Prevents excessive API calls
- **Error Handling**: Graceful failure handling
- **Logging**: Comprehensive audit trail
- **Summary Reporting**: Status summary after updates

## 🧪 **Testing**

### **Test Coverage**
- **Model Tests**: Bank CRUD operations
- **Service Tests**: BE message handling
- **API Tests**: Endpoint functionality
- **Command Tests**: CLI tool functionality

### **Test Data**
```php
// Test bank data
$testBanks = [
    ['bank_id' => 'TEST0021', 'name' => 'SBI Bank A'],
    ['bank_id' => 'TEST0022', 'name' => 'SBI Bank B'],
    ['bank_id' => 'TEST0023', 'name' => 'SBI Bank C'],
];
```

## 🔐 **Security Features**

### **RSA Signature Verification**
- **Private Key Management**: Secure key storage
- **Signature Generation**: RSA-SHA1 algorithm
- **Response Validation**: Verify FPX responses

### **Data Validation**
- **Input Sanitization**: Clean bank data
- **Status Validation**: Verify status codes
- **Error Handling**: Comprehensive error management

## 📈 **Monitoring & Analytics**

### **Bank Status Metrics**
- **Total Banks**: Number of banks in system
- **Online Banks**: Available for transactions
- **Offline Banks**: Temporarily unavailable
- **Last Updated**: Timestamp of last status update

### **Performance Monitoring**
- **Response Times**: API call performance
- **Success Rates**: Update success tracking
- **Error Rates**: Failure monitoring
- **Usage Patterns**: Bank selection analytics

## 🔄 **Integration with Payment Flow**

### **Payment Process Integration**
1. **Bank Selection**: Show only online banks
2. **Status Validation**: Check bank availability
3. **Transaction Processing**: Use bank status
4. **Error Handling**: Handle offline banks

### **User Experience**
- **Real-time Status**: Show current bank status
- **Offline Indicators**: Clear offline bank marking
- **Fallback Options**: Alternative banks when needed
- **Error Messages**: Clear status explanations

## 🚨 **Error Handling**

### **Common Issues**
- **FPX API Unavailable**: Fallback to static list
- **Invalid Responses**: Log and handle gracefully
- **Network Timeouts**: Retry with backoff
- **Signature Failures**: Verify key configuration

### **Recovery Strategies**
- **Static Fallback**: Use predefined bank list
- **Cached Data**: Use last known good status
- **Manual Override**: Admin bank status control
- **Alert System**: Notify on critical failures

## 📋 **Deployment Checklist**

### **Pre-Deployment**
- [ ] FPX credentials configured
- [ ] RSA keys properly set up
- [ ] Database migrations run
- [ ] Bank data seeded
- [ ] API endpoints tested

### **Post-Deployment**
- [ ] Bank status updates working
- [ ] Payment flow integration tested
- [ ] Monitoring alerts configured
- [ ] Error logging verified
- [ ] Performance metrics tracked

## 🔗 **Related Documentation**

- [FPX Integration Documentation](FPX_Integration_Documentation.md)
- [Paynet Service Documentation](paynet-fpx-integration.md)
- [Payment Controller Documentation](payment-controller.md)
- [Database Schema Documentation](database-schema.md)

---

**Last Updated**: 2025-07-29  
**Version**: 1.0.0  
**Status**: ✅ Implemented and Tested 