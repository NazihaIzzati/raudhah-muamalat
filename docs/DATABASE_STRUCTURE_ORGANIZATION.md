# Database Structure Organization

## Overview

The database structure has been reorganized into a logical, well-documented migration system. All migrations are now organized in a sequential order with clear naming conventions and comprehensive documentation.

## Migration Organization

### 1. Core System Tables (001_000000_create_core_tables.php)
**Purpose**: Foundation tables for Laravel application
- **users**: User authentication and profiles
- **password_reset_tokens**: Password reset functionality
- **sessions**: Session management
- **cache**: Application caching
- **jobs**: Queue job processing
- **failed_jobs**: Failed job tracking

### 2. User Extensions (002_000000_add_user_extensions.php)
**Purpose**: Extend user functionality
- **role**: User role management (admin, user)
- **phone**: Contact information
- **address**: User address
- **profile_picture**: User profile image
- **is_active**: Account status
- **last_login_at**: Login tracking

### 3. Content Management Tables (003_000000_create_content_management_tables.php)
**Purpose**: All content and business logic tables
- **campaigns**: Fundraising campaigns
- **donations**: Donation records
- **news**: News articles
- **events**: Events management
- **partners**: Partner organizations
- **faqs**: Frequently asked questions
- **contacts**: Contact form submissions
- **posters**: Promotional posters
- **notifications**: User notifications

### 4. Payment System Tables (004_000000_create_payment_system_tables.php)
**Purpose**: Complete payment processing system
- **cardzone_keys**: Cardzone API configuration
- **cardzone_transactions**: Cardzone payment processing
- **paynet_transactions**: Paynet/FPX payment processing
- **fpx_banks**: FPX bank list and status

### 5. System Settings (005_000000_create_system_settings_table.php)
**Purpose**: Application configuration
- **settings**: Global application settings

### 6. Soft Deletes (006_000000_add_soft_deletes_to_content_tables.php)
**Purpose**: Data retention and recovery
- Soft deletes for partners, faqs, and contacts tables

## Database Schema Details

### Core Tables

#### Users Table
```sql
users
├── id (primary key)
├── name
├── email (unique)
├── email_verified_at
├── password
├── remember_token
├── role (admin, user)
├── phone
├── address
├── profile_picture
├── is_active
├── last_login_at
├── created_at
└── updated_at
```

#### Campaigns Table
```sql
campaigns
├── id (primary key)
├── title
├── slug (unique)
├── description
├── content
├── featured_image
├── goal_amount
├── raised_amount
├── currency
├── start_date
├── end_date
├── status (draft, active, completed, cancelled)
├── created_by (foreign key to users)
├── created_at
└── updated_at
```

#### Donations Table
```sql
donations
├── id (primary key)
├── user_id (foreign key to users)
├── campaign_id (foreign key to campaigns)
├── donor_name
├── donor_email
├── donor_phone
├── amount
├── currency
├── payment_method
├── payment_status
├── transaction_id
├── message
├── is_anonymous
├── paid_at
├── created_at
└── updated_at
```

### Payment System Tables

#### Cardzone Transactions
```sql
cardzone_transactions
├── id (primary key)
├── cz_transaction_id (unique)
├── cz_merchant_id
├── cz_amount
├── cz_currency
├── cz_payment_method
├── cz_status
├── cz_card_number_masked
├── cz_card_expiry
├── cz_card_holder_name
├── cz_auth_value
├── cz_eci
├── cz_obw_bank_code
├── cz_qr_code_data
├── cz_response_data (json)
├── cz_response_code
├── cz_response_message
├── cz_response_received_at
├── cz_session_id
├── cz_order_id
├── cz_created_at
├── cz_updated_at
├── donation_id (foreign key)
├── created_at
└── updated_at
```

#### Paynet Transactions
```sql
paynet_transactions
├── id (primary key)
├── pn_transaction_id (unique)
├── pn_merchant_id
├── pn_amount
├── pn_currency
├── pn_payment_method
├── pn_status
├── pn_response_data (json)
├── pn_response_code
├── pn_response_message
├── pn_response_received_at
├── pn_fpx_ar_message_data (json)
├── pn_fpx_ar_sent_at
├── pn_fpx_ar_status
├── pn_fpx_ar_response_code
├── pn_fpx_ac_message_data (json)
├── pn_fpx_ac_received_at
├── pn_fpx_ac_status
├── pn_fpx_ac_response_code
├── pn_fpx_ac_debit_auth_code
├── pn_fpx_ac_fpx_txn_id
├── pn_fpx_be_message_data (json)
├── pn_fpx_be_sent_at
├── pn_fpx_be_status
├── pn_fpx_be_response_code
├── pn_fpx_be_bank_list
├── pn_fpx_ae_message_data (json)
├── pn_fpx_ae_sent_at
├── pn_fpx_ae_status
├── pn_fpx_ae_response_code
├── pn_fpx_ae_txn_status
├── pn_fpx_message_sequence
├── pn_fpx_last_message_type
├── pn_fpx_last_message_at
├── pn_fpx_error_log
├── pn_fpx_seller_ex_id
├── pn_fpx_seller_ex_order_no
├── pn_fpx_seller_order_no
├── pn_fpx_seller_id
├── pn_fpx_seller_bank_code
├── pn_fpx_buyer_bank_id
├── pn_fpx_buyer_bank_branch
├── pn_fpx_buyer_acc_no
├── pn_fpx_buyer_id
├── pn_fpx_buyer_name
├── pn_fpx_buyer_email
├── pn_fpx_buyer_iban
├── pn_fpx_maker_name
├── pn_fpx_product_desc
├── pn_fpx_version
├── pn_session_id
├── pn_order_id
├── pn_created_at
├── pn_updated_at
├── donation_id (foreign key)
├── created_at
└── updated_at
```

#### FPX Banks
```sql
fpx_banks
├── id (primary key)
├── bank_id (unique)
├── bank_name
├── display_name
├── bank_status
├── bank_type
├── last_updated
├── is_active
├── created_at
└── updated_at
```

## Key Features

### 1. Comprehensive Payment Tracking
- **Cardzone Integration**: Complete 3DS card payment processing
- **Paynet/FPX Integration**: Full FPX banking integration with message tracking
- **Transaction History**: Detailed transaction logs for debugging and reconciliation

### 2. Content Management
- **Campaign Management**: Fundraising campaigns with goals and progress tracking
- **Donation Tracking**: Complete donation records with payment status
- **News & Events**: Content management for news articles and events
- **Partner Management**: Partner organization management
- **FAQ System**: Frequently asked questions with categorization

### 3. User Management
- **Role-based Access**: Admin and user roles
- **Profile Management**: Extended user profiles
- **Notification System**: User notification tracking

### 4. System Configuration
- **Global Settings**: Centralized application configuration
- **Payment Settings**: Payment method configuration
- **Security Settings**: Security and authentication settings

### 5. Data Integrity
- **Foreign Key Constraints**: Proper relationship management
- **Soft Deletes**: Data retention for important tables
- **Indexes**: Performance optimization for frequently queried fields

## Migration Execution Order

1. **001_000000_create_core_tables.php** - Foundation tables
2. **002_000000_add_user_extensions.php** - User extensions
3. **003_000000_create_content_management_tables.php** - Business logic tables
4. **004_000000_create_payment_system_tables.php** - Payment processing
5. **005_000000_create_system_settings_table.php** - Configuration
6. **006_000000_add_soft_deletes_to_content_tables.php** - Data retention

## Benefits of This Organization

1. **Logical Flow**: Migrations follow a logical dependency order
2. **Clear Documentation**: Each migration has comprehensive documentation
3. **Maintainability**: Easy to understand and modify
4. **Scalability**: Structure supports future enhancements
5. **Performance**: Optimized indexes and relationships
6. **Data Integrity**: Proper constraints and relationships

## Backup and Recovery

All original migrations have been backed up to `database/migrations/backup/` directory for reference and rollback purposes.

## Next Steps

1. **Run Migrations**: Execute the new organized migrations
2. **Update Models**: Ensure models reflect the new structure
3. **Test Relationships**: Verify all foreign key relationships work correctly
4. **Update Seeders**: Update database seeders to match new structure
5. **Documentation**: Update application documentation to reflect changes 