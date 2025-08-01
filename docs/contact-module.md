# Contact Module Documentation

## Overview
The Contact module provides a comprehensive system for managing customer inquiries and support requests in the Raudhah Muamalat admin dashboard.

## Features

### Admin Dashboard Features
- **Contact List Management**: View all contact messages with filtering and search capabilities
- **Status Management**: Track contact status (New, Read, Replied, Closed)
- **Priority System**: Mark contacts as urgent for priority handling
- **Admin Notes**: Add internal notes for contact management
- **Response Tracking**: Track who replied and when
- **Email Integration**: Direct email reply functionality

### Database Structure

#### Contacts Table
- `id` - Primary key
- `first_name` - Contact's first name
- `last_name` - Contact's last name
- `email` - Contact's email address
- `phone` - Contact's phone number (optional)
- `subject` - Message subject
- `message` - Message content
- `status` - Contact status (new, read, replied, closed)
- `is_urgent` - Urgent flag
- `admin_notes` - Internal admin notes
- `replied_by` - Admin who replied (foreign key to users)
- `replied_at` - Timestamp of reply
- `created_at` - Message received timestamp
- `updated_at` - Last update timestamp

## File Structure

```
app/
├── Http/Controllers/Admin/
│   └── ContactController.php          # Admin contact management
├── Models/
│   └── Contact.php                    # Contact model
database/
├── migrations/
│   └── 2025_06_17_080000_create_contacts_table.php
└── seeders/
    └── ContactSeeder.php              # Sample contact data
resources/views/admin/contacts/
├── index.blade.php                    # Contact list view
├── show.blade.php                     # Contact details view
└── edit.blade.php                     # Contact edit view
```

## Routes

### Admin Routes (Protected)
- `GET /admin/contacts` - Contact list
- `GET /admin/contacts/{contact}` - View contact details
- `GET /admin/contacts/{contact}/edit` - Edit contact
- `PUT /admin/contacts/{contact}` - Update contact
- `DELETE /admin/contacts/{contact}` - Delete contact
- `PATCH /admin/contacts/{contact}/mark-urgent` - Mark as urgent
- `PATCH /admin/contacts/{contact}/remove-urgent` - Remove urgent status
- `PATCH /admin/contacts/{contact}/mark-replied` - Mark as replied

## Usage

### Installation
1. Run the migration: `php artisan migrate`
2. Seed sample data: `php artisan db:seed --class=ContactSeeder`

### Admin Access
Navigate to `/admin/contacts` in the admin dashboard to:
- View all contact messages
- Filter by status (New, Read, Replied, Closed)
- Filter by priority (Urgent only)
- Search contacts by name, email, or subject
- View detailed contact information
- Add admin notes
- Update contact status
- Mark contacts as urgent/normal priority
- Reply via email

### Contact Status Workflow
1. **New** - Newly received contact (auto-marked as "Read" when viewed)
2. **Read** - Contact has been viewed by admin
3. **Replied** - Admin has responded to the contact
4. **Closed** - Contact inquiry is resolved

### Priority System
- **Normal** - Standard priority contacts
- **Urgent** - High priority contacts requiring immediate attention
- Urgent contacts are highlighted in the interface

## Design Consistency
The contact module follows the same design patterns as other admin modules:
- Orange theme (#fe5000)
- Consistent UI components and styling
- Same table layout and action buttons
- Matching search and filter functionality
- Identical navigation and breadcrumb patterns

## Integration
- Integrates with User model for admin tracking
- Uses the admin middleware for access control
- Follows Laravel's resource controller pattern
- Compatible with existing admin layout and navigation

## Sample Data
The ContactSeeder provides realistic sample contacts including:
- Various subjects (Campaign Support, Donation Inquiry, Technical Support, etc.)
- Different statuses and priority levels
- Malaysian names and phone numbers
- Realistic inquiry messages
- Admin notes and reply tracking 