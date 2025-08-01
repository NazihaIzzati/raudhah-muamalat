#!/bin/bash

# Raudhah Muamalat Seeder Verification Script
# This script verifies that all seeders ran correctly

echo "🔍 Raudhah Muamalat Seeder Verification"
echo "======================================"
echo ""

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Please run this script from the Laravel project root."
    exit 1
fi

echo "📊 Checking seeded data counts..."
echo ""

# Function to run tinker command and get count
get_count() {
    local model=$1
    php artisan tinker --execute="echo $model::count();"
}

# Check Users
echo -n "👥 Users: "
get_count "App\\Models\\User"

# Check Campaigns  
echo -n "🎯 Campaigns: "
get_count "App\\Models\\Campaign"

# Check Donations
echo -n "💰 Donations: "
get_count "App\\Models\\Donation"

# Check News
echo -n "📋 News: "
get_count "App\\Models\\News"

# Check Events
echo -n "📅 Events: "
get_count "App\\Models\\Event"

echo ""
echo "🔍 Detailed breakdown:"
echo ""

# Admin users count
echo -n "   👑 Admin users: "
php artisan tinker --execute="echo App\\Models\\User::where('role', 'admin')->count();"

# Regular users count
echo -n "   👤 Regular users: "
php artisan tinker --execute="echo App\\Models\\User::where('role', 'user')->count();"

# Active campaigns
echo -n "   🎯 Active campaigns: "
php artisan tinker --execute="echo App\\Models\\Campaign::where('status', 'active')->count();"

# Completed donations
echo -n "   ✅ Completed donations: "
php artisan tinker --execute="echo App\\Models\\Donation::where('payment_status', 'completed')->count();"

# Published news
echo -n "   📋 Published news: "
php artisan tinker --execute="echo App\\Models\\News::where('status', 'published')->count();"

# Published events
echo -n "   📅 Published events: "
php artisan tinker --execute="echo App\\Models\\Event::where('status', 'published')->count();"

echo ""
echo "💰 Financial summary:"
echo ""

# Total raised amount
echo -n "   💵 Total raised: RM "
php artisan tinker --execute="echo number_format(App\\Models\\Donation::where('payment_status', 'completed')->sum('amount'), 2);"

# Average donation
echo -n "   📊 Average donation: RM "
php artisan tinker --execute="echo number_format(App\\Models\\Donation::where('payment_status', 'completed')->avg('amount'), 2);"

echo ""
echo "✅ Verification completed!"
echo ""
echo "🔑 Admin credentials:"
echo "   Email: admin@raudhahmuamalat.com"
echo "   Password: password123" 