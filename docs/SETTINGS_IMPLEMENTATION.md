# Settings Implementation Documentation

## Overview

The settings system allows administrators to configure various platform settings through a user-friendly interface. All settings are stored in the database and can be accessed throughout the application.

## Database Structure

### Settings Table
- **Migration**: `2025_08_01_010856_create_settings_table.php`
- **Model**: `App\Models\Setting`
- **Seeder**: `Database\Seeders\SettingsSeeder`

### Fields

#### General Settings
- `site_name` (string) - Platform name
- `site_email` (string) - Contact email
- `site_phone` (string) - Contact phone
- `site_description` (text) - Platform description

#### Payment Settings
- `currency` (enum: MYR, USD, EUR, GBP) - Default currency
- `min_donation` (decimal) - Minimum donation amount
- `duitnow_qr_enabled` (boolean) - Enable DuitNow QR payments
- `fpx_banking_enabled` (boolean) - Enable FPX banking
- `card_payment_enabled` (boolean) - Enable card payments

#### Security Settings
- `registration_type` (enum: open, approval, closed) - User registration policy
- `session_timeout` (integer) - Session timeout in minutes
- `max_login_attempts` (integer) - Maximum login attempts

#### Notification Settings
- `email_new_donations` (boolean) - Email notifications for new donations
- `email_new_registrations` (boolean) - Email notifications for new registrations
- `email_campaign_updates` (boolean) - Email notifications for campaign updates
- `admin_email` (string) - Admin notification email

## Usage

### In Controllers
```php
use App\Models\Setting;

// Get all settings
$settings = Setting::getSettings();

// Get specific setting
$siteName = Setting::get('site_name', 'Default Name');

// Update settings
Setting::updateSettings(['site_name' => 'New Name']);
```

### Using SettingsHelper
```php
use App\Helpers\SettingsHelper;

// Get site name
$siteName = SettingsHelper::siteName();

// Get currency
$currency = SettingsHelper::currency();

// Check payment method
$isDuitNowEnabled = SettingsHelper::isPaymentMethodEnabled('duitnow_qr');

// Check registration status
$isOpen = SettingsHelper::isRegistrationOpen();
```

### In Blade Templates
```php
{{ \App\Helpers\SettingsHelper::siteName() }}
{{ \App\Helpers\SettingsHelper::currency() }}
```

## Admin Interface

### Access
- **URL**: `/admin/settings`
- **Route**: `admin.settings`
- **Controller**: `App\Http\Controllers\Admin\DashboardController@settings`

### Features
- **4 Configuration Sections**:
  1. General Settings (Site information)
  2. Payment Settings (Payment methods and currency)
  3. Security Settings (Registration and session policies)
  4. Notification Settings (Email preferences)

- **Form Validation**: All inputs are validated with appropriate rules
- **Success/Error Messages**: User feedback for form submissions
- **Database Persistence**: All changes are saved to database
- **Default Values**: Seeder provides sensible defaults

## API Endpoints

### GET `/admin/settings`
- **Purpose**: Display settings page
- **Response**: Settings view with current values

### POST `/admin/settings`
- **Purpose**: Update settings
- **Validation**: Comprehensive validation rules
- **Response**: Redirect with success/error message

## Implementation Details

### Model Methods
```php
Setting::getSettings()     // Get first settings record or create new
Setting::updateSettings()  // Update settings with validation
Setting::get()            // Get specific setting value
Setting::set()            // Set specific setting value
```

### Validation Rules
- **Required fields**: site_name, site_email, site_phone, currency, min_donation, registration_type, session_timeout, max_login_attempts, admin_email
- **Email validation**: site_email, admin_email
- **Numeric validation**: min_donation, session_timeout, max_login_attempts
- **Enum validation**: currency, registration_type
- **Boolean fields**: All checkbox fields are properly handled

### Checkbox Handling
The system properly handles checkbox fields by:
1. Using `nullable|boolean` validation
2. Converting checkbox values to boolean using `$request->has()`
3. Storing boolean values in database

## Security Features

- **Admin Middleware**: Settings page requires admin authentication
- **CSRF Protection**: All forms include CSRF tokens
- **Input Validation**: Comprehensive validation rules
- **Error Handling**: Graceful error handling with user feedback

## Future Enhancements

1. **Settings Caching**: Implement Redis caching for better performance
2. **Audit Logging**: Track settings changes for compliance
3. **Environment-specific Settings**: Different settings for dev/staging/prod
4. **API Endpoints**: RESTful API for settings management
5. **Import/Export**: Settings backup and restore functionality

## Testing

### Database Seeding
```bash
php artisan db:seed --class=SettingsSeeder
```

### Manual Testing
```bash
# Check settings in database
php artisan tinker
>>> App\Models\Setting::first()->site_name
```

### Access Settings Page
1. Login as admin
2. Navigate to `/admin/settings`
3. Modify settings
4. Submit forms
5. Verify changes are saved

## Troubleshooting

### Common Issues

1. **Settings not loading**: Check if seeder has been run
2. **Validation errors**: Ensure all required fields are provided
3. **Checkbox not working**: Verify form includes proper name attributes
4. **Database errors**: Check migration has been run

### Debug Commands
```bash
# Check settings count
php artisan tinker --execute="echo App\Models\Setting::count();"

# View all settings
php artisan tinker --execute="print_r(App\Models\Setting::first()->toArray());"
``` 