# Database Seeders Documentation

This document provides comprehensive information about all database seeders for the Raudhah Muamalat crowdfunding platform.

## Overview

The seeding system creates realistic test data for all modules in the application, including users, campaigns, donations, posters, and events. All data is designed with Malaysian context and Islamic values in mind.

## Available Seeders

### 1. UserSeeder
**File:** `database/seeders/UserSeeder.php`

Creates comprehensive user data including:
- **Admin Users (2):**
  - admin@raudhahmuamalat.com (System Administrator)
  - sarah.admin@raudhahmuamalat.com (Operations Manager)
- **Regular Users (10):** Diverse Malaysian users with different backgrounds
- **Test Users (2):** Including unverified and inactive users

**Features:**
- Malaysian phone numbers (+60 format)
- Malaysian addresses across different states
- Professional bios related to their occupations
- Proper status management (active/inactive)
- Email verification status

### 2. CampaignSeeder
**File:** `database/seeders/CampaignSeeder.php`

Creates 5 diverse campaigns:
- Emergency Relief for Gaza
- Build a Mosque in Indonesia
- Water Wells for African Villages
- Orphan Sponsorship Program
- Ramadan Food Distribution

**Features:**
- Realistic goal amounts (50K - 250K USD)
- Detailed descriptions and content
- Proper date ranges (past, current, future)
- Slug generation for SEO-friendly URLs
- Random raised amounts (0-80% of goal)

### 3. DonationSeeder
**File:** `database/seeders/DonationSeeder.php`

Creates 160+ donations with realistic distribution:

**Payment Methods (Malaysian Context):**
- DuitNow QR, FPX Online Banking
- Malaysian bank options (Maybank2u, CIMB Clicks, etc.)
- E-wallets (Boost, GrabPay, TNG)
- Traditional methods (Credit card, Bank transfer, Cash)

**Amount Distribution:**
- Small donations (RM10-50): 40%
- Medium donations (RM51-200): 35%
- Large donations (RM201-500): 15%
- Very large donations (RM501-2000): 8%
- Major donations (RM2001-10000): 2%

**Status Distribution:**
- Completed: 70%
- Pending: 15%
- Failed: 10%
- Refunded: 5%

**Special Features:**
- 60% registered users, 40% guest donations
- 25% anonymous donations
- 40% include inspirational Islamic messages
- 70% provide phone numbers
- Recurring monthly donations for top 10 users
- Malaysian names for guest donations
- Automatic campaign raised amount updates

### 4. PosterSeeder
**File:** `database/seeders/PosterSeeder.php`

Creates 12 promotional posters:

**Categories:**
- Humanitarian, Infrastructure, Water, Food
- Education, Event, Volunteer, Zakat
- Youth, Empowerment, Emergency

**Features:**
- 9 active, 3 inactive posters
- Featured poster designation
- File size simulation (900KB - 2.5MB)
- Display date ranges
- Campaign associations where relevant
- SEO-friendly slugs

### 5. EventSeeder
**File:** `database/seeders/EventSeeder.php`

Creates 8 diverse events:

**Event Types:**
- Islamic Finance Workshop
- Community Iftar Gathering
- Charity Fundraising Gala
- Youth Leadership Bootcamp
- Women Empowerment Seminar
- Eid Celebration Festival
- Volunteer Training Program
- Digital Marketing for Nonprofits

**Features:**
- Malaysian locations with GPS coordinates
- Realistic pricing (Free to RM250)
- Registration management with participant limits
- Contact information and social media links
- Multi-day events support
- Registration deadlines
- Featured event designation

## Running Seeders

### Run All Seeders
```bash
php artisan migrate:fresh --seed
```

### Run Individual Seeders
```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=CampaignSeeder
php artisan db:seed --class=DonationSeeder
php artisan db:seed --class=PosterSeeder
php artisan db:seed --class=EventSeeder
```

### Run Specific Seeder Only
```bash
php artisan db:seed --class=DatabaseSeeder
```

## Seeding Order

The seeders run in dependency order:
1. **UserSeeder** - Creates admin and regular users
2. **CampaignSeeder** - Creates campaigns (requires users)
3. **DonationSeeder** - Creates donations (requires users and campaigns)
4. **PosterSeeder** - Creates posters (can reference campaigns)
5. **EventSeeder** - Creates events (independent)

## Test Data Summary

After running all seeders, you'll have:
- **👥 Users:** 14 (2 admins, 12 regular users)
- **🎯 Campaigns:** 5 diverse fundraising campaigns
- **💰 Donations:** 160+ realistic donations
- **📋 Posters:** 12 promotional materials
- **📅 Events:** 8 community events

## Admin Access

**Default Admin Login:**
- Email: `admin@raudhahmuamalat.com`
- Password: `password123`

**Secondary Admin:**
- Email: `sarah.admin@raudhahmuamalat.com`
- Password: `password123`

## Data Characteristics

### Malaysian Context
- Phone numbers in +60 format
- Addresses across Malaysian states
- Currency in MYR (Malaysian Ringgit)
- Local payment methods (FPX, DuitNow, etc.)
- Malaysian names and cultural context

### Islamic Values
- Inspirational Islamic donation messages
- Halal-focused events and content
- Islamic finance principles
- Community-oriented activities
- Zakat and charity emphasis

### Realistic Distribution
- Proper status distributions (completed vs pending)
- Realistic amount ranges
- Geographic diversity
- Professional variety
- Time-based data (past, present, future)

## Customization

To modify seeder data:
1. Edit the respective seeder file
2. Modify arrays of sample data
3. Adjust distribution percentages
4. Update Malaysian context as needed
5. Re-run the seeder

## Troubleshooting

### Common Issues
1. **Foreign Key Constraints:** Ensure seeders run in proper order
2. **Duplicate Data:** Seeders check for existing records before creating
3. **Status Values:** Ensure status values match database constraints
4. **Required Fields:** All required model fields are populated

### Reset Database
```bash
php artisan migrate:fresh --seed
```

This will drop all tables, run migrations, and seed fresh data.

## Contributing

When adding new seeders:
1. Follow the existing naming convention
2. Include Malaysian context where appropriate
3. Add proper error checking
4. Update the DatabaseSeeder to include new seeders
5. Document the new seeder in this README

## Notes

- All passwords are hashed using Laravel's Hash facade
- Timestamps are properly set for realistic data distribution
- File paths are placeholder paths (actual files not created)
- GPS coordinates are real Malaysian locations
- Email addresses use example.com domain for test data 