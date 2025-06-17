# Database Seeders

This directory contains seeders for populating the database with sample data.

## Partner Seeder

The `PartnerSeeder` creates sample partner organizations with realistic data.

### Running the Partner Seeder

```bash
# Run only the partner seeder
php artisan db:seed --class=PartnerSeeder

# Run all seeders (includes partners)
php artisan db:seed
```

### Sample Data Included

The seeder creates 15 sample partners including:

- **International NGOs**: UNICEF Malaysia, World Food Programme, etc.
- **Local Organizations**: Malaysian Red Crescent Society, Mercy Malaysia, etc.
- **Corporate Foundations**: Maybank Foundation, Genting Foundation, etc.
- **Government Agencies**: Ministry of Women, Family and Community Development, etc.
- **Environmental Organizations**: WWF Malaysia, etc.

### Partner Data Structure

Each partner includes:
- Name and unique slug
- Detailed description
- Website URL (where applicable)
- Status (active/inactive)
- Featured flag
- Display order for sorting
- Creator (admin user)

## Partner Factory

The `PartnerFactory` allows for flexible generation of partner data for testing.

### Basic Usage

```php
// Create a single partner
$partner = Partner::factory()->create();

// Create multiple partners
$partners = Partner::factory()->count(10)->create();

// Create partners with specific states
$featuredPartner = Partner::factory()->featured()->create();
$activePartner = Partner::factory()->active()->create();
$corporatePartner = Partner::factory()->corporate()->create();
$internationalNGO = Partner::factory()->international()->create();
```

### Available Factory States

- `featured()` - Creates a featured partner with high display priority
- `active()` - Creates an active partner
- `inactive()` - Creates an inactive partner
- `corporate()` - Creates a corporate foundation partner
- `international()` - Creates an international NGO partner

### Example Usage in Tests

```php
public function test_featured_partners_display_first()
{
    $featuredPartner = Partner::factory()->featured()->create();
    $regularPartner = Partner::factory()->create();
    
    $partners = Partner::orderBy('display_order')->get();
    
    $this->assertEquals($featuredPartner->id, $partners->first()->id);
}
```

## Refreshing Data

To refresh all data including partners:

```bash
# Fresh migration and seed
php artisan migrate:fresh --seed

# Or reset and seed
php artisan db:seed --class=PartnerSeeder --force
```

## Notes

- The seeder will create an admin user if none exists
- All partners are assigned to the first admin user as creator
- Featured partners have lower display_order values (appear first)
- Corporate foundations are more likely to be featured
- International NGOs have realistic descriptions and URLs 