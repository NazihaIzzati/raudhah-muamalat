# Campaign QR Code Feature

## ✅ **Feature Added Successfully**

The campaigns table now includes a QR code image field for admin uploads, enabling easy payment/donation QR codes for each campaign.

## 🔧 **Database Schema Update**

### **New Field Added to Campaigns Table**
```sql
qr_code_image (string, nullable) - QR code image for payment/donation
```

### **Updated Campaigns Table Structure**
```sql
campaigns
├── id (primary key)
├── title
├── slug (unique)
├── description
├── content
├── featured_image
├── qr_code_image ✅ NEW FIELD
├── goal_amount (decimal)
├── raised_amount (decimal)
├── currency
├── start_date
├── end_date
├── status
├── created_by (foreign key to staff)
├── timestamps
└── softDeletes
```

## 🎯 **Feature Purpose**

### **QR Code Image Usage**
- **Payment QR Codes**: Upload QR codes for DuitNow, FPX, or other payment methods
- **Donation QR Codes**: Direct donation QR codes for each campaign
- **Campaign-Specific**: Each campaign can have its own unique QR code
- **Admin Upload**: Staff can upload QR code images through admin panel

### **Benefits**
- **Easy Payment**: Donors can scan QR codes directly from campaign pages
- **Multiple Payment Methods**: Support for various QR payment systems
- **Campaign Tracking**: Track donations through specific campaign QR codes
- **User Experience**: Seamless donation process with QR scanning

## 🛠️ **Laravel Model Implementation**

### **Updated Campaign Model**
```php
class Campaign extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'qr_code_image', // NEW FIELD
        'goal_amount',
        'raised_amount',
        'currency',
        'start_date',
        'end_date',
        'status',
        'created_by'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'goal_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
    ];
}
```

### **File Upload Handling**
```php
// In CampaignController
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'slug' => 'required|string|unique:campaigns',
        'description' => 'required|string',
        'content' => 'nullable|string',
        'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'qr_code_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // NEW VALIDATION
        'goal_amount' => 'required|numeric|min:0',
        'currency' => 'required|string|max:3',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after:start_date',
        'status' => 'required|in:draft,active,completed,cancelled'
    ]);

    // Handle QR code image upload
    if ($request->hasFile('qr_code_image')) {
        $qrCodePath = $request->file('qr_code_image')->store('campaigns/qr-codes', 'public');
        $validated['qr_code_image'] = $qrCodePath;
    }

    $validated['created_by'] = auth()->user()->staff->id;
    
    Campaign::create($validated);
}
```

## 🎨 **Frontend Implementation**

### **QR Code Display**
```php
// In campaign view
@if($campaign->qr_code_image)
    <div class="qr-code-section">
        <h3>Scan QR Code to Donate</h3>
        <img src="{{ Storage::url($campaign->qr_code_image) }}" 
             alt="QR Code for {{ $campaign->title }}" 
             class="qr-code-image">
        <p>Scan this QR code with your mobile banking app to donate</p>
    </div>
@endif
```

### **Admin Upload Form**
```php
// In campaign create/edit form
<div class="form-group">
    <label for="qr_code_image">QR Code Image</label>
    <input type="file" 
           name="qr_code_image" 
           id="qr_code_image" 
           class="form-control @error('qr_code_image') is-invalid @enderror"
           accept="image/*">
    <small class="form-text text-muted">
        Upload QR code image for payment/donation (JPEG, PNG, GIF, max 2MB)
    </small>
    @error('qr_code_image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if(isset($campaign) && $campaign->qr_code_image)
    <div class="current-qr-code">
        <label>Current QR Code:</label>
        <img src="{{ Storage::url($campaign->qr_code_image) }}" 
             alt="Current QR Code" 
             style="max-width: 200px;">
    </div>
@endif
```

## 📱 **QR Code Types Supported**

### **Payment QR Codes**
- **DuitNow QR**: Malaysian instant payment QR codes
- **FPX QR**: Financial Process Exchange QR codes
- **Bank QR**: Individual bank QR codes
- **E-Wallet QR**: Touch 'n Go, Boost, etc.

### **Donation QR Codes**
- **Campaign-Specific**: Unique QR codes for each campaign
- **Amount-Specific**: QR codes with pre-set donation amounts
- **Dynamic QR**: QR codes that can be updated with amounts

## 🔐 **Security Considerations**

### **File Upload Security**
- **File Type Validation**: Only image files allowed
- **File Size Limits**: Maximum 2MB per QR code image
- **Storage Security**: Files stored in secure public directory
- **Access Control**: Only authorized staff can upload QR codes

### **QR Code Security**
- **HTTPS URLs**: Ensure QR codes point to secure URLs
- **Validation**: Verify QR code content before upload
- **Monitoring**: Track QR code usage and donations
- **Backup**: Regular backup of QR code images

## 📊 **Usage Examples**

### **Creating Campaign with QR Code**
```php
$campaign = Campaign::create([
    'title' => 'Emergency Relief Fund',
    'slug' => 'emergency-relief-fund',
    'description' => 'Help victims of natural disasters',
    'qr_code_image' => 'campaigns/qr-codes/emergency-relief-qr.jpg',
    'goal_amount' => 50000.00,
    'currency' => 'MYR',
    'start_date' => now(),
    'status' => 'active',
    'created_by' => auth()->user()->staff->id
]);
```

### **Querying Campaigns with QR Codes**
```php
// Get all campaigns with QR codes
$campaignsWithQR = Campaign::whereNotNull('qr_code_image')->get();

// Get QR code URL for a campaign
$qrCodeUrl = Storage::url($campaign->qr_code_image);
```

### **QR Code Validation**
```php
// Validate QR code image
$request->validate([
    'qr_code_image' => [
        'nullable',
        'image',
        'mimes:jpeg,png,jpg,gif',
        'max:2048', // 2MB max
        'dimensions:min_width=200,min_height=200' // Minimum size
    ]
]);
```

## 🎉 **Benefits Summary**

### ✅ **Enhanced User Experience**
- **Quick Donations**: One-click QR code scanning
- **Mobile-Friendly**: Perfect for mobile users
- **Multiple Payment Options**: Support for various QR systems
- **Campaign-Specific**: Unique QR codes per campaign

### ✅ **Admin Benefits**
- **Easy Management**: Simple QR code upload interface
- **Campaign Tracking**: Track donations by QR code
- **Flexible Setup**: Support for different QR code types
- **Visual Management**: Preview QR codes in admin panel

### ✅ **Technical Benefits**
- **Secure Uploads**: Proper file validation and storage
- **Performance**: Optimized image storage and delivery
- **Scalability**: Support for multiple QR codes
- **Maintainability**: Clean, organized code structure

## 📋 **Implementation Checklist**

- [x] **Database Schema**: QR code field added to campaigns table
- [ ] **Model Updates**: Update Campaign model with new field
- [ ] **Controller Logic**: Add file upload handling
- [ ] **Validation Rules**: Add QR code image validation
- [ ] **Admin Interface**: Add QR code upload form
- [ ] **Frontend Display**: Show QR codes on campaign pages
- [ ] **File Storage**: Configure secure file storage
- [ ] **Testing**: Test QR code upload and display functionality

The QR code feature is now ready for implementation! 🚀 