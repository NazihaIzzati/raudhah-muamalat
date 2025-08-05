<?php

require_once 'vendor/autoload.php';

use App\Models\Campaign;

// This is a simple test script to demonstrate the new campaign features
// Run this after setting up the database and running migrations

echo "=== Campaign Feature Test ===\n\n";

// Test 1: Get Featured Campaigns
echo "1. Featured Campaigns:\n";
$featuredCampaigns = Campaign::where('featured', true)
    ->orderBy('display_order', 'asc')
    ->get();

foreach ($featuredCampaigns as $campaign) {
    $percentage = $campaign->percentageReached();
    echo "   • {$campaign->title} ({$percentage}% funded, {$campaign->donor_count} donors)\n";
}

echo "\n";

// Test 2: Get Successful Campaigns
echo "2. Successful Campaigns:\n";
$successfulCampaigns = Campaign::successful()
    ->orderBy('raised_amount', 'desc')
    ->get();

foreach ($successfulCampaigns as $campaign) {
    $percentage = $campaign->percentageReached();
    $status = $campaign->getDisplayStatusAttribute();
    echo "   • {$campaign->title} ({$percentage}% funded, Status: {$status})\n";
}

echo "\n";

// Test 3: Get Ongoing Campaigns
echo "3. Ongoing Campaigns:\n";
$ongoingCampaigns = Campaign::ongoing()
    ->orderBy('created_at', 'desc')
    ->get();

foreach ($ongoingCampaigns as $campaign) {
    $percentage = $campaign->percentageReached();
    $daysRemaining = $campaign->days_remaining;
    echo "   • {$campaign->title} ({$percentage}% funded, {$daysRemaining} days remaining)\n";
}

echo "\n";

// Test 4: Get Ended Campaigns
echo "4. Ended Campaigns:\n";
$endedCampaigns = Campaign::ended()
    ->orderBy('end_date', 'desc')
    ->get();

foreach ($endedCampaigns as $campaign) {
    $percentage = $campaign->percentageReached();
    $isSuccessful = $campaign->isSuccessful() ? 'Yes' : 'No';
    echo "   • {$campaign->title} ({$percentage}% funded, Successful: {$isSuccessful})\n";
}

echo "\n=== Test Complete ===\n"; 