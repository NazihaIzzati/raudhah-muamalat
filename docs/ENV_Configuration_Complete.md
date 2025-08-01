# Complete Environment Configuration Guide

## Overview
This guide provides a comprehensive template for organizing all environment settings in the `.env` file, with a focus on Paynet FPX configuration.

## Environment Structure

### 1. Laravel Application Configuration
```env
# ========================================
# LARAVEL APPLICATION CONFIGURATION
# ========================================
APP_NAME="Jariah Fund"
APP_ENV=local
APP_KEY=base64:your-app-key-here
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=http://localhost:8000

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
PHP_CLI_SERVER_WORKERS=4
BCRYPT_ROUNDS=12
```

### 2. Database Configuration
```env
# ========================================
# DATABASE CONFIGURATION
# ========================================
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

### 3. Session & Cache Configuration
```env
# ========================================
# SESSION & CACHE CONFIGURATION
# ========================================
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
CACHE_STORE=database
```

### 4. Redis Configuration
```env
# ========================================
# REDIS CONFIGURATION
# ========================================
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 5. Mail Configuration
```env
# ========================================
# MAIL CONFIGURATION
# ========================================
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 6. AWS Configuration
```env
# ========================================
# AWS CONFIGURATION
# ========================================
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false
```

### 7. Vite Configuration
```env
# ========================================
# VITE CONFIGURATION
# ========================================
VITE_APP_NAME="${APP_NAME}"
```

### 8. Cardzone Configuration
```env
# ========================================
# CARDZONE CONFIGURATION
# ========================================
CARDZONE_PRODUCTION=false
CARDZONE_UAT=true
CARDZONE_SANDBOX_URL=https://3dsecureczuat.muamalat.com.my/3dss/
CARDZONE_UAT_URL=https://3dsecureczuat.muamalat.com.my/3dss/
CARDZONE_PRODUCTION_URL=https://3dsecurecz.muamalat.com.my/3dss/
CARDZONE_MERCHANT_ID=400000000000005
CARDZONE_MERCHANT_PASSWORD=
CARDZONE_TERMINAL_ID=

# Cardzone 3DS Integration Configuration
CARDZONE_UAT_KEY_EXCHANGE_URL=https://3dsecureczuat.muamalat.com.my/3dss/mkReq
CARDZONE_UAT_MPIREQ_URL=https://3dsecureczuat.muamalat.com.my/3dss/mpReq
CARDZONE_UAT_OBW_URL=https://3dsecureczuat.muamalat.com.my/3dss/mpReqObw
CARDZONE_UAT_QR_URL=https://3dsecureczuat.muamalat.com.my/3dss/mpQrReq
CARDZONE_RESPONSE_URL=http://localhost:8000/payment/cardzone/callback
CARDZONE_DEBUG=true
```

## Paynet FPX Configuration

### 9. Global Paynet Settings
```env
# ========================================
# PAYNET FPX CONFIGURATION
# ========================================
# Current Environment Setting (DEV/SIT/UAT/PROD)
PAYNET_ENVIRONMENT=prod

# ========================================
# GLOBAL PAYNET SETTINGS
# ========================================
PAYNET_MERCHANT_KEY=
PAYNET_MIN_AMOUNT=1.00
PAYNET_MAX_AMOUNT=50000.00
PAYNET_LOGGING_ENABLED=true
PAYNET_LOGGING_CHANNEL=paynet
```

### 10. Development Environment (DEV)
```env
# ========================================
# DEVELOPMENT ENVIRONMENT (DEV)
# ========================================
PAYNET_DEV_API_URL=https://sandbox.api.paynet.my
PAYNET_DEV_GATEWAY_URL=https://uat.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
PAYNET_DEV_BANK_LIST_URL=https://uat.mepsfpx.com.my/FPXMain/RetrieveBankList
PAYNET_DEV_REDIRECT_URL=https://uat.mepsfpx.com.my/FPXMain/processMesgFromSBIBanks.jsp
PAYNET_DEV_TERMS_URL=https://uat.mepsfpx.com.my/FPXMain/termsAndConditions.jsp
PAYNET_DEV_CALLBACK_URL=http://localhost:8000/payment/paynet/callback
PAYNET_DEV_MERCHANT_ID=EX00010946
PAYNET_DEV_MERCHANT_NAME="Jariah Fund Dev"
PAYNET_DEV_PRIVATE_KEY_PATH=ssh-keygen/dev_merchant_private.key
PAYNET_DEV_PUBLIC_CERT_PATH=ssh-keygen/dev_paynet_public.cer
PAYNET_DEV_MERCHANT_CERT_PATH=ssh-keygen/dev_merchant_certificate.cer
PAYNET_DEV_TIMEOUT=30
PAYNET_DEV_RETRY_ATTEMPTS=2
PAYNET_DEV_LOGGING_LEVEL=debug
```

### 11. System Integration Testing (SIT)
```env
# ========================================
# SYSTEM INTEGRATION TESTING (SIT)
# ========================================
PAYNET_SIT_API_URL=https://sit.api.paynet.my
PAYNET_SIT_GATEWAY_URL=https://sit.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
PAYNET_SIT_BANK_LIST_URL=https://sit.mepsfpx.com.my/FPXMain/RetrieveBankList
PAYNET_SIT_REDIRECT_URL=https://sit.mepsfpx.com.my/FPXMain/processMesgFromSBIBanks.jsp
PAYNET_SIT_TERMS_URL=https://sit.mepsfpx.com.my/FPXMain/termsAndConditions.jsp
PAYNET_SIT_CALLBACK_URL=https://your-sit-domain.com/payment/paynet/callback
PAYNET_SIT_MERCHANT_ID=EX00010946
PAYNET_SIT_MERCHANT_NAME="Jariah Fund SIT"
PAYNET_SIT_PRIVATE_KEY_PATH=storage/keys/sit/merchant_private.key
PAYNET_SIT_PUBLIC_CERT_PATH=storage/keys/sit/paynet_public.cer
PAYNET_SIT_MERCHANT_CERT_PATH=storage/keys/sit/merchant_certificate.cer
PAYNET_SIT_TIMEOUT=30
PAYNET_SIT_RETRY_ATTEMPTS=3
PAYNET_SIT_LOGGING_LEVEL=debug
```

### 12. User Acceptance Testing (UAT)
```env
# ========================================
# USER ACCEPTANCE TESTING (UAT)
# ========================================
PAYNET_UAT_API_URL=https://sandbox.api.paynet.my
PAYNET_UAT_GATEWAY_URL=https://uat.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
PAYNET_UAT_BANK_LIST_URL=https://uat.mepsfpx.com.my/FPXMain/RetrieveBankList
PAYNET_UAT_REDIRECT_URL=https://uat.mepsfpx.com.my/FPXMain/processMesgFromSBIBanks.jsp
PAYNET_UAT_TERMS_URL=https://uat.mepsfpx.com.my/FPXMain/termsAndConditions.jsp
PAYNET_UAT_CALLBACK_URL=http://localhost:8000/payment/paynet/callback
PAYNET_UAT_MERCHANT_ID=EX00010946
PAYNET_UAT_MERCHANT_NAME="Jariah Fund UAT"
PAYNET_UAT_PRIVATE_KEY_PATH=ssh-keygen/uat_merchant_private.key
PAYNET_UAT_PUBLIC_CERT_PATH=ssh-keygen/uat_paynet_public.cer
PAYNET_UAT_MERCHANT_CERT_PATH=ssh-keygen/uat_merchant_certificate.cer
PAYNET_UAT_TIMEOUT=30
PAYNET_UAT_RETRY_ATTEMPTS=3
PAYNET_UAT_LOGGING_LEVEL=debug
```

### 13. Production Environment (PROD)
```env
# ========================================
# PRODUCTION ENVIRONMENT (PROD)
# ========================================
PAYNET_PROD_API_URL=https://api.paynet.my
PAYNET_PROD_GATEWAY_URL=https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp
PAYNET_PROD_BANK_LIST_URL=https://www.mepsfpx.com.my/FPXMain/RetrieveBankList
PAYNET_PROD_REDIRECT_URL=https://www.mepsfpx.com.my/FPXMain/processMesgFromSBIBanks.jsp
PAYNET_PROD_TERMS_URL=https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp
PAYNET_PROD_CALLBACK_URL=http://localhost:8000/payment/paynet/callback
PAYNET_PROD_MERCHANT_ID=EX00010946
PAYNET_PROD_MERCHANT_NAME="Jariah Fund"
PAYNET_PROD_PRIVATE_KEY_PATH=ssh-keygen/prod_merchant_private.key
PAYNET_PROD_PUBLIC_CERT_PATH=ssh-keygen/prod_paynet_public.cer
PAYNET_PROD_MERCHANT_CERT_PATH=ssh-keygen/prod_merchant_certificate.cer
PAYNET_PROD_TIMEOUT=60
PAYNET_PROD_RETRY_ATTEMPTS=5
PAYNET_PROD_LOGGING_LEVEL=info
```

## Environment Variables by Category

### Core Application Settings
- `APP_NAME`: Application name
- `APP_ENV`: Environment (local, production, etc.)
- `APP_KEY`: Laravel encryption key
- `APP_DEBUG`: Debug mode
- `APP_URL`: Application URL

### Database Settings
- `DB_CONNECTION`: Database driver
- `DB_HOST`: Database host
- `DB_PORT`: Database port
- `DB_DATABASE`: Database name
- `DB_USERNAME`: Database username
- `DB_PASSWORD`: Database password

### Session & Cache Settings
- `SESSION_DRIVER`: Session storage driver
- `SESSION_LIFETIME`: Session lifetime in minutes
- `CACHE_STORE`: Cache storage driver
- `QUEUE_CONNECTION`: Queue connection

### Paynet Global Settings
- `PAYNET_ENVIRONMENT`: Current environment (DEV/SIT/UAT/PROD)
- `PAYNET_MERCHANT_KEY`: Global merchant key
- `PAYNET_MIN_AMOUNT`: Minimum transaction amount
- `PAYNET_MAX_AMOUNT`: Maximum transaction amount
- `PAYNET_LOGGING_ENABLED`: Enable/disable logging
- `PAYNET_LOGGING_CHANNEL`: Logging channel name

### Paynet Environment-Specific Settings (for each environment)
- `PAYNET_{ENV}_API_URL`: API endpoint URL
- `PAYNET_{ENV}_GATEWAY_URL`: Payment gateway URL
- `PAYNET_{ENV}_BANK_LIST_URL`: Bank list retrieval URL
- `PAYNET_{ENV}_REDIRECT_URL`: Redirect URL
- `PAYNET_{ENV}_TERMS_URL`: Terms and conditions URL
- `PAYNET_{ENV}_CALLBACK_URL`: Callback URL
- `PAYNET_{ENV}_MERCHANT_ID`: Merchant ID
- `PAYNET_{ENV}_MERCHANT_NAME`: Merchant name
- `PAYNET_{ENV}_PRIVATE_KEY_PATH`: Private key file path
- `PAYNET_{ENV}_PUBLIC_CERT_PATH`: Public certificate file path
- `PAYNET_{ENV}_MERCHANT_CERT_PATH`: Merchant certificate file path
- `PAYNET_{ENV}_TIMEOUT`: Request timeout in seconds
- `PAYNET_{ENV}_RETRY_ATTEMPTS`: Number of retry attempts
- `PAYNET_{ENV}_LOGGING_LEVEL`: Logging level

## Best Practices

### 1. Organization
- Group related settings together
- Use clear section headers with comments
- Maintain consistent naming conventions
- Separate global and environment-specific settings

### 2. Security
- Never commit sensitive values to version control
- Use environment-specific files (`.env.dev`, `.env.prod`)
- Keep private keys and certificates secure
- Use strong, unique values for production

### 3. Documentation
- Document all environment variables
- Include example values where appropriate
- Maintain clear comments explaining each section
- Update documentation when adding new variables

### 4. Validation
- Validate environment variables on application startup
- Provide clear error messages for missing required variables
- Test configuration in each environment
- Use type checking for numeric values

## Environment Switching

To switch between environments, update the `PAYNET_ENVIRONMENT` variable:

```env
# For Development
PAYNET_ENVIRONMENT=dev

# For System Integration Testing
PAYNET_ENVIRONMENT=sit

# For User Acceptance Testing
PAYNET_ENVIRONMENT=uat

# For Production
PAYNET_ENVIRONMENT=prod
```

## Verification Commands

Use these commands to verify your environment configuration:

```bash
# Clear configuration cache
php artisan config:clear

# Clear application cache
php artisan cache:clear

# Test PaynetService initialization
php artisan tinker --execute="new App\Services\PaynetService();"

# Check environment info
php artisan tinker --execute="echo json_encode((new App\Services\PaynetService())->getEnvironmentInfo(), JSON_PRETTY_PRINT);"
```

## Troubleshooting

### Common Issues

1. **Missing Environment Variables**
   - Check that all required variables are set
   - Verify variable names match exactly (case-sensitive)
   - Ensure no extra spaces or quotes

2. **Certificate Path Issues**
   - Verify certificate files exist
   - Check file permissions (600 for private keys, 644 for certificates)
   - Ensure paths are relative to project root

3. **URL Configuration**
   - Verify all URLs are accessible
   - Check for HTTPS/HTTP protocol consistency
   - Ensure callback URLs are publicly accessible

4. **Environment Mismatch**
   - Confirm `PAYNET_ENVIRONMENT` matches your target environment
   - Verify all environment-specific variables are properly set
   - Check for typos in environment names

### Debug Commands

```bash
# Check current environment
echo $PAYNET_ENVIRONMENT

# List all Paynet environment variables
env | grep PAYNET

# Test PaynetService with detailed output
php artisan tinker --execute="
\$service = new App\Services\PaynetService();
\$info = \$service->getEnvironmentInfo();
foreach (\$info as \$key => \$value) {
    echo \$key . ': ' . \$value . PHP_EOL;
}
"
``` 