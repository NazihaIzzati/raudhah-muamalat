# Authentication System Setup - Jariah Fund

## Overview
This document outlines the custom authentication system implemented for the Jariah Fund platform, including user registration, login, and admin dashboard functionality.

## Features Implemented

### 1. User Authentication
- **Login System**: Custom login with email and password
- **Registration System**: User registration with role assignment
- **Role-based Access**: Admin and regular user roles
- **Session Management**: Secure session handling with logout functionality

### 2. Admin Dashboard
- **Admin Panel**: Dedicated admin interface with sidebar navigation
- **User Management**: View and manage all users
- **Campaign Management**: Interface for managing campaigns (ready for implementation)
- **Settings Panel**: System configuration interface
- **Statistics Dashboard**: Overview of platform metrics

### 3. User Dashboard
- **Personal Dashboard**: User-specific dashboard with donation tracking
- **Quick Actions**: Easy access to donate and browse campaigns
- **Activity Tracking**: View donation history and impact

## File Structure

### Controllers
```
app/Http/Controllers/
├── Auth/
│   ├── LoginController.php       # Handles login/logout
│   └── RegisterController.php    # Handles user registration
├── Admin/
│   └── DashboardController.php   # Admin dashboard and management
└── DashboardController.php       # User dashboard
```

### Views
```
resources/views/
├── auth/
│   ├── login.blade.php           # Login form
│   └── register.blade.php        # Registration form
├── admin/
│   ├── dashboard.blade.php       # Admin dashboard
│   ├── users.blade.php           # User management
│   ├── campaigns.blade.php       # Campaign management
│   └── settings.blade.php        # System settings
├── layouts/
│   ├── master.blade.php          # Main site layout
│   └── admin.blade.php           # Admin panel layout
└── dashboard.blade.php           # User dashboard
```

### Middleware
```
app/Http/Middleware/
└── AdminMiddleware.php           # Protects admin routes
```

## Database Schema

### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Email address (unique)
- `password` - Hashed password
- `role` - User role ('admin' or 'user')
- `created_at` - Registration timestamp
- `updated_at` - Last update timestamp

## Routes

### Public Routes
- `GET /` - Homepage
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /register` - Registration form
- `POST /register` - Process registration

### Protected Routes
- `GET /dashboard` - User dashboard (requires auth)
- `POST /logout` - Logout (requires auth)

### Admin Routes (requires auth + admin role)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/users` - User management
- `GET /admin/campaigns` - Campaign management
- `GET /admin/settings` - System settings

## Default Users Created

### Admin User
- **Email**: admin@jariahfund.com
- **Password**: password123
- **Role**: admin

### Test User
- **Email**: user@jariahfund.com
- **Password**: password123
- **Role**: user

## Security Features

1. **Password Hashing**: All passwords are hashed using Laravel's built-in hashing
2. **CSRF Protection**: All forms include CSRF tokens
3. **Role-based Access Control**: Admin middleware protects admin routes
4. **Session Security**: Secure session management with regeneration
5. **Input Validation**: Form validation for all user inputs

## Usage Instructions

### For Regular Users
1. Visit `/register` to create an account
2. Login at `/login` with your credentials
3. Access your dashboard at `/dashboard`
4. Use quick actions to donate or browse campaigns

### For Administrators
1. Login with admin credentials at `/login`
2. Access admin panel at `/admin/dashboard`
3. Manage users, campaigns, and system settings
4. View platform statistics and recent activity

## Testing

The authentication system includes comprehensive tests:
- Login/logout functionality
- Registration process
- Role-based access control
- Admin middleware protection
- Dashboard access for different user types

Run tests with:
```bash
vendor/bin/phpunit tests/Feature/AuthenticationTest.php
```

## Future Enhancements

1. **Password Reset**: Implement forgot password functionality
2. **Email Verification**: Add email verification for new registrations
3. **Two-Factor Authentication**: Enhanced security with 2FA
4. **Social Login**: Integration with Google/Facebook login
5. **User Profiles**: Extended user profile management
6. **Activity Logs**: Detailed user activity tracking

## Technical Notes

- Built on Laravel 12.16.0
- Uses SQLite database for development
- Tailwind CSS for styling
- Responsive design for mobile compatibility
- Follows Laravel best practices and conventions

## Maintenance

- Regular security updates for Laravel framework
- Monitor user activity and login attempts
- Backup user data regularly
- Review and update admin permissions as needed