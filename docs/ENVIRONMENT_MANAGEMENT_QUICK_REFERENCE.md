# Environment Management Quick Reference

## Overview
This guide provides quick reference for managing all environment settings focused on the `.env` file.

## Current Environment Status

### ✅ Environment Focus Achieved
- **All settings**: Loaded directly from `.env` file
- **No config dependencies**: Removed all `config()` fallbacks
- **Clean access**: Direct `env()` calls only
- **Production ready**: All environments configured

## Environment Variables by Environment

### Global Settings
```env
PAYNET_ENVIRONMENT=prod
PAYNET_MERCHANT_KEY=
PAYNET_MIN_AMOUNT=1.00
PAYNET_MAX_AMOUNT=50000.00
PAYNET_LOGGING_ENABLED=true
PAYNET_LOGGING_CHANNEL=paynet
```

### Development (DEV)
```env
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

### System Integration Testing (SIT)
```env
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

### User Acceptance Testing (UAT)
```env
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

### Production (PROD)
```env
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

## Quick Commands

### Switch Environment
```bash
# Edit .env file and change PAYNET_ENVIRONMENT
PAYNET_ENVIRONMENT=dev    # Development
PAYNET_ENVIRONMENT=sit    # SIT
PAYNET_ENVIRONMENT=uat    # UAT
PAYNET_ENVIRONMENT=prod   # Production
```

### Verify Environment
```bash
# Clear caches
php artisan config:clear
php artisan cache:clear

# Test PaynetService
php artisan tinker --execute="new App\Services\PaynetService();"

# Check environment info
php artisan tinker --execute="echo json_encode((new App\Services\PaynetService())->getEnvironmentInfo(), JSON_PRETTY_PRINT);"
```

### Check Current Settings
```bash
# List all Paynet variables
env | grep PAYNET

# Check specific environment
echo $PAYNET_ENVIRONMENT
```

## Environment-Specific URLs

### Development
- **API**: `https://sandbox.api.paynet.my`
- **Gateway**: `https://uat.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp`
- **Bank List**: `https://uat.mepsfpx.com.my/FPXMain/RetrieveBankList`

### SIT
- **API**: `https://sit.api.paynet.my`
- **Gateway**: `https://sit.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp`
- **Bank List**: `https://sit.mepsfpx.com.my/FPXMain/RetrieveBankList`

### UAT
- **API**: `https://sandbox.api.paynet.my`
- **Gateway**: `https://uat.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp`
- **Bank List**: `https://uat.mepsfpx.com.my/FPXMain/RetrieveBankList`

### Production
- **API**: `https://api.paynet.my`
- **Gateway**: `https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp`
- **Bank List**: `https://www.mepsfpx.com.my/FPXMain/RetrieveBankList`

## Certificate Paths

### Development
- **Private Key**: `ssh-keygen/dev_merchant_private.key`
- **Public Cert**: `ssh-keygen/dev_paynet_public.cer`
- **Merchant Cert**: `ssh-keygen/dev_merchant_certificate.cer`

### SIT
- **Private Key**: `storage/keys/sit/merchant_private.key`
- **Public Cert**: `storage/keys/sit/paynet_public.cer`
- **Merchant Cert**: `storage/keys/sit/merchant_certificate.cer`

### UAT
- **Private Key**: `ssh-keygen/uat_merchant_private.key`
- **Public Cert**: `ssh-keygen/uat_paynet_public.cer`
- **Merchant Cert**: `ssh-keygen/uat_merchant_certificate.cer`

### Production
- **Private Key**: `ssh-keygen/prod_merchant_private.key`
- **Public Cert**: `ssh-keygen/prod_paynet_public.cer`
- **Merchant Cert**: `ssh-keygen/prod_merchant_certificate.cer`

## Performance Settings

### Development
- **Timeout**: 30 seconds
- **Retry Attempts**: 2
- **Logging Level**: debug

### SIT
- **Timeout**: 30 seconds
- **Retry Attempts**: 3
- **Logging Level**: debug

### UAT
- **Timeout**: 30 seconds
- **Retry Attempts**: 3
- **Logging Level**: debug

### Production
- **Timeout**: 60 seconds
- **Retry Attempts**: 5
- **Logging Level**: info

## Troubleshooting

### Common Issues

1. **Environment Not Loading**
   ```bash
   # Check current environment
   echo $PAYNET_ENVIRONMENT
   
   # Clear caches
   php artisan config:clear
   php artisan cache:clear
   ```

2. **Certificate Issues**
   ```bash
   # Check certificate paths
   ls -la ssh-keygen/
   ls -la storage/keys/
   
   # Check permissions
   chmod 600 ssh-keygen/*_merchant_private.key
   chmod 644 ssh-keygen/*.cer
   ```

3. **URL Issues**
   ```bash
   # Test API connectivity
   curl -I https://api.paynet.my
   curl -I https://www.mepsfpx.com.my
   ```

### Debug Commands

```bash
# Test PaynetService with detailed output
php artisan tinker --execute="
\$service = new App\Services\PaynetService();
\$info = \$service->getEnvironmentInfo();
foreach (\$info as \$key => \$value) {
    echo \$key . ': ' . \$value . PHP_EOL;
}
"

# Check loaded environment variables
php artisan tinker --execute="
\$service = new App\Services\PaynetService();
\$vars = \$service->getLoadedEnvVariables();
foreach (\$vars as \$key => \$value) {
    echo \$key . ': ' . \$value . PHP_EOL;
}
"
```

## Best Practices

### ✅ Do's
- ✅ Use environment-specific variables
- ✅ Keep sensitive data in `.env` file
- ✅ Use clear, descriptive variable names
- ✅ Group related settings together
- ✅ Document all environment variables
- ✅ Test configuration in each environment

### ❌ Don'ts
- ❌ Don't commit sensitive values to version control
- ❌ Don't use hardcoded values in code
- ❌ Don't mix environment configurations
- ❌ Don't forget to clear caches after changes
- ❌ Don't use production values in development

## Summary

### ✅ Environment Focus Achieved
- **All settings**: Managed through `.env` file
- **No config dependencies**: Direct `env()` access
- **Clean architecture**: Simplified environment handling
- **Production ready**: All environments configured
- **Maintainable**: Easy to switch between environments

### 🎯 Key Benefits
- **Centralized configuration**: All settings in one place
- **Environment isolation**: Clear separation between environments
- **Easy switching**: Change `PAYNET_ENVIRONMENT` to switch
- **No dependencies**: No config file dependencies
- **Better performance**: Direct environment variable access 