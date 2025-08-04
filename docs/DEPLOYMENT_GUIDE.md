# Deployment Guide - Database Restructuring & View Updates

## 🚀 **Production Deployment Guide**

This guide provides step-by-step instructions for deploying the updated Laravel application with the new database structure and enhanced features.

## 📋 **Pre-Deployment Checklist**

### **✅ Environment Requirements**
- **PHP**: 8.1 or higher
- **Laravel**: 10.x
- **Database**: MySQL 8.0+ or PostgreSQL 13+
- **Storage**: File storage for QR code uploads
- **Memory**: Minimum 512MB RAM
- **Disk Space**: At least 1GB available

### **✅ Backup Requirements**
- **Database Backup**: Complete backup of existing database
- **File Backup**: Backup of uploaded files and images
- **Code Backup**: Backup of current codebase
- **Configuration Backup**: Backup of environment files

## 🔧 **Deployment Steps**

### **Step 1: Environment Preparation**

#### **1.1 Update Environment Variables**
```bash
# .env file updates
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

# File storage configuration
FILESYSTEM_DISK=public
```

#### **1.2 Install Dependencies**
```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node.js dependencies (if using frontend assets)
npm install
npm run build
```

### **Step 2: Database Migration**

#### **2.1 Backup Existing Database**
```bash
# Create database backup
mysqldump -u username -p database_name > backup_before_migration.sql

# Or for PostgreSQL
pg_dump -U username database_name > backup_before_migration.sql
```

#### **2.2 Run New Migrations**
```bash
# Run migrations
php artisan migrate

# If you need to rollback and re-run
php artisan migrate:rollback
php artisan migrate
```

#### **2.3 Verify Database Structure**
```bash
# Check migration status
php artisan migrate:status

# Verify tables exist
php artisan tinker --execute="echo 'Users: ' . DB::table('users')->count(); echo 'Staff: ' . DB::table('staff')->count(); echo 'Donors: ' . DB::table('donors')->count();"
```

### **Step 3: File Storage Setup**

#### **3.1 Create Storage Links**
```bash
# Create symbolic link for public storage
php artisan storage:link

# Verify storage link
ls -la public/storage
```

#### **3.2 Set Permissions**
```bash
# Set proper permissions for storage
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# Set ownership (if needed)
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
```

### **Step 4: Cache Optimization**

#### **4.1 Clear and Rebuild Caches**
```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Rebuild caches for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### **4.2 Optimize Application**
```bash
# Optimize autoloader
composer dump-autoload --optimize

# Optimize application
php artisan optimize
```

### **Step 5: Data Migration (If Applicable)**

#### **5.1 Migrate Existing User Data**
If you have existing users, you'll need to migrate them to the new structure:

```php
// Create a migration script
php artisan make:command MigrateExistingUsers

// In the command file:
public function handle()
{
    $oldUsers = DB::table('users')->whereNull('user_type')->get();
    
    foreach ($oldUsers as $user) {
        // Determine user type based on existing data
        $userType = $this->determineUserType($user);
        
        // Update user with new structure
        DB::table('users')->where('id', $user->id)->update([
            'user_type' => $userType,
            'is_active' => $user->status === 'active' ? 1 : 0
        ]);
        
        // Create type-specific profile
        if ($userType === 'staff') {
            DB::table('staff')->insert([
                'user_id' => $user->id,
                'employee_id' => 'EMP' . $user->id,
                'role' => $user->role ?? 'staff',
                'status' => 'active'
            ]);
        } elseif ($userType === 'donor') {
            DB::table('donors')->insert([
                'user_id' => $user->id,
                'donor_id' => 'DON' . $user->id,
                'donor_type' => 'individual',
                'status' => 'active'
            ]);
        }
    }
}
```

#### **5.2 Run Data Migration**
```bash
# Run the migration command
php artisan migrate:existing-users
```

### **Step 6: Testing Deployment**

#### **6.1 Test Database Connections**
```bash
# Test database connection
php artisan tinker --execute="echo 'Database connection: ' . (DB::connection()->getPdo() ? 'OK' : 'FAILED');"

# Test model loading
php artisan tinker --execute="echo 'User model: ' . (new App\Models\User() ? 'OK' : 'FAILED');"
```

#### **6.2 Test Routes and Controllers**
```bash
# Test route accessibility
php artisan route:list --name=admin.users

# Test view compilation
php artisan view:clear
php artisan view:cache
```

#### **6.3 Test File Uploads**
```bash
# Test storage functionality
php artisan tinker --execute="echo 'Storage test: ' . (Storage::disk('public')->put('test.txt', 'test') ? 'OK' : 'FAILED');"
```

## 🔍 **Post-Deployment Verification**

### **✅ Database Verification**
- [ ] All tables created successfully
- [ ] Foreign key relationships established
- [ ] Soft delete columns present
- [ ] QR code field in campaigns table
- [ ] User type fields in users table

### **✅ Model Verification**
- [ ] User model loads without errors
- [ ] Staff model loads without errors
- [ ] Donor model loads without errors
- [ ] Campaign model loads without errors
- [ ] All relationships working correctly

### **✅ Controller Verification**
- [ ] User management routes accessible
- [ ] Campaign management routes accessible
- [ ] Donation management routes accessible
- [ ] File upload functionality working
- [ ] Form validation working

### **✅ View Verification**
- [ ] Admin views render correctly
- [ ] User management forms working
- [ ] QR code upload and display working
- [ ] Dynamic form sections working
- [ ] JavaScript functionality working

### **✅ Feature Verification**
- [ ] User type selection working
- [ ] Staff/donor profile creation working
- [ ] QR code upload and display working
- [ ] Soft delete functionality working
- [ ] Status management working

## 🚨 **Rollback Plan**

### **If Issues Occur**

#### **1. Database Rollback**
```bash
# Rollback migrations
php artisan migrate:rollback --step=5

# Restore database backup
mysql -u username -p database_name < backup_before_migration.sql
```

#### **2. Code Rollback**
```bash
# Revert to previous code version
git checkout previous-commit-hash

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

#### **3. File Storage Rollback**
```bash
# Remove storage link
rm public/storage

# Restore file backup
cp -r backup/storage/* storage/app/public/
```

## 📊 **Performance Monitoring**

### **✅ Monitor These Metrics**
- **Database Performance**: Query execution times
- **File Upload Performance**: QR code upload speeds
- **Memory Usage**: Application memory consumption
- **Response Times**: Page load times
- **Error Rates**: Application error logs

### **✅ Key Monitoring Points**
- **User Creation**: Monitor staff/donor creation process
- **QR Code Uploads**: Monitor file upload performance
- **Form Submissions**: Monitor dynamic form behavior
- **Database Queries**: Monitor relationship queries

## 🔐 **Security Considerations**

### **✅ Security Checklist**
- [ ] File upload validation implemented
- [ ] CSRF protection enabled
- [ ] Input validation working
- [ ] User permissions configured
- [ ] SQL injection protection active

### **✅ File Upload Security**
```php
// Ensure proper file validation
'qr_code_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
```

## 📚 **Documentation**

### **✅ Post-Deployment Documentation**
- [ ] Update user manuals
- [ ] Update admin guides
- [ ] Update API documentation
- [ ] Update troubleshooting guides

### **✅ Training Materials**
- [ ] Staff training on new user management
- [ ] Admin training on QR code features
- [ ] User training on new interface

## 🎉 **Deployment Success**

**Once all verification steps are complete, the deployment is successful!**

### **✅ Success Indicators**
- All database migrations completed
- All models and controllers working
- All views rendering correctly
- All features functioning properly
- No critical errors in logs

### **✅ Next Steps**
- Monitor application performance
- Gather user feedback
- Plan future enhancements
- Schedule regular maintenance

**The enhanced Laravel application is now ready for production use!** 🚀 