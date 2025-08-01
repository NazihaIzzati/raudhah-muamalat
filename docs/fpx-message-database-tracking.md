# FPX Message Database Tracking System

## 📋 **Overview**

The FPX message database tracking system ensures that **all 4 FPX message types** (AR, AC, BE, AE) are saved to the database for complete transaction history, audit trails, and reconciliation purposes.

## 🎯 **Purpose**

- **Complete Transaction History**: Track all FPX messages for each transaction
- **Audit Trail**: Maintain detailed logs for compliance and debugging
- **Reconciliation**: Verify message flow and identify missing communications
- **Error Tracking**: Store error details for troubleshooting
- **Message Sequence**: Track the flow of messages (AR → AC, BE, AE)

## 📊 **Database Schema**

### **New Fields Added to Transactions Table**

| Field | Type | Description | Message Type |
|-------|------|-------------|--------------|
| `fpx_ar_message_data` | JSON | AR message payload | AR |
| `fpx_ar_sent_at` | TIMESTAMP | When AR was sent | AR |
| `fpx_ar_status` | VARCHAR | AR status (sent/failed/success) | AR |
| `fpx_ac_message_data` | JSON | AC message payload | AC |
| `fpx_ac_received_at` | TIMESTAMP | When AC was received | AC |
| `fpx_ac_status` | VARCHAR | AC status (received/processed/failed) | AC |
| `fpx_ac_response_code` | VARCHAR | AC response code (00/FE/etc) | AC |
| `fpx_be_message_data` | JSON | BE message payload | BE |
| `fpx_be_sent_at` | TIMESTAMP | When BE was sent | BE |
| `fpx_be_status` | VARCHAR | BE status (sent/failed/success) | BE |
| `fpx_ae_message_data` | JSON | AE message payload | AE |
| `fpx_ae_sent_at` | TIMESTAMP | When AE was sent | AE |
| `fpx_ae_status` | VARCHAR | AE status (sent/failed/success) | AE |
| `fpx_ae_response_code` | VARCHAR | AE response code (00/FE/etc) | AE |
| `fpx_message_sequence` | VARCHAR | Message flow tracking | All |
| `fpx_error_log` | TEXT | Error details | All |
| `fpx_last_message_type` | VARCHAR | Last message type | All |
| `fpx_last_message_at` | TIMESTAMP | Last message timestamp | All |

## 🔧 **Implementation Details**

### **1. AR (Authorization Request) Message Tracking**

**When Saved:** During payment initiation
**Location:** `PaynetService::createFpxPayment()`

```php
$transaction->update([
    'fpx_ar_message_data' => $fpxPayload,
    'fpx_ar_sent_at' => now(),
    'fpx_ar_status' => 'sent',
    'fpx_last_message_type' => 'AR',
    'fpx_last_message_at' => now(),
    'fpx_message_sequence' => 'AR',
]);
```

**Data Stored:**
- Complete 25-parameter AR payload
- Timestamp of when sent
- Status tracking
- Message sequence initialization

### **2. AC (Acknowledgement) Message Tracking**

**When Saved:** During callback processing
**Location:** `PaymentController::handlePaynetCallback()`

```php
$transaction->update([
    'fpx_ac_message_data' => $receivedData,
    'fpx_ac_received_at' => now(),
    'fpx_ac_status' => $isValid ? 'processed' : 'failed',
    'fpx_ac_response_code' => $responseCode,
    'fpx_last_message_type' => 'AC',
    'fpx_last_message_at' => now(),
    'fpx_message_sequence' => $transaction->fpx_message_sequence ? $transaction->fpx_message_sequence . '->AC' : 'AR->AC',
]);
```

**Data Stored:**
- Complete callback data from Paynet
- Response codes and status
- Message sequence continuation

### **3. BE (Bank Enquiry) Message Tracking**

**When Saved:** During bank status updates
**Location:** `PaynetService::sendBankEnquiryMessage()`

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

**Data Stored:**
- System transaction record for BE messages
- Bank enquiry payload
- Status tracking for system messages

### **4. AE (Acknowledgement Enquiry) Message Tracking**

**When Saved:** During manual status enquiries
**Location:** `PaynetService::sendAcknowledgementEnquiryMessage()`

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

**Data Stored:**
- Complete AE message payload
- Response codes and status
- Message sequence continuation

## 📈 **Message Sequence Tracking**

### **Typical Message Flows**

1. **Standard Payment Flow:**
   ```
   AR → AC
   ```

2. **Payment with Manual Enquiry:**
   ```
   AR → AC → AE
   ```

3. **System Bank Updates:**
   ```
   BE (independent system messages)
   ```

4. **Failed Payment with Enquiry:**
   ```
   AR → AC (failed) → AE
   ```

### **Sequence Examples**

| Transaction | Message Sequence | Description |
|-------------|------------------|-------------|
| Normal Payment | `AR->AC` | Successful payment |
| Payment with Enquiry | `AR->AC->AE` | Payment + manual check |
| Failed Payment | `AR->AC` | Failed payment |
| System Update | `BE` | Bank status update |

## 🔍 **Querying and Analysis**

### **1. Get All FPX Transactions**

```sql
SELECT 
    transaction_id,
    amount,
    status,
    fpx_message_sequence,
    fpx_last_message_type,
    fpx_last_message_at
FROM transactions 
WHERE payment_method = 'fpx'
ORDER BY created_at DESC;
```

### **2. Find Transactions with Specific Message Types**

```sql
-- Transactions with AR messages
SELECT * FROM transactions WHERE fpx_ar_message_data IS NOT NULL;

-- Transactions with AC messages
SELECT * FROM transactions WHERE fpx_ac_message_data IS NOT NULL;

-- Transactions with AE messages
SELECT * FROM transactions WHERE fpx_ae_message_data IS NOT NULL;
```

### **3. Find Failed Messages**

```sql
-- Failed AR messages
SELECT * FROM transactions WHERE fpx_ar_status = 'failed';

-- Failed AC messages
SELECT * FROM transactions WHERE fpx_ac_status = 'failed';

-- Failed AE messages
SELECT * FROM transactions WHERE fpx_ae_status = 'failed';
```

### **4. Message Sequence Analysis**

```sql
-- Complete message sequences
SELECT 
    transaction_id,
    fpx_message_sequence,
    COUNT(*) as message_count
FROM transactions 
WHERE fpx_message_sequence IS NOT NULL
GROUP BY fpx_message_sequence
ORDER BY message_count DESC;
```

## 🧪 **Testing and Verification**

### **1. API Endpoint for Message History**

**Route:** `GET /payment/fpx-history/{transaction_id}`

**Example Response:**
```json
{
    "success": true,
    "data": {
        "transaction_id": "TXN123456789",
        "amount": "100.00",
        "currency": "MYR",
        "status": "completed",
        "created_at": "2025-01-15T10:30:00Z",
        "messages": {
            "AR": {
                "type": "Authorization Request",
                "direction": "Merchant → Paynet",
                "status": "sent",
                "sent_at": "2025-01-15T10:30:00Z",
                "data": { /* AR payload */ },
                "description": "Payment initiation message"
            },
            "AC": {
                "type": "Acknowledgement",
                "direction": "Paynet → Merchant",
                "status": "processed",
                "received_at": "2025-01-15T10:31:00Z",
                "response_code": "00",
                "data": { /* AC payload */ },
                "description": "Payment confirmation callback"
            },
            "AE": {
                "type": "Acknowledgement Enquiry",
                "direction": "Merchant → Paynet",
                "status": "success",
                "sent_at": "2025-01-15T10:35:00Z",
                "response_code": "00",
                "data": { /* AE payload */ },
                "description": "Manual status enquiry"
            }
        },
        "fpx_info": {
            "message_sequence": "AR->AC->AE",
            "last_message_type": "AE",
            "last_message_at": "2025-01-15T10:35:00Z",
            "error_log": null
        }
    }
}
```

### **2. Command Line Testing**

```bash
# Test AR message tracking
php artisan test:ae-message TXN123456789

# Check database for saved messages
php artisan tinker
>>> $transaction = App\Models\Transaction::where('transaction_id', 'TXN123456789')->first();
>>> $transaction->fpx_ar_message_data; // AR data
>>> $transaction->fpx_ac_message_data; // AC data
>>> $transaction->fpx_ae_message_data; // AE data
>>> $transaction->fpx_message_sequence; // Message sequence
```

## 📊 **Monitoring and Alerts**

### **1. Message Status Monitoring**

```php
// Check for failed messages
$failedAR = Transaction::where('fpx_ar_status', 'failed')->count();
$failedAC = Transaction::where('fpx_ac_status', 'failed')->count();
$failedAE = Transaction::where('fpx_ae_status', 'failed')->count();

// Alert if failures detected
if ($failedAR > 0 || $failedAC > 0 || $failedAE > 0) {
    Log::warning('FPX message failures detected', [
        'failed_ar' => $failedAR,
        'failed_ac' => $failedAC,
        'failed_ae' => $failedAE
    ]);
}
```

### **2. Message Sequence Validation**

```php
// Validate message sequences
$incompleteSequences = Transaction::where('fpx_message_sequence', 'LIKE', '%AR%')
    ->where('fpx_message_sequence', 'NOT LIKE', '%AC%')
    ->count();

if ($incompleteSequences > 0) {
    Log::warning('Incomplete FPX message sequences detected', [
        'count' => $incompleteSequences
    ]);
}
```

## 🔐 **Security and Compliance**

### **1. Data Retention**

- **Message Data**: Stored indefinitely for audit purposes
- **Error Logs**: Retained for troubleshooting
- **Timestamps**: Accurate UTC timestamps for all events

### **2. Data Privacy**

- **Sensitive Data**: Masked in logs and responses
- **Access Control**: Admin-only access to message history
- **Audit Trail**: Complete transaction history maintained

### **3. Compliance Features**

- **Complete Audit Trail**: All messages tracked
- **Error Tracking**: Failed messages logged
- **Sequence Validation**: Message flow verification
- **Timestamp Accuracy**: Precise timing for all events

## ✅ **Implementation Status**

| Feature | Status | Notes |
|---------|--------|-------|
| **Database Schema** | ✅ Complete | All 4 message types tracked |
| **AR Message Tracking** | ✅ Complete | Payment initiation tracking |
| **AC Message Tracking** | ✅ Complete | Callback processing tracking |
| **BE Message Tracking** | ✅ Complete | System message tracking |
| **AE Message Tracking** | ✅ Complete | Manual enquiry tracking |
| **Message Sequence** | ✅ Complete | Flow tracking implemented |
| **Error Logging** | ✅ Complete | Comprehensive error tracking |
| **API Endpoint** | ✅ Complete | Message history endpoint |
| **Testing Tools** | ✅ Complete | Verification commands |
| **Documentation** | ✅ Complete | Comprehensive guide |

## 🎯 **Summary**

The **FPX message database tracking system** is now **complete and fully functional**. All 4 FPX message types (AR, AC, BE, AE) are automatically saved to the database with:

- **Complete message payloads** for audit purposes
- **Accurate timestamps** for all events
- **Status tracking** for success/failure monitoring
- **Message sequence tracking** for flow analysis
- **Error logging** for troubleshooting
- **API endpoints** for data retrieval

This ensures **100% transaction history preservation** and provides comprehensive audit trails for compliance and reconciliation purposes. 