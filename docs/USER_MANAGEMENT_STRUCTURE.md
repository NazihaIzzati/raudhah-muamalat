# User Management Structure

## Overview

The user management system has been restructured to have two separate tables: `staff` and `donor`, both linked to the main `users` table for authentication. This provides better role separation and data organization while maintaining unified authentication.

## Database Structure

### 🔐 **Core Authentication Table**

#### Users Table
```sql
users
├── id (primary key)
├── name
├── email (unique)
├── email_verified_at
├── password
├── user_type (enum: 'staff', 'donor')
├── is_active (boolean)
├── last_login_at
├── remember_token
├── created_at
├── updated_at
└── deleted_at (soft delete)
```

### 👥 **Staff Management**

#### Staff Table
```sql
staff
├── id (primary key)
├── user_id (foreign key to users)
├── employee_id (unique)
├── position
├── department
├── phone
├── address
├── profile_picture
├── role (enum: 'hq', 'admin', 'manager', 'staff')
├── status (enum: 'active', 'inactive', 'suspended')
├── hire_date
├── termination_date
├── notes
├── created_at
├── updated_at
└── deleted_at (soft delete)
```

### 💰 **Donor Management**

#### Donors Table
```sql
donors
├── id (primary key)
├── user_id (foreign key to users)
├── donor_id (unique)
├── identification_number (IC/Passport/Company registration)
├── phone
├── address
├── profile_picture
├── donor_type (enum: 'individual', 'corporate', 'anonymous')
├── status (enum: 'active', 'inactive', 'suspended')
├── registration_date
├── total_donated (decimal)
├── donation_count (integer)
├── last_donation_date
├── newsletter_subscribed (boolean)
├── preferences (JSON)
├── notes
├── created_at
├── updated_at
└── deleted_at (soft delete)
```

## 🔗 **Relationships**

### **One-to-One Relationships**
- **users** ↔ **staff** (via user_id)
- **users** ↔ **donors** (via user_id)

### **One-to-Many Relationships**
- **staff** → **campaigns** (created_by)
- **staff** → **news** (created_by)
- **staff** → **events** (created_by)
- **donors** → **donations** (donor_id)

### **Many-to-Many Relationships**
- **donors** ↔ **campaigns** (via donations)

## 🎯 **User Types**

### **Staff Members**
- **HQ**: Headquarters/Executive level access
- **Admin**: Full system access and management
- **Manager**: Department/team management
- **Staff**: Basic operational access

### **Donors**
- **Individual**: Personal donors
- **Corporate**: Business/organization donors
- **Anonymous**: Anonymous donors

## 🔧 **Implementation Details**

### **Authentication Flow**
1. User logs in with email/password (users table)
2. System checks `user_type` field
3. Redirects to appropriate dashboard (staff or donor)
4. Loads profile data from respective table (staff or donors)

### **Registration Flow**
1. User registers with basic info (users table)
2. System creates profile in appropriate table (staff or donors)
3. Sets `user_type` field accordingly
4. Links records via foreign key

## 📊 **Data Organization**

### **Staff Data**
- **Employee Information**: ID, position, department
- **Contact Details**: Phone, address
- **Employment History**: Hire date, termination date
- **Role Management**: Admin, manager, staff levels
- **Status Tracking**: Active, inactive, suspended

### **Donor Data**
- **Donor Information**: ID, type, registration date
- **Identification**: IC/Passport/Company registration number
- **Contact Details**: Phone, address
- **Donation History**: Total donated, donation count, last donation
- **Preferences**: Newsletter subscription, preferences (JSON)
- **Status Tracking**: Active, inactive, suspended

## 🛠️ **Laravel Model Implementation**

### **User Model**
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
        'user_type',
        'is_active',
        'last_login_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Relationships
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function donor()
    {
        return $this->hasOne(Donor::class);
    }

    // Helper methods
    public function isStaff()
    {
        return $this->user_type === 'staff';
    }

    public function isDonor()
    {
        return $this->user_type === 'donor';
    }
}
```

### **Staff Model**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'employee_id',
        'position',
        'department',
        'phone',
        'address',
        'profile_picture',
        'role', // 'hq', 'admin', 'manager', 'staff'
        'status',
        'hire_date',
        'termination_date',
        'notes'
    ];

    protected $casts = [
        'hire_date' => 'date',
        'termination_date' => 'date'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'created_by');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'created_by');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'created_by');
    }
}
```

### **Donor Model**
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'donor_id',
        'identification_number',
        'phone',
        'address',
        'profile_picture',
        'donor_type',
        'status',
        'registration_date',
        'total_donated',
        'donation_count',
        'last_donation_date',
        'newsletter_subscribed',
        'preferences',
        'notes'
    ];

    protected $casts = [
        'registration_date' => 'date',
        'last_donation_date' => 'date',
        'total_donated' => 'decimal:2',
        'newsletter_subscribed' => 'boolean',
        'preferences' => 'array'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
```

## 🔄 **Migration Updates**

### **Updated Tables**
- **users**: Added `user_type`, `is_active`, `last_login_at`
- **donations**: Changed `user_id` to `donor_id`
- **campaigns**: Changed `created_by` to link to `staff`
- **news**: Changed `created_by` to link to `staff`
- **events**: Changed `created_by` to link to `staff`

### **New Tables**
- **staff**: Complete staff management
- **donors**: Complete donor management

## 🎯 **Benefits of This Structure**

### ✅ **Role Separation**
- Clear distinction between staff and donors
- Different data requirements for each type
- Specialized functionality for each role

### ✅ **Data Organization**
- Staff-specific data in staff table
- Donor-specific data in donors table
- Common authentication in users table

### ✅ **Scalability**
- Easy to add new user types
- Flexible role management
- Extensible structure

### ✅ **Security**
- Role-based access control
- Separate permissions for staff and donors
- Audit trail for each user type

### ✅ **Performance**
- Optimized queries for each user type
- Reduced data redundancy
- Efficient indexing

## 🔐 **Authentication & Authorization**

### **Login Process**
```php
// Check user type and redirect accordingly
if ($user->isStaff()) {
    return redirect()->route('staff.dashboard');
} else {
    return redirect()->route('donor.dashboard');
}
```

### **Role-Based Access**
```php
// Staff authorization
if (auth()->user()->isStaff() && auth()->user()->staff->role === 'hq') {
    // HQ/Executive access
} elseif (auth()->user()->isStaff() && auth()->user()->staff->role === 'admin') {
    // Admin access
}

// Donor authorization
if (auth()->user()->isDonor()) {
    // Donor access
}
```

## 📋 **Usage Examples**

### **Creating a Staff Member**
```php
$user = User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => Hash::make('password'),
    'user_type' => 'staff'
]);

$staff = Staff::create([
    'user_id' => $user->id,
    'employee_id' => 'EMP001',
    'position' => 'Manager',
    'department' => 'IT',
    'role' => 'manager' // 'hq', 'admin', 'manager', 'staff'
]);
```

### **Creating a Donor**
```php
$user = User::create([
    'name' => 'Jane Smith',
    'email' => 'jane@example.com',
    'password' => Hash::make('password'),
    'user_type' => 'donor'
]);

$donor = Donor::create([
    'user_id' => $user->id,
    'donor_id' => 'DON001',
    'identification_number' => '123456789012', // IC/Passport/Company registration
    'donor_type' => 'individual',
    'registration_date' => now()
]);
```

### **Querying Users**
```php
// Get all staff members
$staff = User::where('user_type', 'staff')->with('staff')->get();

// Get all donors
$donors = User::where('user_type', 'donor')->with('donor')->get();

// Get active staff
$activeStaff = Staff::where('status', 'active')->with('user')->get();
```

## 🎉 **Summary**

The new user management structure provides:

1. **✅ Clear Role Separation** - Staff and donors are distinct entities
2. **✅ Unified Authentication** - Single login system for all users
3. **✅ Specialized Data** - Each user type has relevant information
4. **✅ Scalable Architecture** - Easy to extend for new user types
5. **✅ Better Organization** - Logical data structure and relationships

This structure supports the complex requirements of a fundraising platform while maintaining clean, maintainable code. 