# Soft Delete Implementation

## Overview

All tables in the database now have soft delete functionality implemented. This means that when records are "deleted," they are not actually removed from the database but are marked as deleted with a `deleted_at` timestamp.

## Implementation Details

### ✅ **Tables with Soft Deletes**

All tables in the database now include soft delete functionality:

#### Core System Tables
- **users** - User accounts with soft delete
- **password_reset_tokens** - No soft delete (temporary tokens)
- **sessions** - No soft delete (temporary sessions)
- **cache** - No soft delete (temporary cache)
- **jobs** - No soft delete (queue jobs)
- **failed_jobs** - No soft delete (failed queue jobs)

#### Content Management Tables
- **campaigns** - Fundraising campaigns with soft delete
- **donations** - Donation records with soft delete
- **news** - News articles with soft delete
- **events** - Events with soft delete
- **partners** - Partner organizations with soft delete
- **faqs** - Frequently asked questions with soft delete
- **contacts** - Contact form submissions with soft delete
- **posters** - Promotional posters with soft delete
- **notifications** - User notifications with soft delete

#### Payment System Tables
- **cardzone_keys** - Cardzone API configuration with soft delete
- **cardzone_transactions** - Cardzone payment transactions with soft delete
- **paynet_transactions** - Paynet/FPX payment transactions with soft delete
- **fpx_banks** - FPX bank list with soft delete

#### System Configuration Tables
- **settings** - Application settings with soft delete

### 🔧 **Migration Implementation**

Soft deletes are implemented directly in the table creation migrations:

#### Example Implementation
```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
    $table->softDeletes(); // Soft delete implementation
});
```

### 📊 **Database Schema**

Each table with soft deletes includes:
- `id` - Primary key
- `created_at` - Record creation timestamp
- `updated_at` - Record update timestamp
- `deleted_at` - Soft delete timestamp (nullable)

### 🎯 **Benefits of Soft Deletes**

#### ✅ **Data Recovery**
- Deleted records can be restored
- No permanent data loss
- Audit trail maintained

#### ✅ **Referential Integrity**
- Foreign key relationships preserved
- No orphaned records
- Data consistency maintained

#### ✅ **Audit Trail**
- Complete history of all records
- Track when records were deleted
- Compliance with data retention policies

#### ✅ **Business Logic**
- Maintain historical data for reporting
- Preserve important business records
- Support for data analysis

### 🔄 **Laravel Model Implementation**

To use soft deletes in your models, add the `SoftDeletes` trait:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        // ... other fields
    ];
}
```

### 🛠️ **Usage Examples**

#### Deleting Records
```php
// Soft delete a record
$user = User::find(1);
$user->delete(); // Sets deleted_at timestamp

// Force delete a record (permanent)
$user->forceDelete(); // Actually removes from database
```

#### Querying Records
```php
// Get only active records (default)
$users = User::all(); // Excludes soft deleted records

// Include soft deleted records
$users = User::withTrashed()->get();

// Get only soft deleted records
$users = User::onlyTrashed()->get();
```

#### Restoring Records
```php
// Restore a soft deleted record
$user = User::onlyTrashed()->find(1);
$user->restore(); // Removes deleted_at timestamp

// Restore multiple records
User::onlyTrashed()->restore();
```

### 📋 **Migration Files Updated**

#### Core Tables Migration
- **`001_000000_create_core_tables.php`** - Added soft deletes to users table

#### Content Management Migration
- **`003_000000_create_content_management_tables.php`** - Added soft deletes to all content tables:
  - campaigns
  - donations
  - news
  - events
  - partners
  - faqs
  - contacts
  - posters
  - notifications

#### Payment System Migration
- **`004_000000_create_payment_system_tables.php`** - Added soft deletes to all payment tables:
  - cardzone_keys
  - cardzone_transactions
  - paynet_transactions
  - fpx_banks

#### System Settings Migration
- **`005_000000_create_system_settings_table.php`** - Added soft deletes to settings table

#### Soft Deletes Migration
- **`006_000000_add_soft_deletes_to_content_tables.php`** - Updated to handle future tables

### 🎯 **Tables Without Soft Deletes**

Some tables intentionally don't have soft deletes:

#### Temporary/System Tables
- **password_reset_tokens** - Temporary tokens that should be deleted
- **sessions** - Temporary session data
- **cache** - Temporary cache data
- **jobs** - Queue jobs that are processed and deleted
- **failed_jobs** - Failed jobs for debugging

### 🔍 **Querying Soft Deleted Records**

#### Basic Queries
```php
// Normal query (excludes soft deleted)
$users = User::where('email', 'like', '%@example.com')->get();

// Include soft deleted records
$users = User::withTrashed()->where('email', 'like', '%@example.com')->get();

// Only soft deleted records
$users = User::onlyTrashed()->where('email', 'like', '%@example.com')->get();
```

#### Advanced Queries
```php
// Check if record is soft deleted
$user = User::withTrashed()->find(1);
if ($user->trashed()) {
    echo "User is soft deleted";
}

// Get count of soft deleted records
$deletedCount = User::onlyTrashed()->count();

// Restore all soft deleted users
User::onlyTrashed()->restore();
```

### 🛡️ **Data Integrity**

#### Foreign Key Relationships
- Soft deleted parent records don't affect child records
- Child records maintain their foreign key references
- No orphaned records created

#### Cascade Behavior
- Soft deletes don't cascade by default
- Child records remain active when parent is soft deleted
- Manual handling required for business logic

### 📊 **Performance Considerations**

#### Indexes
- `deleted_at` column is automatically indexed
- Queries excluding soft deleted records are optimized
- Consider additional indexes for frequently queried fields

#### Storage
- Soft deleted records consume storage space
- Consider periodic cleanup of old soft deleted records
- Implement data retention policies

### 🔄 **Maintenance**

#### Periodic Cleanup
```php
// Clean up soft deleted records older than 1 year
$cutoffDate = now()->subYear();
User::onlyTrashed()->where('deleted_at', '<', $cutoffDate)->forceDelete();
```

#### Data Retention Policy
- Implement business rules for data retention
- Consider legal requirements for data retention
- Document cleanup procedures

### 🎉 **Summary**

All business-critical tables now have soft delete functionality implemented. This provides:

1. **Data Safety** - No permanent data loss
2. **Audit Trail** - Complete record history
3. **Recovery Options** - Ability to restore deleted records
4. **Business Continuity** - Maintain referential integrity
5. **Compliance** - Support for data retention policies

The implementation follows Laravel best practices and provides a robust foundation for data management in your application. 