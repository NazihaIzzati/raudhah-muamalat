# Organized Transaction Database Structure

## 📋 **Overview**

The transaction database has been **completely reorganized** with **clear naming conventions** and **field separation** to avoid conflicts between Cardzone and Paynet payment systems.

### **🏗️ Database Architecture**

```
┌─────────────────────────────────────┐    ┌─────────────────────────────────────┐
│      cardzone_transactions          │    │       paynet_transactions           │
│                                     │    │                                     │
│  ┌─────────────────────────────┐    │    │  ┌─────────────────────────────┐    │
│  │     Core Fields (cz_*)      │    │    │  │     Core Fields (pn_*)      │    │
│  │  - cz_transaction_id        │    │    │  │  - pn_transaction_id        │    │
│  │  - cz_merchant_id           │    │    │  │  - pn_merchant_id           │    │
│  │  - cz_amount                │    │    │  │  - pn_amount                │    │
│  │  - cz_currency              │    │    │  │  - pn_currency              │    │
│  │  - cz_payment_method        │    │    │  │  - pn_payment_method        │    │
│  │  - cz_status                │    │    │  │  - pn_status                │    │
│  └─────────────────────────────┘    │    │  └─────────────────────────────┘    │
│                                     │    │                                     │
│  ┌─────────────────────────────┐    │    │  ┌─────────────────────────────┐    │
│  │   Payment-Specific Fields   │    │    │  │   FPX Message Tracking      │    │
│  │  - Card (3DS) fields        │    │    │  │  - AR, AC, BE, AE messages  │    │
│  │  - OBW fields               │    │    │  │  - Message status tracking   │    │
│  │  - QR fields                │    │    │  │  - Response code tracking    │    │
│  └─────────────────────────────┘    │    │  └─────────────────────────────┘    │
│                                     │    │                                     │
│  ┌─────────────────────────────┐    │    │  ┌─────────────────────────────┐    │
│  │   Response & Tracking       │    │    │  │   FPX Transaction Details   │    │
│  │  - cz_response_data         │    │    │  │  - Seller/Buyer details     │    │
│  │  - cz_response_code         │    │    │  │  - Bank/Account details     │    │
│  │  - cz_session_id            │    │    │  │  - Product/Version details  │    │
│  └─────────────────────────────┘    │    │  └─────────────────────────────┘    │
└─────────────────────────────────────┘    └─────────────────────────────────────┘
```

## 🏗️ **Cardzone Transactions Table**

### **📊 Table Structure**

```sql
CREATE TABLE cardzone_transactions (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    
    -- =============================================================================
    -- CORE TRANSACTION FIELDS (Cardzone-specific)
    -- =============================================================================
    cz_transaction_id VARCHAR(255) UNIQUE COMMENT 'Cardzone MPI_TRXN_ID format: 10 digits',
    cz_merchant_id VARCHAR(255) COMMENT 'Cardzone merchant ID: 600000000000001',
    cz_amount DECIMAL(10,2) COMMENT 'Transaction amount in MYR',
    cz_currency VARCHAR(3) DEFAULT 'MYR' COMMENT 'Currency code',
    cz_payment_method VARCHAR(50) COMMENT 'card, obw, qr',
    cz_status VARCHAR(50) DEFAULT 'pending' COMMENT 'pending, authenticated, authorized, failed, cancelled',
    
    -- =============================================================================
    -- CARD PAYMENT FIELDS (3DS)
    -- =============================================================================
    cz_card_number_masked VARCHAR(255) NULL COMMENT 'Masked card number',
    cz_card_expiry VARCHAR(10) NULL COMMENT 'Card expiry MM/YY',
    cz_card_holder_name VARCHAR(255) NULL COMMENT 'Cardholder name',
    cz_auth_value TEXT NULL COMMENT 'CAVV/AAV from 3DS',
    cz_eci VARCHAR(10) NULL COMMENT 'ECI from 3DS',
    
    -- =============================================================================
    -- ONLINE BANKING FIELDS (OBW)
    -- =============================================================================
    cz_obw_bank_code VARCHAR(50) NULL COMMENT 'Online banking bank code',
    
    -- =============================================================================
    -- QR PAYMENT FIELDS
    -- =============================================================================
    cz_qr_code_data TEXT NULL COMMENT 'QR string or URL',
    
    -- =============================================================================
    -- CARDZONE RESPONSE DATA
    -- =============================================================================
    cz_response_data JSON NULL COMMENT 'Raw JSON response from Cardzone',
    cz_response_code VARCHAR(50) NULL COMMENT 'Cardzone response code',
    cz_response_message VARCHAR(255) NULL COMMENT 'Cardzone response message',
    cz_response_received_at TIMESTAMP NULL COMMENT 'When response was received',
    
    -- =============================================================================
    -- TRANSACTION TRACKING
    -- =============================================================================
    cz_session_id VARCHAR(255) NULL COMMENT 'Cardzone session ID',
    cz_order_id VARCHAR(255) NULL COMMENT 'Cardzone order ID',
    cz_created_at TIMESTAMP NULL COMMENT 'Transaction creation time',
    cz_updated_at TIMESTAMP NULL COMMENT 'Transaction update time',
    
    -- =============================================================================
    -- RELATIONSHIP FIELDS
    -- =============================================================================
    donation_id BIGINT NULL COMMENT 'Link to donation',
    
    -- =============================================================================
    -- LARAVEL TIMESTAMPS
    -- =============================================================================
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- =============================================================================
    -- INDEXES FOR PERFORMANCE
    -- =============================================================================
    INDEX idx_cz_transaction_id (cz_transaction_id),
    INDEX idx_cz_merchant_id (cz_merchant_id),
    INDEX idx_cz_status (cz_status),
    INDEX idx_cz_payment_method (cz_payment_method),
    INDEX idx_cz_donation_id (donation_id),
    INDEX idx_cz_created_at (cz_created_at),
    INDEX idx_cz_response_code (cz_response_code),
    INDEX idx_cz_session_id (cz_session_id)
);
```

### **📋 Field Categories**

#### **1. Core Transaction Fields (`cz_*`)**
- **`cz_transaction_id`**: Unique Cardzone transaction identifier
- **`cz_merchant_id`**: Cardzone merchant ID (600000000000001)
- **`cz_amount`**: Transaction amount in MYR
- **`cz_currency`**: Currency code (default: MYR)
- **`cz_payment_method`**: Payment method (card, obw, qr)
- **`cz_status`**: Transaction status

#### **2. Card Payment Fields (3DS)**
- **`cz_card_number_masked`**: Masked card number for security
- **`cz_card_expiry`**: Card expiry date (MM/YY)
- **`cz_card_holder_name`**: Cardholder name
- **`cz_auth_value`**: CAVV/AAV from 3DS authentication
- **`cz_eci`**: ECI (Electronic Commerce Indicator) from 3DS

#### **3. Online Banking Fields (OBW)**
- **`cz_obw_bank_code`**: Bank code for online banking

#### **4. QR Payment Fields**
- **`cz_qr_code_data`**: QR code string or URL

#### **5. Response Data**
- **`cz_response_data`**: Raw JSON response from Cardzone
- **`cz_response_code`**: Cardzone response code
- **`cz_response_message`**: Cardzone response message
- **`cz_response_received_at`**: Response timestamp

#### **6. Transaction Tracking**
- **`cz_session_id`**: Cardzone session identifier
- **`cz_order_id`**: Cardzone order identifier
- **`cz_created_at`**: Transaction creation time
- **`cz_updated_at`**: Transaction update time

## 🏗️ **Paynet Transactions Table**

### **📊 Table Structure**

```sql
CREATE TABLE paynet_transactions (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    
    -- =============================================================================
    -- CORE TRANSACTION FIELDS (Paynet-specific)
    -- =============================================================================
    pn_transaction_id VARCHAR(255) UNIQUE COMMENT 'Paynet transaction ID format: PNT + timestamp + random + donation_id',
    pn_merchant_id VARCHAR(255) COMMENT 'Paynet merchant ID: EX00010946',
    pn_amount DECIMAL(10,2) COMMENT 'Transaction amount in MYR',
    pn_currency VARCHAR(3) DEFAULT 'MYR' COMMENT 'Currency code',
    pn_payment_method VARCHAR(50) COMMENT 'fpx, fpx_system',
    pn_status VARCHAR(50) DEFAULT 'pending' COMMENT 'pending, completed, failed, cancelled',
    
    -- =============================================================================
    -- PAYNET RESPONSE DATA
    -- =============================================================================
    pn_response_data JSON NULL COMMENT 'Raw JSON response from Paynet',
    pn_response_code VARCHAR(50) NULL COMMENT 'Paynet response code',
    pn_response_message VARCHAR(255) NULL COMMENT 'Paynet response message',
    pn_response_received_at TIMESTAMP NULL COMMENT 'When response was received',
    
    -- =============================================================================
    -- FPX MESSAGE TRACKING - AR (Authorization Request)
    -- =============================================================================
    pn_fpx_ar_message_data JSON NULL COMMENT 'AR message payload sent to FPX',
    pn_fpx_ar_sent_at TIMESTAMP NULL COMMENT 'When AR message was sent',
    pn_fpx_ar_status VARCHAR(50) NULL COMMENT 'sent, failed, success',
    pn_fpx_ar_response_code VARCHAR(10) NULL COMMENT 'AR response code from FPX',
    
    -- =============================================================================
    -- FPX MESSAGE TRACKING - AC (Acknowledgement)
    -- =============================================================================
    pn_fpx_ac_message_data JSON NULL COMMENT 'AC message payload received from FPX',
    pn_fpx_ac_received_at TIMESTAMP NULL COMMENT 'When AC message was received',
    pn_fpx_ac_status VARCHAR(50) NULL COMMENT 'received, processed, failed',
    pn_fpx_ac_response_code VARCHAR(10) NULL COMMENT 'AC response code: 00, FE, etc.',
    pn_fpx_ac_debit_auth_code VARCHAR(50) NULL COMMENT 'Debit authorization code',
    pn_fpx_ac_fpx_txn_id VARCHAR(255) NULL COMMENT 'FPX transaction ID',
    
    -- =============================================================================
    -- FPX MESSAGE TRACKING - BE (Bank Enquiry)
    -- =============================================================================
    pn_fpx_be_message_data JSON NULL COMMENT 'BE message payload sent to FPX',
    pn_fpx_be_sent_at TIMESTAMP NULL COMMENT 'When BE message was sent',
    pn_fpx_be_status VARCHAR(50) NULL COMMENT 'sent, failed, success',
    pn_fpx_be_response_code VARCHAR(10) NULL COMMENT 'BE response code from FPX',
    pn_fpx_be_bank_list TEXT NULL COMMENT 'Bank list response from FPX',
    
    -- =============================================================================
    -- FPX MESSAGE TRACKING - AE (Acknowledgement Enquiry)
    -- =============================================================================
    pn_fpx_ae_message_data JSON NULL COMMENT 'AE message payload sent to FPX',
    pn_fpx_ae_sent_at TIMESTAMP NULL COMMENT 'When AE message was sent',
    pn_fpx_ae_status VARCHAR(50) NULL COMMENT 'sent, failed, success',
    pn_fpx_ae_response_code VARCHAR(10) NULL COMMENT 'AE response code: 00, FE, etc.',
    pn_fpx_ae_txn_status VARCHAR(50) NULL COMMENT 'Transaction status from AE response',
    
    -- =============================================================================
    -- FPX MESSAGE SEQUENCE TRACKING
    -- =============================================================================
    pn_fpx_message_sequence VARCHAR(50) NULL COMMENT 'Track message flow: AR->AC, BE, AE',
    pn_fpx_last_message_type VARCHAR(10) NULL COMMENT 'Last message type sent/received',
    pn_fpx_last_message_at TIMESTAMP NULL COMMENT 'Last message timestamp',
    pn_fpx_error_log TEXT NULL COMMENT 'Store error details',
    
    -- =============================================================================
    -- FPX TRANSACTION DETAILS
    -- =============================================================================
    pn_fpx_seller_ex_id VARCHAR(255) NULL COMMENT 'Seller exchange ID',
    pn_fpx_seller_ex_order_no VARCHAR(255) NULL COMMENT 'Seller exchange order number',
    pn_fpx_seller_order_no VARCHAR(255) NULL COMMENT 'Seller order number',
    pn_fpx_seller_id VARCHAR(255) NULL COMMENT 'Seller ID',
    pn_fpx_seller_bank_code VARCHAR(10) NULL COMMENT 'Seller bank code',
    pn_fpx_buyer_bank_id VARCHAR(10) NULL COMMENT 'Buyer bank ID',
    pn_fpx_buyer_bank_branch VARCHAR(50) NULL COMMENT 'Buyer bank branch',
    pn_fpx_buyer_acc_no VARCHAR(50) NULL COMMENT 'Buyer account number',
    pn_fpx_buyer_id VARCHAR(255) NULL COMMENT 'Buyer ID',
    pn_fpx_buyer_name VARCHAR(255) NULL COMMENT 'Buyer name',
    pn_fpx_buyer_email VARCHAR(255) NULL COMMENT 'Buyer email',
    pn_fpx_buyer_iban VARCHAR(50) NULL COMMENT 'Buyer IBAN',
    pn_fpx_maker_name VARCHAR(255) NULL COMMENT 'Maker name',
    pn_fpx_product_desc VARCHAR(255) NULL COMMENT 'Product description',
    pn_fpx_version VARCHAR(10) NULL COMMENT 'FPX version',
    
    -- =============================================================================
    -- TRANSACTION TRACKING
    -- =============================================================================
    pn_session_id VARCHAR(255) NULL COMMENT 'Paynet session ID',
    pn_order_id VARCHAR(255) NULL COMMENT 'Paynet order ID',
    pn_created_at TIMESTAMP NULL COMMENT 'Transaction creation time',
    pn_updated_at TIMESTAMP NULL COMMENT 'Transaction update time',
    
    -- =============================================================================
    -- RELATIONSHIP FIELDS
    -- =============================================================================
    donation_id BIGINT NULL COMMENT 'Link to donation',
    
    -- =============================================================================
    -- LARAVEL TIMESTAMPS
    -- =============================================================================
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    -- =============================================================================
    -- INDEXES FOR PERFORMANCE
    -- =============================================================================
    INDEX idx_pn_transaction_id (pn_transaction_id),
    INDEX idx_pn_merchant_id (pn_merchant_id),
    INDEX idx_pn_status (pn_status),
    INDEX idx_pn_payment_method (pn_payment_method),
    INDEX idx_pn_donation_id (donation_id),
    INDEX idx_pn_created_at (pn_created_at),
    INDEX idx_pn_response_code (pn_response_code),
    INDEX idx_pn_fpx_last_message_type (pn_fpx_last_message_type),
    INDEX idx_pn_fpx_ar_status (pn_fpx_ar_status),
    INDEX idx_pn_fpx_ac_status (pn_fpx_ac_status),
    INDEX idx_pn_fpx_be_status (pn_fpx_be_status),
    INDEX idx_pn_fpx_ae_status (pn_fpx_ae_status),
    INDEX idx_pn_fpx_ac_response_code (pn_fpx_ac_response_code),
    INDEX idx_pn_fpx_ae_response_code (pn_fpx_ae_response_code)
);
```

### **📋 Field Categories**

#### **1. Core Transaction Fields (`pn_*`)**
- **`pn_transaction_id`**: Unique Paynet transaction identifier
- **`pn_merchant_id`**: Paynet merchant ID (EX00010946)
- **`pn_amount`**: Transaction amount in MYR
- **`pn_currency`**: Currency code (default: MYR)
- **`pn_payment_method`**: Payment method (fpx, fpx_system)
- **`pn_status`**: Transaction status

#### **2. Paynet Response Data**
- **`pn_response_data`**: Raw JSON response from Paynet
- **`pn_response_code`**: Paynet response code
- **`pn_response_message`**: Paynet response message
- **`pn_response_received_at`**: Response timestamp

#### **3. FPX Message Tracking - AR (Authorization Request)**
- **`pn_fpx_ar_message_data`**: AR message payload sent to FPX
- **`pn_fpx_ar_sent_at`**: When AR message was sent
- **`pn_fpx_ar_status`**: AR message status (sent, failed, success)
- **`pn_fpx_ar_response_code`**: AR response code from FPX

#### **4. FPX Message Tracking - AC (Acknowledgement)**
- **`pn_fpx_ac_message_data`**: AC message payload received from FPX
- **`pn_fpx_ac_received_at`**: When AC message was received
- **`pn_fpx_ac_status`**: AC message status (received, processed, failed)
- **`pn_fpx_ac_response_code`**: AC response code (00, FE, etc.)
- **`pn_fpx_ac_debit_auth_code`**: Debit authorization code
- **`pn_fpx_ac_fpx_txn_id`**: FPX transaction ID

#### **5. FPX Message Tracking - BE (Bank Enquiry)**
- **`pn_fpx_be_message_data`**: BE message payload sent to FPX
- **`pn_fpx_be_sent_at`**: When BE message was sent
- **`pn_fpx_be_status`**: BE message status (sent, failed, success)
- **`pn_fpx_be_response_code`**: BE response code from FPX
- **`pn_fpx_be_bank_list`**: Bank list response from FPX

#### **6. FPX Message Tracking - AE (Acknowledgement Enquiry)**
- **`pn_fpx_ae_message_data`**: AE message payload sent to FPX
- **`pn_fpx_ae_sent_at`**: When AE message was sent
- **`pn_fpx_ae_status`**: AE message status (sent, failed, success)
- **`pn_fpx_ae_response_code`**: AE response code (00, FE, etc.)
- **`pn_fpx_ae_txn_status`**: Transaction status from AE response

#### **7. FPX Message Sequence Tracking**
- **`pn_fpx_message_sequence`**: Track message flow (AR->AC, BE, AE)
- **`pn_fpx_last_message_type`**: Last message type sent/received
- **`pn_fpx_last_message_at`**: Last message timestamp
- **`pn_fpx_error_log`**: Store error details

#### **8. FPX Transaction Details**
- **Seller Details**: `pn_fpx_seller_*` fields
- **Buyer Details**: `pn_fpx_buyer_*` fields
- **Bank Details**: `pn_fpx_*_bank_*` fields
- **Product Details**: `pn_fpx_product_desc`, `pn_fpx_version`

#### **9. Transaction Tracking**
- **`pn_session_id`**: Paynet session identifier
- **`pn_order_id`**: Paynet order identifier
- **`pn_created_at`**: Transaction creation time
- **`pn_updated_at`**: Transaction update time

## 🎯 **Naming Convention Benefits**

### **✅ Clear Separation**
- **`cz_*`**: All Cardzone-related fields
- **`pn_*`**: All Paynet-related fields
- **No conflicts**: Field names never overlap between systems

### **✅ Easy Identification**
- **Quick recognition**: `cz_` prefix = Cardzone, `pn_` prefix = Paynet
- **Logical grouping**: Related fields grouped together
- **Clear documentation**: Each field has descriptive comments

### **✅ Scalable Structure**
- **Easy to extend**: New fields follow the same naming pattern
- **Independent evolution**: Each system can evolve separately
- **Clear ownership**: No confusion about which system owns which field

### **✅ Performance Optimized**
- **Targeted indexes**: Specific indexes for each payment system
- **Efficient queries**: Can query each system independently
- **Optimized storage**: Only relevant fields for each system

## 📊 **Usage Examples**

### **1. Creating Cardzone Transaction**
```php
$cardzoneTransaction = CardzoneTransaction::create([
    'cz_transaction_id' => '6487047256',
    'cz_merchant_id' => '600000000000001',
    'cz_amount' => 150.00,
    'cz_currency' => 'MYR',
    'cz_payment_method' => 'card',
    'cz_status' => 'pending',
    'cz_card_number_masked' => '****1234',
    'cz_card_holder_name' => 'John Doe',
    'donation_id' => $donation->id,
]);
```

### **2. Creating Paynet Transaction**
```php
$paynetTransaction = PaynetTransaction::create([
    'pn_transaction_id' => 'PNT2025011512345678901234567890001',
    'pn_merchant_id' => 'EX00010946',
    'pn_amount' => 150.00,
    'pn_currency' => 'MYR',
    'pn_payment_method' => 'fpx',
    'pn_status' => 'pending',
    'pn_fpx_seller_ex_id' => 'EX00010946',
    'pn_fpx_buyer_bank_id' => 'MBB',
    'donation_id' => $donation->id,
]);
```

### **3. Querying Transactions**
```php
// Cardzone queries
$pendingCardzone = CardzoneTransaction::pending()->get();
$completedCards = CardzoneTransaction::completed()->cardPayments()->get();

// Paynet queries
$pendingPaynet = PaynetTransaction::pending()->get();
$successfulAc = PaynetTransaction::successfulAc()->get();
$arMessages = PaynetTransaction::arMessages()->get();
```

## 🚀 **Migration Process**

### **1. Run New Migrations**
```bash
php artisan migrate --path=database/migrations/2025_01_15_000001_create_cardzone_transactions_table.php
php artisan migrate --path=database/migrations/2025_01_15_000002_create_paynet_transactions_table.php
```

### **2. Migrate Existing Data**
```bash
php artisan migrate --path=database/migrations/2025_01_15_000003_migrate_transactions_to_separate_tables.php
```

### **3. Verify Migration**
```bash
# Check Cardzone transactions
php artisan tinker
>>> App\Models\CardzoneTransaction::count()

# Check Paynet transactions
>>> App\Models\PaynetTransaction::count()
```

## 📈 **Benefits Summary**

### **✅ Organization**
- **Clear separation**: Cardzone and Paynet are completely separate
- **Logical grouping**: Related fields are grouped together
- **Easy maintenance**: Each system can be maintained independently

### **✅ Clarity**
- **No conflicts**: Field names never overlap
- **Clear ownership**: Each field belongs to a specific system
- **Easy identification**: Prefixes make system identification instant

### **✅ Performance**
- **Optimized indexes**: Specific indexes for each system
- **Efficient queries**: Can query each system independently
- **Better storage**: Only relevant fields for each system

### **✅ Scalability**
- **Easy extension**: New fields follow the same pattern
- **Independent evolution**: Each system can evolve separately
- **Future-proof**: Structure supports additional payment providers

The organized database structure provides **clear separation**, **better performance**, and **easier maintenance** for both Cardzone and Paynet payment systems! 🎉 