#!/bin/bash

# Raudhah Muamalat Database Seeder Script
# This script runs all database seeders for the crowdfunding platform

echo "🌱 Raudhah Muamalat Database Seeder"
echo "=================================="
echo ""

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Please run this script from the Laravel project root."
    exit 1
fi

# Ask user for confirmation
echo "This will:"
echo "- Drop all existing tables"
echo "- Run fresh migrations"
echo "- Seed all modules with test data"
echo ""
read -p "Do you want to continue? (y/N): " -n 1 -r
echo ""

if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "❌ Operation cancelled."
    exit 1
fi

echo ""
echo "🚀 Starting database refresh and seeding..."
echo ""

# Run migrate:fresh with seed
php artisan migrate:fresh --seed

# Check if the command was successful
if [ $? -eq 0 ]; then
    echo ""
    echo "✅ Database seeding completed successfully!"
    echo ""
    echo "📊 Your database now contains:"
    echo "   👥 Users (admins and regular users)"
    echo "   🎯 Campaigns (fundraising campaigns)"
    echo "   💰 Donations (realistic donation data)"
    echo "   📋 Posters (promotional materials)"
    echo "   📅 Events (community events)"
    echo ""
    echo "🔑 Admin Login Credentials:"
    echo "   Email: admin@raudhahmuamalat.com"
    echo "   Password: password123"
    echo ""
    echo "🌐 You can now access the application with seeded data!"
else
    echo ""
    echo "❌ Database seeding failed. Please check the error messages above."
    exit 1
fi 