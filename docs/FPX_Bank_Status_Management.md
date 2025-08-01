# FPX Bank Status Management

## 🎯 **Overview**

The FPX (Financial Process Exchange) bank status management system handles real-time bank availability, maintenance windows, and automatic status updates from Paynet's FPX gateway.

## 📊 **Database Structure**

### **FpxBank Model**
```php
// Location: app/Models/FpxBank.php
// Table: fpx_banks

Fields:
- bank_id (string): FPX Bank ID (e.g., MB2U0227)
- bank_name (string): Full bank name
- display_name (string): Display name for UI
- bank_status (boolean): Bank availability status
- bank_code (string): Bank code for FPX
- bank_type (string): Bank type (commercial, islamic, etc.)
- last_updated (timestamp): Last status update time
- is_active (boolean): Whether bank is active in system
```

### **Database Migration**
```php
// Location: database/migrations/2025_07_29_115858_create_fpx_banks_table.php

Schema::create('fpx_banks', function (Blueprint $table) {
    $table->id();
    $table->string('bank_id', 10)->unique();
    $table->string('bank_name', 100);
    $table->string('display_name', 100);
    $table->boolean('bank_status')->default(true);
    $table->string('bank_code', 10)->nullable();
    $table->string('bank_type', 20)->default('commercial');
    $table->timestamp('last_updated')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    
    // Indexes for performance
    $table->index('bank_id');
    $table->index('bank_status');
    $table->index('is_active');
});
```

## 🔄 **Bank Status Retrieval Process**

### **1. BE (Bank Enquiry) Message**
```php
// Location: app/Services/PaynetService.php
// Method: sendBankEnquiryMessage()

BE Message Structure:
- fpx_msgType: 'BE' (Bank Enquiry)
- fpx_msgToken: '01'
- fpx_sellerExId: Merchant ID
- fpx_version: '7.0'
- fpx_checkSum: Digital signature
```

### **2. Paynet Response Format**
```
Response Format: fpx_bankList=bank_id%7Estatus%2Cbank_id%7Estatus
Decoded Format: bank_id~status,bank_id~status

Status Values:
- 'A' = Available (Online)
- 'B' = Busy/Offline
```

### **3. Response Parsing**
```php
// Method: parseBankListResponse()

Process:
1. Parse URL-encoded response
2. Extract fpx_bankList parameter
3. Split by comma to get individual banks
4. Split each bank by tilde (~) to get bank_id and status
5. Update database with new status
```

## ⏰ **Maintenance Window Handling**

### **Maintenance Schedule**
- **Time**: Daily 12:00 AM - 1:00 AM
- **Duration**: 1 hour
- **Impact**: Some banks may be temporarily unavailable
- **Frequency**: Daily system maintenance

### **Maintenance Detection**
```php
private function isMaintenanceWindow()
{
    $now = Carbon::now();
    $maintenanceStart = Carbon::today()->setTime(0, 0); // 12:00 AM
    $maintenanceEnd = Carbon::today()->setTime(1, 0);   // 1:00 AM

    return $now->between($maintenanceStart, $maintenanceEnd);
}
```

### **Handling During Maintenance**
1. **Warning Display**: Show maintenance window warning
2. **Status Caching**: Use cached status from database
3. **Force Update**: Allow manual updates with `--force` flag
4. **User Notification**: Inform users about temporary unavailability

## 🛠️ **Commands for Bank Status Management**

### **1. Show Bank Status**
```bash
# Basic status
php artisan fpx:show-bank-status

# Detailed information
php artisan fpx:show-bank-status --detailed

# Refresh from Paynet
php artisan fpx:show-bank-status --refresh

# Show only offline banks
php artisan fpx:show-bank-status --offline-only
```

### **2. Update Bank Status**
```bash
# Normal update
php artisan fpx:update-bank-status

# Force update during maintenance
php artisan fpx:update-bank-status --force

# Detailed output
php artisan fpx:update-bank-status --detailed
```

## 📈 **Bank Status Summary**

### **Status Indicators**
- 🟢 **Online**: Bank is available for transactions
- 🔴 **Offline**: Bank is temporarily unavailable
- ⚠️ **Maintenance**: System maintenance in progress

### **Bank Types**
- **Commercial**: Traditional banks (Maybank, CIMB, etc.)
- **Islamic**: Islamic banks (Bank Islam, AmBank Islamic, etc.)
- **Government**: Government banks (BSN, Agro Bank)
- **Digital**: Digital banks (Boost, Touch n Go, GrabPay)
- **Test**: Test banks for development

## 🔧 **Implementation Details**

### **1. Bank Status Update Process**
```php
public function updateBankStatusFromFpx()
{
    // 1. Send BE message to Paynet
    $bankStatus = $this->sendBankEnquiryMessage();
    
    // 2. Parse response
    if ($bankStatus) {
        $updatedCount = 0;
        
        // 3. Update each bank in database
        foreach ($bankStatus as $bankId => $status) {
            $bank = FpxBank::findByBankId($bankId);
            if ($bank) {
                $bank->updateStatus($status);
                $updatedCount++;
            }
        }
        
        return $updatedCount;
    }
    
    return false;
}
```

### **2. Bank Model Methods**
```php
// Get active banks only
FpxBank::active()->get();

// Get online banks only
FpxBank::online()->get();

// Get offline banks only
FpxBank::offline()->get();

// Get banks for FPX integration
FpxBank::getBankListForFpx();
```

### **3. Status Update Method**
```php
public function updateStatus($status)
{
    $this->update([
        'bank_status' => $status === 'A', // 'A' = Available, 'B' = Busy
        'last_updated' => now()
    ]);
}
```

## 📊 **Sample Bank Data**

### **Commercial Banks**
```php
[
    'bank_id' => 'MB2U0227',
    'bank_name' => 'Maybank Berhad',
    'display_name' => 'Maybank',
    'bank_type' => 'commercial',
    'bank_status' => true,
    'last_updated' => '2025-07-29 12:01:29'
]
```

### **Islamic Banks**
```php
[
    'bank_id' => 'BIMB0340',
    'bank_name' => 'Bank Islam Malaysia Berhad',
    'display_name' => 'Bank Islam',
    'bank_type' => 'islamic',
    'bank_status' => true,
    'last_updated' => '2025-07-29 12:01:29'
]
```

## 🚀 **Usage Examples**

### **1. Get Latest Bank Status**
```php
// In your controller or service
$paynetService = new PaynetService();

// Update from Paynet
$updatedCount = $paynetService->updateBankStatusFromFpx();

// Get summary
$summary = $paynetService->getBankStatusSummary();

// Get active banks for payment
$activeBanks = FpxBank::getBankListForFpx();
```

### **2. Check Maintenance Window**
```php
$now = Carbon::now();
$maintenanceStart = Carbon::today()->setTime(0, 0);
$maintenanceEnd = Carbon::today()->setTime(1, 0);

if ($now->between($maintenanceStart, $maintenanceEnd)) {
    // Show maintenance warning
    $this->warn('FPX system maintenance in progress');
}
```

### **3. Display Bank List with Status**
```php
$banks = FpxBank::where('is_active', true)
    ->orderBy('display_name')
    ->get();

foreach ($banks as $bank) {
    $status = $bank->bank_status ? '🟢 Online' : '🔴 Offline';
    echo "{$bank->display_name}: {$status}\n";
}
```

## 🔄 **Automated Updates**

### **Scheduled Updates**
```php
// In app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    // Update bank status every 30 minutes
    $schedule->command('fpx:update-bank-status')
             ->everyThirtyMinutes()
             ->withoutOverlapping();
    
    // Force update after maintenance window
    $schedule->command('fpx:update-bank-status --force')
             ->dailyAt('01:05')
             ->withoutOverlapping();
}
```

### **Event-Driven Updates**
```php
// Update status when payment fails
Event::listen('payment.failed', function ($payment) {
    if ($payment->payment_method === 'fpx') {
        // Update bank status
        $paynetService = new PaynetService();
        $paynetService->updateBankStatusFromFpx();
    }
});
```

## 📋 **Best Practices**

### **1. Status Update Frequency**
- **Normal**: Every 30 minutes
- **During Maintenance**: Use cached status
- **After Maintenance**: Force update at 1:05 AM
- **On Payment Failure**: Immediate update

### **2. Error Handling**
- **Network Issues**: Use cached status
- **Invalid Response**: Log error and retry
- **Maintenance Window**: Show appropriate warnings
- **Database Errors**: Fallback to static list

### **3. User Experience**
- **Show Status**: Display online/offline indicators
- **Maintenance Warning**: Inform about maintenance window
- **Fallback Options**: Provide alternative payment methods
- **Real-time Updates**: Update status during payment process

## 🎉 **Summary**

The FPX bank status management system provides:

- ✅ **Real-time Status**: Live updates from Paynet
- ✅ **Maintenance Handling**: Proper handling of 12am maintenance
- ✅ **Database Storage**: Persistent status tracking
- ✅ **User-Friendly**: Clear status indicators
- ✅ **Automated Updates**: Scheduled status refresh
- ✅ **Error Recovery**: Fallback mechanisms
- ✅ **Comprehensive Logging**: Detailed audit trail

The system ensures users always have the most current bank availability information while gracefully handling maintenance windows and system outages. 