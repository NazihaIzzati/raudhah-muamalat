# Staff Role HQ Update

## ✅ **Update Complete**

The staff table has been updated to include the "hq" role for headquarters/executive level access.

## 🔧 **Changes Made**

### **Database Schema Update**

#### **Updated Staff Role Enum**
```sql
role (enum: 'hq', 'admin', 'manager', 'staff')
```

**New Role Added**: `hq` (Headquarters/Executive level)

**Updated Role Hierarchy**:
1. **HQ** - Headquarters/Executive level access
2. **Admin** - Full system access and management
3. **Manager** - Department/team management
4. **Staff** - Basic operational access

## 📊 **Updated Staff Table Structure**

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
├── role (enum: 'hq', 'admin', 'manager', 'staff') - UPDATED
├── status (enum: 'active', 'inactive', 'suspended')
├── hire_date
├── termination_date
├── notes
├── created_at
├── updated_at
└── deleted_at (soft delete)
```

## 🎯 **Role Hierarchy & Permissions**

### **HQ (Headquarters/Executive)**
- **Access Level**: Highest level access
- **Permissions**: 
  - Full system access
  - Executive reporting
  - Strategic decision making
  - Override admin permissions
  - System configuration
  - User management
  - Financial oversight

### **Admin**
- **Access Level**: High level access
- **Permissions**:
  - Full system access and management
  - User management
  - Content management
  - Payment processing oversight
  - System configuration

### **Manager**
- **Access Level**: Department level access
- **Permissions**:
  - Department/team management
  - Content creation and management
  - Donor management
  - Campaign oversight
  - Reporting access

### **Staff**
- **Access Level**: Basic operational access
- **Permissions**:
  - Basic operational tasks
  - Content creation
  - Donor interaction
  - Campaign support

## 🛠️ **Laravel Model Update**

### **Updated Staff Model Fillable Fields**
```php
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
```

## 🎯 **Usage Examples**

### **Creating an HQ Staff Member**
```php
$staff = Staff::create([
    'user_id' => $user->id,
    'employee_id' => 'EMP001',
    'position' => 'Executive Director',
    'department' => 'Executive',
    'role' => 'hq'
]);
```

### **Role-Based Authorization**
```php
// HQ/Executive authorization
if (auth()->user()->isStaff() && auth()->user()->staff->role === 'hq') {
    // HQ/Executive access
    return redirect()->route('hq.dashboard');
} elseif (auth()->user()->isStaff() && auth()->user()->staff->role === 'admin') {
    // Admin access
    return redirect()->route('admin.dashboard');
} elseif (auth()->user()->isStaff() && auth()->user()->staff->role === 'manager') {
    // Manager access
    return redirect()->route('manager.dashboard');
} else {
    // Staff access
    return redirect()->route('staff.dashboard');
}
```

### **Querying by Role**
```php
// Get all HQ staff
$hqStaff = Staff::where('role', 'hq')->with('user')->get();

// Get all executive level staff (HQ and Admin)
$executiveStaff = Staff::whereIn('role', ['hq', 'admin'])->with('user')->get();

// Check if user is HQ
if (auth()->user()->staff->role === 'hq') {
    // Grant executive access
}
```

## 🔐 **Security & Access Control**

### **Role-Based Access Control (RBAC)**
```php
// Middleware for HQ access
public function handle($request, Closure $next)
{
    if (auth()->check() && auth()->user()->isStaff()) {
        if (auth()->user()->staff->role === 'hq') {
            return $next($request);
        }
    }
    
    return redirect()->route('unauthorized');
}
```

### **Permission Levels**
- **HQ**: Full system access + executive privileges
- **Admin**: Full system access
- **Manager**: Department-level access
- **Staff**: Basic operational access

## 📋 **Implementation Benefits**

### ✅ **Enhanced Role Hierarchy**
- **Executive Level**: HQ role for top-level access
- **Clear Hierarchy**: Defined role progression
- **Flexible Permissions**: Role-based access control
- **Scalable Structure**: Easy to add more roles

### ✅ **Better Access Control**
- **Executive Oversight**: HQ can oversee all operations
- **Strategic Access**: Executive-level reporting and decisions
- **Security**: Proper role-based authorization
- **Audit Trail**: Track access by role level

### ✅ **Organizational Structure**
- **Clear Roles**: Defined responsibilities for each role
- **Hierarchical Access**: Proper access levels
- **Management Structure**: Support for organizational hierarchy
- **Executive Functions**: Support for executive-level operations

## 🎉 **Summary**

The HQ role has been successfully added to the staff table, providing:

1. **✅ Executive Level Access** - Headquarters/Executive role
2. **✅ Enhanced Hierarchy** - Clear role progression (HQ > Admin > Manager > Staff)
3. **✅ Better Access Control** - Role-based authorization system
4. **✅ Organizational Support** - Support for executive-level operations
5. **✅ Scalable Structure** - Easy to extend with more roles

This update enhances the staff management system with proper executive-level access while maintaining clear role hierarchy and security. 