# Campaign Features Implementation

## Overview

This document outlines the implementation of featured campaigns and successful campaign tracking in the Jariah Fund platform.

## Features Implemented

### 1. Featured Campaigns

**Purpose**: Highlight high-performing campaigns on the homepage and campaigns page.

**Implementation**:
- Added `featured` boolean field to campaigns table
- Added `display_order` integer field for controlling display order
- Created `ManageFeaturedCampaigns` command for automatic selection
- Updated Campaign model with `isFeatured()` method and `scopeFeatured()` scope

**Criteria for Auto-Selection**:
- Active campaigns only
- Not ended (or ending in the future)
- Ordered by:
  1. Percentage of goal reached (highest first)
  2. Number of donors (highest first)
  3. Creation date (newest first)

**Manual Management**:
```bash
# View current featured campaigns
php artisan campaigns:manage-featured

# Auto-select featured campaigns (limit to 3)
php artisan campaigns:manage-featured --auto --limit=3
```

### 2. Successful Campaign Tracking

**Purpose**: Automatically identify and display campaigns that have achieved their goals.

**Success Criteria**:
1. **Completed Status**: Campaign marked as 'completed'
2. **High Percentage**: Campaign has reached 80% or more of goal
3. **Ended with Success**: Campaign has ended and reached 70% or more of goal

**Implementation**:
- Added `isSuccessful()` method to Campaign model
- Added `scopeSuccessful()` scope for querying successful campaigns
- Created `UpdateCampaignStatuses` command for automatic status updates
- Enhanced status display with proper badges and indicators

**Status Categories**:
- `active`: Ongoing campaigns
- `completed`: Successfully completed campaigns
- `ended`: Campaigns that ended without meeting success criteria
- `cancelled`: Cancelled campaigns

### 3. Campaign Status Management

**Automatic Updates**:
```bash
# Update campaign statuses based on end dates and success criteria
php artisan campaigns:update-statuses
```

**Status Logic**:
- **100%+ Goal Reached**: Automatically marked as 'completed'
- **70%+ Goal Reached + Ended**: Marked as 'completed'
- **<70% Goal Reached + Ended**: Marked as 'ended'

### 4. Enhanced Campaign Model Methods

**New Methods**:
- `isSuccessful()`: Check if campaign meets success criteria
- `hasEnded()`: Check if campaign end date has passed
- `isOngoing()`: Check if campaign is currently active
- `getDisplayStatusAttribute()`: Get human-readable status
- `percentageReached()`: Calculate percentage of goal reached
- `getDurationDaysAttribute()`: Get campaign duration in days
- `getDaysRemainingAttribute()`: Get days remaining for ongoing campaigns

**New Scopes**:
- `scopeSuccessful()`: Query successful campaigns
- `scopeEnded()`: Query ended campaigns
- `scopeOngoing()`: Query ongoing campaigns
- `scopeFeatured()`: Query featured campaigns

### 5. Frontend Enhancements

**Campaign Display**:
- Featured campaigns section on homepage and campaigns page
- Successful campaigns section with detailed statistics
- Status badges showing campaign progress and completion
- Dynamic display of days remaining vs. campaign duration
- Improved progress indicators and success indicators

**Language Support**:
- Added translations for campaign statuses
- Added translations for success indicators
- Added translations for time-related information

## Database Schema

### Campaigns Table Additions

```sql
-- Featured campaign fields
ALTER TABLE campaigns ADD COLUMN featured BOOLEAN DEFAULT FALSE;
ALTER TABLE campaigns ADD COLUMN display_order INTEGER DEFAULT 0;

-- Additional fields for better tracking
ALTER TABLE campaigns ADD COLUMN donor_count INTEGER DEFAULT 0;
ALTER TABLE campaigns ADD COLUMN short_description TEXT;
ALTER TABLE campaigns ADD COLUMN category VARCHAR(50) DEFAULT 'general';
```

## Usage Examples

### 1. Get Featured Campaigns
```php
$featuredCampaigns = Campaign::where('featured', true)
    ->orderBy('display_order', 'asc')
    ->get();
```

### 2. Get Successful Campaigns
```php
$successfulCampaigns = Campaign::successful()
    ->orderBy('raised_amount', 'desc')
    ->get();
```

### 3. Check Campaign Status
```php
$campaign = Campaign::find(1);

if ($campaign->isSuccessful()) {
    echo "Campaign is successful!";
}

if ($campaign->hasEnded()) {
    echo "Campaign has ended";
}

if ($campaign->isOngoing()) {
    echo "Campaign is ongoing with {$campaign->days_remaining} days remaining";
}
```

### 4. Auto-Manage Featured Campaigns
```php
// In a scheduled task or command
Artisan::call('campaigns:manage-featured', ['--auto' => true, '--limit' => 3]);
```

## Scheduled Tasks

Add these to your `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    // Update campaign statuses daily
    $schedule->command('campaigns:update-statuses')->daily();
    
    // Auto-select featured campaigns weekly
    $schedule->command('campaigns:manage-featured --auto --limit=3')->weekly();
}
```

## Testing

Run the test script to verify functionality:
```bash
php test-campaign-features.php
```

## Benefits

1. **Improved User Experience**: Featured campaigns help users discover high-quality campaigns
2. **Automatic Management**: Reduces manual work in managing campaign statuses
3. **Transparency**: Clear indicators of campaign success and progress
4. **Scalability**: Automated processes handle large numbers of campaigns
5. **Consistency**: Standardized criteria for success and featuring

## Future Enhancements

1. **A/B Testing**: Test different featuring algorithms
2. **Analytics**: Track performance of featured vs non-featured campaigns
3. **Smart Recommendations**: Use machine learning to suggest campaigns to users
4. **Campaign Templates**: Pre-defined templates for different campaign types
5. **Success Metrics**: More detailed success criteria and tracking 