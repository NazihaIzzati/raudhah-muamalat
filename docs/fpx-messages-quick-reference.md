# FPX Messages Quick Reference Card

## 📋 **Message Types Overview**

| Message | Purpose | Direction | Parameters | Signature |
|---------|---------|-----------|------------|-----------|
| **AR** | Payment initiation | Merchant → Paynet | 25 | Required |
| **AC** | Payment confirmation | Paynet → Merchant | Variable | Not required |
| **BE** | Bank status check | Merchant → Paynet | 4 | Not required |
| **AE** | Manual status enquiry | Merchant → Paynet | 25 | Required |

## 🔧 **Message Details**

---

### **📤 AR (Authorization Request)**

**Purpose**: Initiate payment transaction
**Route**: `POST /payment/fpx/process`
**Database**: `fpx_ar_message_data`

**Key Parameters**:
```php
$arPayload = [
    'msgToken' => '01',
    'msgType' => 'AR',
    'version' => '7.0',
    'sellerExId' => 'EX00010946',
    'sellerExOrderNo' => 'JF123',
    'sellerTxnTime' => '20250115103000',
    'sellerOrderNo' => 'TXN123456789',
    'txnCurrency' => 'MYR',
    'txnAmount' => '100.00',
    'productDesc' => 'Donation Campaign',
    'buyerEmail' => 'john@example.com',
    'buyerBank' => 'MB2U0227',
    'buyerName' => 'John Doe',
    'checkSum' => 'generated_signature'
];
```

**Signature Order**:
```
buyerAccNo|buyerBankBranch|buyerBank|buyerEmail|buyerIBAN|buyerID|buyerName|makerName|msgToken|msgType|productDesc|sellerFPXBank|sellerID|OrdNo|sellerID|sellerOrdNo|sellerTxnTime|txnAmount|txnCurrency|version
```

---

### **📥 AC (Acknowledgement)**

**Purpose**: Payment confirmation callback
**Route**: `POST /payment/fpx/callback`
**Database**: `fpx_ac_message_data`

**Key Parameters**:
```php
$acPayload = [
    'fpx_msgType' => 'AC',
    'fpx_msgToken' => '01',
    'fpx_sellerExOrderNo' => 'TXN123456789',
    'fpx_txnStatus' => 'success',
    'fpx_txnAmount' => '100.00',
    'fpx_debitAuthCode' => '00',
    'fpx_fpxTxnId' => 'FPX987654321',
    'fpx_buyerBankId' => 'MB2U0227',
    'fpx_buyerName' => 'John Doe',
    'fpx_buyerEmail' => 'john@example.com'
];
```

**Response Codes**:
- `00` = Success
- `FE` = Internal error
- `FF` = Transaction failed
- `FA` = Authentication failed
- `FB` = Bank error
- `FC` = Cancelled by user

---

### **🔍 BE (Bank Enquiry)**

**Purpose**: Query bank status
**Route**: `POST /payment/fpx/banks/update-status`
**Database**: `fpx_be_message_data`

**Key Parameters**:
```php
$bePayload = [
    'msgToken' => '01',
    'msgType' => 'BE',
    'sellerExId' => 'EX00010946',
    'version' => '7.0'
];
```

**Response Format**:
```
fpx_bankList=MB2U0227%7EA%2CCIMB0229%7EB%2CRHB0218%7EA
```

**Parsed Banks**:
```php
$banks = [
    ['code' => 'MB2U0227', 'name' => 'Maybank', 'status' => 'A'],
    ['code' => 'CIMB0229', 'name' => 'CIMB Bank', 'status' => 'B'],
    ['code' => 'RHB0218', 'name' => 'RHB Bank', 'status' => 'A']
];
```

---

### **🔍 AE (Acknowledgement Enquiry)**

**Purpose**: Manual status enquiry
**Route**: `POST /payment/fpx/enquiry`
**Database**: `fpx_ae_message_data`

**Key Parameters**:
```php
$aePayload = [
    'fpx_msgType' => 'AE',
    'fpx_msgToken' => '01',
    'fpx_version' => '7.0',
    'fpx_sellerExId' => 'EX00010946',
    'fpx_sellerExOrderNo' => 'JF123',
    'fpx_sellerTxnTime' => '20250115103000',
    'fpx_sellerOrderNo' => 'TXN123456789',
    'fpx_txnCurrency' => 'MYR',
    'fpx_txnAmount' => '100.00',
    'fpx_productDesc' => 'Donation Campaign',
    'fpx_buyerEmail' => 'john@example.com',
    'fpx_buyerBankId' => 'MB2U0227',
    'fpx_buyerName' => 'John Doe',
    'fpx_checkSum' => 'generated_signature'
];
```

**Signature Order** (same as AR):
```
fpx_buyerAccNo|fpx_buyerBankBranch|fpx_buyerBankId|fpx_buyerEmail|fpx_buyerIBAN|fpx_buyerID|fpx_buyerName|fpx_makerName|fpx_msgToken|fpx_msgType|fpx_productDesc|fpx_sellerFPXBank|fpx_sellerID|fpx_OrdNo|fpx_sellerID|fpx_sellerOrdNo|fpx_sellerTxnTime|fpx_txnAmount|fpx_txnCurrency|fpx_version
```

---

## 🔄 **Message Flow Examples**

### **Standard Payment**
```
AR → AC
```

### **Payment with Manual Enquiry**
```
AR → AC → AE
```

### **Bank Status Update**
```
BE (independent)
```

---

## 🧪 **Testing Commands**

### **Test AR Message**
```bash
curl -X POST http://localhost:8080/payment/fpx/process \
  -H "Content-Type: application/json" \
  -d '{
    "donation_id": "123",
    "amount": "100.00",
    "fpx_bank": "MB2U0227",
    "fpx_buyer_name": "John Doe",
    "fpx_buyer_email": "john@example.com"
  }'
```

### **Test AC Message (Simulate Callback)**
```bash
curl -X POST http://localhost:8080/payment/fpx/callback \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d 'fpx_msgType=AC&fpx_debitAuthCode=00&fpx_fpxTxnId=FPX987654321&fpx_sellerExOrderNo=TXN123456789'
```

### **Test BE Message**
```bash
curl -X POST http://localhost:8080/payment/fpx/banks/update-status
```

### **Test AE Message**
```bash
curl -X POST http://localhost:8080/payment/fpx/enquiry \
  -H "Content-Type: application/json" \
  -d '{"transaction_id": "TXN123456789"}'
```

### **Test Message History**
```bash
curl -X GET http://localhost:8080/payment/fpx/history/TXN123456789
```

---

## 📊 **Database Tracking**

### **AR Message**
```php
$transaction->update([
    'fpx_ar_message_data' => $arPayload,
    'fpx_ar_sent_at' => now(),
    'fpx_ar_status' => 'sent',
    'fpx_last_message_type' => 'AR',
    'fpx_last_message_at' => now(),
    'fpx_message_sequence' => 'AR',
]);
```

### **AC Message**
```php
$transaction->update([
    'fpx_ac_message_data' => $acPayload,
    'fpx_ac_received_at' => now(),
    'fpx_ac_status' => $isValid ? 'processed' : 'failed',
    'fpx_ac_response_code' => $responseCode,
    'fpx_last_message_type' => 'AC',
    'fpx_last_message_at' => now(),
    'fpx_message_sequence' => $transaction->fpx_message_sequence ? $transaction->fpx_message_sequence . '->AC' : 'AR->AC',
]);
```

### **BE Message**
```php
$systemTransaction = \App\Models\Transaction::create([
    'transaction_id' => 'BE_' . now()->format('YmdHis') . '_' . rand(1000, 9999),
    'merchant_id' => $this->merchantId,
    'amount' => 0.00,
    'currency' => 'MYR',
    'payment_method' => 'fpx_system',
    'status' => 'completed',
    'fpx_be_message_data' => $bePayload,
    'fpx_be_sent_at' => now(),
    'fpx_be_status' => 'success',
    'fpx_last_message_type' => 'BE',
    'fpx_last_message_at' => now(),
    'fpx_message_sequence' => 'BE',
]);
```

### **AE Message**
```php
$transaction->update([
    'fpx_ae_message_data' => $aePayload,
    'fpx_ae_sent_at' => now(),
    'fpx_ae_status' => $aeResult ? 'success' : 'failed',
    'fpx_ae_response_code' => $aeResult['response_code'] ?? '',
    'fpx_last_message_type' => 'AE',
    'fpx_last_message_at' => now(),
    'fpx_message_sequence' => $transaction->fpx_message_sequence ? $transaction->fpx_message_sequence . '->AE' : 'AR->AC->AE',
]);
```

---

## 🔐 **Security Notes**

- **AR & AE**: Require RSA-SHA1 signature
- **AC**: Verify callback signature
- **BE**: No signature required
- All amounts must be formatted as "100.00"
- All timestamps must be in YmdHis format
- Special characters must be properly encoded

---

## 📚 **Full Documentation**

For complete documentation, see: `docs/fpx-messages-complete-documentation.md` 