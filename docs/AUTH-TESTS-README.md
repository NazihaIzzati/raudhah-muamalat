# Authentication Tests

This document explains how to run the authentication tests for the login and registration features.

## Prerequisites

- PHP 8.0 or higher
- Composer installed
- Laravel project set up with database configuration

## Setup for Testing

1. Make sure your `.env.testing` file is configured with a test database:

```
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

2. Install dependencies if not already installed:

```bash
composer install
```

## Running the Tests

### Option 1: Using the provided script

We've created a convenient script to run all authentication tests:

```bash
./run-auth-tests.sh
```

This script will:
- Clear Laravel cache
- Run all login tests
- Run all registration tests

### Option 2: Running tests manually

You can also run the tests manually using Artisan:

```bash
# Run all tests
php artisan test

# Run only login tests
php artisan test --filter=LoginTest

# Run only registration tests
php artisan test --filter=RegisterTest

# Run a specific test method
php artisan test --filter=LoginTest::test_user_can_login_with_correct_credentials
```

## Test Coverage

### Login Tests

- `test_login_page_loads_correctly`: Verifies the login page loads with all required fields
- `test_user_can_login_with_correct_credentials`: Tests successful login with valid credentials
- `test_user_cannot_login_with_incorrect_email`: Tests login failure with wrong email
- `test_user_cannot_login_with_incorrect_password`: Tests login failure with wrong password
- `test_login_form_validation`: Tests validation for empty and invalid fields
- `test_remember_me_functionality`: Tests the "remember me" checkbox functionality
- `test_user_can_logout_after_login`: Tests the logout functionality

### Registration Tests

- `test_registration_page_loads_correctly`: Verifies the registration page loads with all required fields
- `test_user_can_register_with_valid_credentials`: Tests successful registration with valid data
- `test_registration_requires_all_fields`: Tests validation for required fields
- `test_registration_requires_valid_email`: Tests validation for email format
- `test_registration_requires_password_confirmation`: Tests password confirmation validation
- `test_registration_requires_password_minimum_length`: Tests password length validation
- `test_registration_requires_unique_email`: Tests unique email validation

## Troubleshooting

If you encounter any issues with the tests:

1. Make sure your database configuration is correct
2. Try running `php artisan config:clear` to clear cached configuration
3. Check that your User model and authentication controllers are properly set up
4. Verify that your routes for login and registration are correctly defined 