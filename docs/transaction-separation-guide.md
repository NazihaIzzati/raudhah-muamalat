# Transaction Separation Guide

## 📋 **Overview**

The transaction system has been separated into **two distinct tables** for better organization, logging, and maintenance:

- **`cardzone_transactions`** - For all Cardzone payment transactions
- **`paynet_transactions`** - For all Paynet FPX payment transactions

## 🏗️ **Database Structure**

### **1. Cardzone Transactions Table**

```sql
CREATE TABLE cardzone_transactions (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    transaction_id VARCHAR(255) UNIQUE,
    merchant_id VARCHAR(255),
    amount DECIMAL(10,2),
    currency VARCHAR(10),
    payment_method VARCHAR(50), -- 'card', 'obw', 'qr'
    status VARCHAR(50) DEFAULT 'pending',
    card_number_masked VARCHAR(255) NULL,
    card_expiry VARCHAR(10) NULL,
    card_holder_name VARCHAR(255) NULL,
    obw_bank_code VARCHAR(50) NULL,
    qr_code_data TEXT NULL,
    auth_value TEXT NULL, -- CAVV/AAV from 3DS
    eci VARCHAR(10) NULL, -- ECI from 3DS
    cardzone_response_data JSON NULL,
    donation_id BIGINT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- Indexes for performance
    INDEX idx_transaction_id (transaction_id),
    INDEX idx_merchant_id (merchant_id),
    INDEX idx_status (status),
    INDEX idx_donation_id (donation_id),
    INDEX idx_created_at (created_at)
);
```

### **2. Paynet Transactions Table**

```sql
CREATE TABLE paynet_transactions (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    transaction_id VARCHAR(255) UNIQUE,
    merchant_id VARCHAR(255),
    amount DECIMAL(10,2),
    currency VARCHAR(10),
    payment_method VARCHAR(50), -- 'fpx', 'fpx_system'
    status VARCHAR(50) DEFAULT 'pending',
    paynet_response_data JSON NULL,
    donation_id BIGINT NULL,
    
    -- AR (Authorization Request) Message Tracking
    fpx_ar_message_data JSON NULL,
    fpx_ar_sent_at TIMESTAMP NULL,
    fpx_ar_status VARCHAR(50) NULL, -- 'sent', 'failed', 'success'
    
    -- AC (Acknowledgement) Message Tracking
    fpx_ac_message_data JSON NULL,
    fpx_ac_received_at TIMESTAMP NULL,
    fpx_ac_status VARCHAR(50) NULL, -- 'received', 'processed', 'failed'
    fpx_ac_response_code VARCHAR(10) NULL, -- '00', 'FE', etc.
    
    -- BE (Bank Enquiry) Message Tracking
    fpx_be_message_data JSON NULL,
    fpx_be_sent_at TIMESTAMP NULL,
    fpx_be_status VARCHAR(50) NULL, -- 'sent', 'failed', 'success'
    
    -- AE (Acknowledgement Enquiry) Message Tracking
    fpx_ae_message_data JSON NULL,
    fpx_ae_sent_at TIMESTAMP NULL,
    fpx_ae_status VARCHAR(50) NULL, -- 'sent', 'failed', 'success'
    fpx_ae_response_code VARCHAR(10) NULL, -- '00', 'FE', etc.
    
    -- General FPX Message Tracking
    fpx_message_sequence VARCHAR(50) NULL, -- Track message flow: AR->AC, BE, AE
    fpx_error_log TEXT NULL, -- Store error details
    fpx_last_message_type VARCHAR(10) NULL, -- Last message type sent/received
    fpx_last_message_at TIMESTAMP NULL,
    
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- Indexes for performance
    INDEX idx_transaction_id (transaction_id),
    INDEX idx_merchant_id (merchant_id),
    INDEX idx_status (status),
    INDEX idx_donation_id (donation_id),
    INDEX idx_created_at (created_at),
    INDEX idx_fpx_last_message_type (fpx_last_message_type),
    INDEX idx_fpx_ar_status (fpx_ar_status),
    INDEX idx_fpx_ac_status (fpx_ac_status),
    INDEX idx_fpx_be_status (fpx_be_status),
    INDEX idx_fpx_ae_status (fpx_ae_status)
);
```

## 📊 **Model Classes**

### **1. CardzoneTransaction Model**

```php
<?php

namespace App\Models;

class CardzoneTransaction extends Model
{
    protected $table = 'cardzone_transactions';
    
    protected $fillable = [
        'transaction_id',
        'merchant_id',
        'amount',
        'currency',
        'payment_method',
        'status',
        'card_number_masked',
        'card_expiry',
        'card_holder_name',
        'obw_bank_code',
        'qr_code_data',
        'auth_value',
        'eci',
        'cardzone_response_data',
        'donation_id',
    ];

    protected $casts = [
        'cardzone_response_data' => 'array',
        'amount' => 'decimal:2',
    ];

    // Logging methods
    public function logStatusChange($oldStatus, $newStatus, $details = [])
    public function logCreation($details = [])
    public function logResponseUpdate($responseData, $source = 'cardzone')
    public function updateWithLogging($data, $logMessage = 'Transaction updated')

    // Scopes
    public function scopePending($query)
    public function scopeCompleted($query)
    public function scopeFailed($query)
    public function scopeCardPayments($query)
    public function scopeObwPayments($query)
    public function scopeQrPayments($query)
}
```

### **2. PaynetTransaction Model**

```php
<?php

namespace App\Models;

class PaynetTransaction extends Model
{
    protected $table = 'paynet_transactions';
    
    protected $fillable = [
        'transaction_id',
        'merchant_id',
        'amount',
        'currency',
        'payment_method',
        'status',
        'paynet_response_data',
        'donation_id',
        // FPX Message Tracking fields...
    ];

    protected $casts = [
        'paynet_response_data' => 'array',
        'fpx_ar_message_data' => 'array',
        'fpx_ac_message_data' => 'array',
        'fpx_be_message_data' => 'array',
        'fpx_ae_message_data' => 'array',
        'fpx_ar_sent_at' => 'datetime',
        'fpx_ac_received_at' => 'datetime',
        'fpx_be_sent_at' => 'datetime',
        'fpx_ae_sent_at' => 'datetime',
        'fpx_last_message_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    // Logging methods
    public function logStatusChange($oldStatus, $newStatus, $details = [])
    public function logCreation($details = [])
    public function logFpxMessage($messageType, $status, $messageData = [], $details = [])
    public function logResponseUpdate($responseData, $source = 'paynet')
    public function updateWithLogging($data, $logMessage = 'Transaction updated')

    // Scopes
    public function scopePending($query)
    public function scopeCompleted($query)
    public function scopeFailed($query)
    public function scopeFpxPayments($query)
    public function scopeSystemTransactions($query)
    public function scopeArMessages($query)
    public function scopeAcMessages($query)
    public function scopeBeMessages($query)
    public function scopeAeMessages($query)
}
```

## 📝 **Logging System**

### **1. Log Channels**

```php
// config/logging.php
'cardzone_transactions' => [
    'driver' => 'single',
    'path' => storage_path('logs/cardzone_transactions.log'),
    'level' => env('LOG_LEVEL', 'debug'),
    'replace_placeholders' => true,
],

'paynet_transactions' => [
    'driver' => 'single',
    'path' => storage_path('logs/paynet_transactions.log'),
    'level' => env('LOG_LEVEL', 'debug'),
    'replace_placeholders' => true,
],
```

### **2. Log File Locations**

- **Cardzone Transactions**: `storage/logs/cardzone_transactions.log`
- **Paynet Transactions**: `storage/logs/paynet_transactions.log`
- **Cardzone General**: `storage/logs/cardzone.log`
- **Paynet General**: `storage/logs/paynet.log`
- **Paynet Debug**: `storage/logs/paynet_debug.log`

### **3. Logging Examples**

#### **Cardzone Transaction Logging**
```php
// Create transaction with logging
$transaction = CardzoneTransaction::create($data);
$transaction->logCreation(['source' => 'payment_form']);

// Update status with logging
$transaction->logStatusChange('pending', 'completed', ['auth_code' => '123456']);

// Update response data with logging
$transaction->logResponseUpdate($responseData, 'cardzone_callback');
```

#### **Paynet Transaction Logging**
```php
// Create transaction with logging
$transaction = PaynetTransaction::create($data);
$transaction->logCreation(['source' => 'fpx_payment']);

// Log FPX message
$transaction->logFpxMessage('AR', 'sent', $messageData, ['bank' => 'MBB']);

// Update status with logging
$transaction->logStatusChange('pending', 'completed', ['response_code' => '00']);
```

## 🔄 **Migration Process**

### **1. Migration Steps**

```bash
# Run the new table migrations
php artisan migrate --path=database/migrations/2025_01_15_000001_create_cardzone_transactions_table.php
php artisan migrate --path=database/migrations/2025_01_15_000002_create_paynet_transactions_table.php

# Migrate existing data
php artisan migrate --path=database/migrations/2025_01_15_000003_migrate_transactions_to_separate_tables.php
```

### **2. Data Migration Logic**

#### **Cardzone Transactions**
- **Payment Methods**: `card`, `obw`, `qr`
- **Data Fields**: All Cardzone-specific fields
- **Response Data**: `cardzone_response_data`

#### **Paynet Transactions**
- **Payment Methods**: `fpx`, `fpx_system`
- **Data Fields**: All Paynet-specific fields
- **Response Data**: `paynet_response_data`
- **FPX Messages**: AR, AC, BE, AE message tracking

## 🎯 **Usage Examples**

### **1. Creating Cardzone Transaction**

```php
use App\Models\CardzoneTransaction;

$transaction = CardzoneTransaction::create([
    'transaction_id' => '6487047256',
    'merchant_id' => '600000000000001',
    'amount' => 150.00,
    'currency' => 'MYR',
    'payment_method' => 'card',
    'status' => 'pending',
    'donation_id' => $donation->id,
]);

$transaction->logCreation(['source' => 'payment_form']);
```

### **2. Creating Paynet Transaction**

```php
use App\Models\PaynetTransaction;

$transaction = PaynetTransaction::create([
    'transaction_id' => 'PNT2025011512345678901234567890001',
    'merchant_id' => 'EX00010946',
    'amount' => 150.00,
    'currency' => 'MYR',
    'payment_method' => 'fpx',
    'status' => 'pending',
    'donation_id' => $donation->id,
]);

$transaction->logCreation(['source' => 'fpx_payment']);
```

### **3. Updating with Logging**

```php
// Cardzone transaction update
$transaction->updateWithLogging([
    'status' => 'completed',
    'cardzone_response_data' => $responseData
], 'Payment completed successfully');

// Paynet transaction update
$transaction->updateWithLogging([
    'status' => 'completed',
    'fpx_ac_message_data' => $acMessageData,
    'fpx_ac_status' => 'processed',
    'fpx_ac_response_code' => '00'
], 'AC message processed successfully');
```

### **4. Querying Transactions**

```php
// Cardzone queries
$pendingCardzone = CardzoneTransaction::pending()->get();
$completedCards = CardzoneTransaction::completed()->cardPayments()->get();
$obwPayments = CardzoneTransaction::obwPayments()->get();

// Paynet queries
$pendingPaynet = PaynetTransaction::pending()->get();
$completedFpx = PaynetTransaction::completed()->fpxPayments()->get();
$arMessages = PaynetTransaction::arMessages()->get();
$systemTransactions = PaynetTransaction::systemTransactions()->get();
```

## 📊 **Benefits**

### **✅ Improved Organization**
- **Separate Concerns**: Cardzone and Paynet transactions are completely separate
- **Clear Structure**: Each table has only relevant fields
- **Better Performance**: Optimized indexes for each payment type

### **✅ Enhanced Logging**
- **Dedicated Log Files**: Separate log files for each transaction type
- **Detailed Tracking**: Every change is logged with context
- **Easy Debugging**: Clear audit trail for troubleshooting

### **✅ Better Maintenance**
- **Independent Updates**: Changes to one system don't affect the other
- **Scalable Structure**: Easy to add new payment providers
- **Clean Code**: Models have only relevant methods and scopes

### **✅ Data Integrity**
- **Type Safety**: Each table has appropriate data types
- **Validation**: Model-level validation for each payment type
- **Consistency**: Standardized logging and update patterns

## 🚀 **Next Steps**

1. **Run Migrations**: Execute the migration files to create new tables
2. **Update Services**: Ensure all services use the new models
3. **Test Logging**: Verify that all transaction changes are properly logged
4. **Monitor Performance**: Check that the new structure performs well
5. **Update Documentation**: Keep this guide updated with any changes

The transaction separation provides **better organization**, **enhanced logging**, and **improved maintainability** for both Cardzone and Paynet payment systems! 🎉 