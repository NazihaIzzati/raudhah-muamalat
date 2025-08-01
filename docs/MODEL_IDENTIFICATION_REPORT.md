# Model Identification Report

## 📊 **Complete Model Inventory**

I have identified **17 models** in the application. Here's a comprehensive breakdown of each model and their current state:

## 🔧 **Core User Management Models**

### **1. User Model** - `app/Models/User.php` ✅ **UPDATED**
- **Status**: ✅ Updated to new structure
- **Purpose**: Core authentication for both staff and donors
- **Key Features**:
  - `user_type` enum ('staff', 'donor')
  - `is_active` boolean
  - `last_login_at` timestamp
  - Relationships to Staff and Donor profiles
- **Soft Deletes**: ✅ Yes
- **Relationships**: 
  - `hasOne(Staff::class)`
  - `hasOne(Donor::class)`

### **2. Staff Model** - `app/Models/Staff.php` ✅ **NEW**
- **Status**: ✅ Created with complete role management
- **Purpose**: Staff member profiles and management
- **Key Features**:
  - Role hierarchy: HQ > Admin > Manager > Staff
  - Employee management with hire/termination dates
  - Department and position tracking
  - Profile picture support
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(User::class)`
  - `hasMany(Campaign::class, 'created_by')`
  - `hasMany(News::class, 'created_by')`
  - `hasMany(Event::class, 'created_by')`

### **3. Donor Model** - `app/Models/Donor.php` ✅ **NEW**
- **Status**: ✅ Created with complete donor management
- **Purpose**: Donor profiles and donation tracking
- **Key Features**:
  - Donor types: individual, corporate, anonymous
  - Identification number support
  - Donation statistics tracking
  - Newsletter subscription
  - JSON preferences field
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(User::class)`
  - `hasMany(Donation::class)`

## 📝 **Content Management Models**

### **4. Campaign Model** - `app/Models/Campaign.php` ✅ **UPDATED**
- **Status**: ✅ Updated with QR code support
- **Purpose**: Fundraising campaigns management
- **Key Features**:
  - QR code image support (`qr_code_image`)
  - Goal and raised amount tracking
  - Featured image support
  - Campaign status management
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(Staff::class, 'created_by')`
  - `hasMany(Donation::class)`

### **5. Donation Model** - `app/Models/Donation.php` ✅ **UPDATED**
- **Status**: ✅ Updated with new relationships
- **Purpose**: Donation tracking and payment processing
- **Key Features**:
  - Links to Donor instead of User
  - Payment method and status tracking
  - Anonymous donation support
  - Transaction ID tracking
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(Donor::class)`
  - `belongsTo(Campaign::class)`
  - `hasOne(CardzoneTransaction::class, 'donation_id')`
  - `hasOne(PaynetTransaction::class, 'donation_id')`

### **6. News Model** - `app/Models/News.php` ✅ **UPDATED**
- **Status**: ✅ Updated with staff relationship
- **Purpose**: News articles management
- **Key Features**:
  - Content management with categories
  - Featured and published status
  - Display order support
  - Excerpt and content fields
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(Staff::class, 'created_by')`

### **7. Event Model** - `app/Models/Event.php` ✅ **UPDATED**
- **Status**: ✅ Updated with staff relationship and soft deletes
- **Purpose**: Events management
- **Key Features**:
  - Location and timing management
  - Registration system
  - Featured events support
  - Contact and social links
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(Staff::class, 'created_by')`

### **8. Contact Model** - `app/Models/Contact.php` ✅ **EXISTING**
- **Status**: ✅ Already has soft deletes
- **Purpose**: Contact form submissions
- **Key Features**:
  - Contact form management
  - Urgent flag support
  - Reply tracking
  - Status management
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(User::class, 'replied_by')` ⚠️ **NEEDS UPDATE**

### **9. FAQ Model** - `app/Models/Faq.php` ✅ **EXISTING**
- **Status**: ✅ Already has soft deletes
- **Purpose**: Frequently asked questions
- **Key Features**:
  - Category management
  - Featured FAQ support
  - Display order
  - Status management
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(User::class, 'created_by')` ⚠️ **NEEDS UPDATE**

### **10. Partner Model** - `app/Models/Partner.php` ✅ **EXISTING**
- **Status**: ✅ Already has soft deletes
- **Purpose**: Partner organizations
- **Key Features**:
  - Logo and URL management
  - Featured partner support
  - Display order
  - Status management
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(User::class, 'created_by')` ⚠️ **NEEDS UPDATE**

### **11. Poster Model** - `app/Models/Poster.php` ⚠️ **NEEDS UPDATE**
- **Status**: ⚠️ Missing soft deletes
- **Purpose**: Promotional posters
- **Key Features**:
  - Image management
  - Display period control
  - Campaign association
  - Display order
- **Soft Deletes**: ❌ No (needs to be added)
- **Relationships**:
  - `belongsTo(User::class, 'created_by')` ⚠️ **NEEDS UPDATE**
  - `belongsTo(Campaign::class)`

### **12. Notification Model** - `app/Models/Notification.php` ⚠️ **NEEDS UPDATE**
- **Status**: ⚠️ Missing soft deletes
- **Purpose**: User notifications
- **Key Features**:
  - Notification types and data
  - Read/unread status
  - Action URLs
  - Icon and color support
- **Soft Deletes**: ❌ No (needs to be added)
- **Relationships**:
  - `belongsTo(User::class)` ⚠️ **NEEDS UPDATE**

## 💳 **Payment System Models**

### **13. CardzoneTransaction Model** - `app/Models/CardzoneTransaction.php` ✅ **EXISTING**
- **Status**: ✅ Already has soft deletes
- **Purpose**: Cardzone payment processing
- **Key Features**:
  - 3DS card payments
  - Online banking (OBW)
  - QR payments
  - Comprehensive logging
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(Donation::class)`

### **14. PaynetTransaction Model** - `app/Models/PaynetTransaction.php` ✅ **EXISTING**
- **Status**: ✅ Already has soft deletes
- **Purpose**: Paynet/FPX payment processing
- **Key Features**:
  - FPX message tracking (AR, AC, BE, AE)
  - Bank status management
  - Transaction status queries
  - Comprehensive logging
- **Soft Deletes**: ✅ Yes
- **Relationships**:
  - `belongsTo(Donation::class)`

### **15. FpxBank Model** - `app/Models/FpxBank.php` ✅ **EXISTING**
- **Status**: ✅ Already has soft deletes
- **Purpose**: FPX bank management
- **Key Features**:
  - Bank status tracking
  - Display name management
  - Bank type classification
  - Active/inactive status
- **Soft Deletes**: ✅ Yes
- **Relationships**: None

### **16. CardzoneKey Model** - `app/Models/CardzoneKey.php` ✅ **EXISTING**
- **Status**: ✅ Already has soft deletes
- **Purpose**: Cardzone API key management
- **Key Features**:
  - Merchant ID and keys
  - Environment management
  - Active status tracking
- **Soft Deletes**: ✅ Yes
- **Relationships**: None

## ⚙️ **System Configuration Models**

### **17. Setting Model** - `app/Models/Setting.php` ✅ **EXISTING**
- **Status**: ✅ Already has soft deletes
- **Purpose**: Application settings
- **Key Features**:
  - General site settings
  - Payment configuration
  - Security settings
  - Notification preferences
- **Soft Deletes**: ✅ Yes
- **Relationships**: None

## ⚠️ **Issues Identified**

### **Models Needing Updates**

#### **1. Contact Model** - `app/Models/Contact.php`
- **Issue**: `replied_by` relationship still links to User instead of Staff
- **Fix Needed**: Update to `belongsTo(Staff::class, 'replied_by')`

#### **2. FAQ Model** - `app/Models/Faq.php`
- **Issue**: `created_by` relationship still links to User instead of Staff
- **Fix Needed**: Update to `belongsTo(Staff::class, 'created_by')`

#### **3. Partner Model** - `app/Models/Partner.php`
- **Issue**: `created_by` relationship still links to User instead of Staff
- **Fix Needed**: Update to `belongsTo(Staff::class, 'created_by')`

#### **4. Poster Model** - `app/Models/Poster.php`
- **Issue**: Missing soft deletes and wrong relationship
- **Fixes Needed**:
  - Add `SoftDeletes` trait
  - Update `created_by` to link to Staff
  - Add soft deletes to fillable fields

#### **5. Notification Model** - `app/Models/Notification.php`
- **Issue**: Missing soft deletes and wrong relationship
- **Fixes Needed**:
  - Add `SoftDeletes` trait
  - Update `user_id` relationship to link to User properly
  - Add soft deletes to fillable fields

## 📋 **Summary**

### **✅ Models Ready (12/17)**
1. **User** ✅ - Updated to new structure
2. **Staff** ✅ - New model with complete role management
3. **Donor** ✅ - New model with complete donor management
4. **Campaign** ✅ - Updated with QR code support
5. **Donation** ✅ - Updated with new relationships
6. **News** ✅ - Updated with staff relationship
7. **Event** ✅ - Updated with staff relationship and soft deletes
8. **Contact** ✅ - Has soft deletes (needs relationship update)
9. **FAQ** ✅ - Has soft deletes (needs relationship update)
10. **Partner** ✅ - Has soft deletes (needs relationship update)
11. **CardzoneTransaction** ✅ - Complete with soft deletes
12. **PaynetTransaction** ✅ - Complete with soft deletes
13. **FpxBank** ✅ - Complete with soft deletes
14. **CardzoneKey** ✅ - Complete with soft deletes
15. **Setting** ✅ - Complete with soft deletes

### **⚠️ Models Needing Updates (5/17)**
1. **Contact** ⚠️ - Needs relationship update
2. **FAQ** ⚠️ - Needs relationship update
3. **Partner** ⚠️ - Needs relationship update
4. **Poster** ⚠️ - Needs soft deletes and relationship update
5. **Notification** ⚠️ - Needs soft deletes and relationship update

### **🎯 Next Steps**
1. **Update relationship references** from User to Staff where appropriate
2. **Add soft deletes** to Poster and Notification models
3. **Verify all relationships** are correctly mapped
4. **Test model functionality** after updates

The models are mostly ready with only 5 models needing minor updates! 🚀 