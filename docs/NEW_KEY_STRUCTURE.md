# New Key Structure Documentation

## Overview
All cryptographic keys and certificates are now organized in the `storage/keys/<environment>` directory structure for better organization and security.

## Directory Structure

```
storage/keys/
├── dev/
│   ├── merchant_private.key
│   ├── merchant_certificate.cer
│   └── paynet_public.cer
├── sit/
│   ├── merchant_private.key
│   ├── merchant_certificate.cer
│   └── paynet_public.cer
├── uat/
│   ├── merchant_private.key
│   ├── merchant_certificate.cer
│   └── paynet_public.cer
└── prod/
    ├── merchant_private.key
    ├── merchant_certificate.cer
    └── paynet_public.cer
```

## Environment-Specific Keys

### Development (DEV)
- **Location**: `storage/keys/dev/`
- **Private Key**: `merchant_private.key`
- **Merchant Certificate**: `merchant_certificate.cer`
- **Paynet Public Certificate**: `paynet_public.cer`
- **Subject**: `/C=MY/ST=Selangor/L=Kuala Lumpur/O=Jariah Fund/OU=Development/CN=jariahfund-dev.com`

### System Integration Testing (SIT)
- **Location**: `storage/keys/sit/`
- **Private Key**: `merchant_private.key`
- **Merchant Certificate**: `merchant_certificate.cer`
- **Paynet Public Certificate**: `paynet_public.cer`
- **Subject**: `/C=MY/ST=Selangor/L=Kuala Lumpur/O=Jariah Fund/OU=SIT Testing/CN=jariahfund-sit.com`

### User Acceptance Testing (UAT)
- **Location**: `storage/keys/uat/`
- **Private Key**: `merchant_private.key`
- **Merchant Certificate**: `merchant_certificate.cer`
- **Paynet Public Certificate**: `paynet_public.cer`
- **Subject**: `/C=MY/ST=Selangor/L=Kuala Lumpur/O=Jariah Fund/OU=UAT Testing/CN=jariahfund-uat.com`

### Production (PROD)
- **Location**: `storage/keys/prod/`
- **Private Key**: `merchant_private.key`
- **Merchant Certificate**: `merchant_certificate.cer`
- **Paynet Public Certificate**: `paynet_public.cer`
- **Subject**: `/C=MY/ST=Selangor/L=Kuala Lumpur/O=Jariah Fund/OU=Production/CN=jariahfund.com`

## Environment Configuration

### Updated .env File
All key paths in the `.env` file have been updated to use the new structure:

```env
# Development
PAYNET_DEV_PRIVATE_KEY_PATH=storage/keys/dev/merchant_private.key
PAYNET_DEV_PUBLIC_CERT_PATH=storage/keys/dev/paynet_public.cer
PAYNET_DEV_MERCHANT_CERT_PATH=storage/keys/dev/merchant_certificate.cer

# SIT
PAYNET_SIT_PRIVATE_KEY_PATH=storage/keys/sit/merchant_private.key
PAYNET_SIT_PUBLIC_CERT_PATH=storage/keys/sit/paynet_public.cer
PAYNET_SIT_MERCHANT_CERT_PATH=storage/keys/sit/merchant_certificate.cer

# UAT
PAYNET_UAT_PRIVATE_KEY_PATH=storage/keys/uat/merchant_private.key
PAYNET_UAT_PUBLIC_CERT_PATH=storage/keys/uat/paynet_public.cer
PAYNET_UAT_MERCHANT_CERT_PATH=storage/keys/uat/merchant_certificate.cer

# Production
PAYNET_PROD_PRIVATE_KEY_PATH=storage/keys/prod/merchant_private.key
PAYNET_PROD_PUBLIC_CERT_PATH=storage/keys/prod/paynet_public.cer
PAYNET_PROD_MERCHANT_CERT_PATH=storage/keys/prod/merchant_certificate.cer
```

## Key Generation Commands

### Generate New Keys for All Environments
```bash
# Development
openssl genrsa -out storage/keys/dev/merchant_private.key 2048
openssl req -new -x509 -key storage/keys/dev/merchant_private.key -out storage/keys/dev/merchant_certificate.cer -days 365 -subj "/C=MY/ST=Selangor/L=Kuala Lumpur/O=Jariah Fund/OU=Development/CN=jariahfund-dev.com"
openssl req -new -x509 -key storage/keys/dev/merchant_private.key -out storage/keys/dev/paynet_public.cer -days 365 -subj "/C=MY/ST=Selangor/L=Kuala Lumpur/O=Paynet/OU=Development/CN=dev.paynet.my"

# SIT
openssl genrsa -out storage/keys/sit/merchant_private.key 2048
openssl req -new -x509 -key storage/keys/sit/merchant_private.key -out storage/keys/sit/merchant_certificate.cer -days 365 -subj "/C=MY/ST=Selangor/L=Kuala Lumpur/O=Jariah Fund/OU=SIT Testing/CN=jariahfund-sit.com"
openssl req -new -x509 -key storage/keys/sit/merchant_private.key -out storage/keys/sit/paynet_public.cer -days 365 -subj "/C=MY/ST=Selangor/L=Kuala Lumpur/O=Paynet/OU=SIT Testing/CN=sit.paynet.my"

# UAT
openssl genrsa -out storage/keys/uat/merchant_private.key 2048
openssl req -new -x509 -key storage/keys/uat/merchant_private.key -out storage/keys/uat/merchant_certificate.cer -days 365 -subj "/C=MY/ST=Selangor/L=Kuala Lumpur/O=Jariah Fund/OU=UAT Testing/CN=jariahfund-uat.com"
openssl req -new -x509 -key storage/keys/uat/merchant_private.key -out storage/keys/uat/paynet_public.cer -days 365 -subj "/C=MY/ST=Selangor/L=Kuala Lumpur/O=Paynet/OU=UAT Testing/CN=uat.paynet.my"

# Production
openssl genrsa -out storage/keys/prod/merchant_private.key 2048
openssl req -new -x509 -key storage/keys/prod/merchant_private.key -out storage/keys/prod/merchant_certificate.cer -days 365 -subj "/C=MY/ST=Selangor/L=Kuala Lumpur/O=Jariah Fund/OU=Production/CN=jariahfund.com"
openssl req -new -x509 -key storage/keys/prod/merchant_private.key -out storage/keys/prod/paynet_public.cer -days 365 -subj "/C=MY/ST=Selangor/L=Kuala Lumpur/O=Paynet/OU=Production/CN=paynet.my"
```

### Set Proper Permissions
```bash
# Set restrictive permissions on private keys
chmod 600 storage/keys/*/merchant_private.key

# Set read permissions on certificates
chmod 644 storage/keys/*/merchant_certificate.cer
chmod 644 storage/keys/*/paynet_public.cer
```

## Security Considerations

### File Permissions
- **Private Keys**: `600` (owner read/write only)
- **Certificates**: `644` (owner read/write, others read)

### Directory Structure Benefits
1. **Environment Isolation**: Each environment has its own keys
2. **Security**: Keys are stored in Laravel's storage directory
3. **Organization**: Clear separation by environment
4. **Backup**: Easy to backup entire key structure
5. **Deployment**: Environment-specific keys can be deployed separately

### Backup Strategy
```bash
# Backup all keys
tar -czf keys-backup-$(date +%Y%m%d).tar.gz storage/keys/

# Backup specific environment
tar -czf keys-prod-backup-$(date +%Y%m%d).tar.gz storage/keys/prod/
```

## Verification Commands

### Check Key Structure
```bash
# List all keys
find storage/keys/ -type f -name "*.key" -o -name "*.cer" | sort

# Check permissions
ls -la storage/keys/*/

# Count files per environment
for env in dev sit uat prod; do
    echo "$env: $(ls storage/keys/$env/ | wc -l) files"
done
```

### Test Key Loading
```bash
# Test PaynetService with new keys
php artisan tinker --execute="
\$service = new App\Services\PaynetService();
\$envInfo = \$service->getEnvironmentInfo();
echo 'Environment: ' . \$envInfo['environment'] . PHP_EOL;
echo 'Private Key: ' . \$envInfo['private_key_path'] . PHP_EOL;
echo 'Public Cert: ' . \$envInfo['public_cert_path'] . PHP_EOL;
echo 'Merchant Cert: ' . \$envInfo['merchant_cert_path'] . PHP_EOL;
"
```

### Test All Environments
```bash
# Test each environment
for env in dev sit uat prod; do
    echo "Testing $env environment:"
    PAYNET_ENVIRONMENT=$env php artisan tinker --execute="
    try {
        \$service = new App\Services\PaynetService();
        \$envInfo = \$service->getEnvironmentInfo();
        echo '  ✅ $env: ' . \$envInfo['private_key_path'] . PHP_EOL;
    } catch (Exception \$e) {
        echo '  ❌ $env: ' . \$e->getMessage() . PHP_EOL;
    }
    "
done
```

## Migration from Old Structure

### Old Structure (Deprecated)
```
ssh-keygen/
├── dev_merchant_private.key
├── dev_paynet_public.cer
├── dev_merchant_certificate.cer
├── sit_merchant_private.key
├── sit_paynet_public.cer
├── sit_merchant_certificate.cer
├── uat_merchant_private.key
├── uat_paynet_public.cer
├── uat_merchant_certificate.cer
├── prod_merchant_private.key
├── prod_paynet_public.cer
└── prod_merchant_certificate.cer
```

### New Structure (Current)
```
storage/keys/
├── dev/
│   ├── merchant_private.key
│   ├── merchant_certificate.cer
│   └── paynet_public.cer
├── sit/
│   ├── merchant_private.key
│   ├── merchant_certificate.cer
│   └── paynet_public.cer
├── uat/
│   ├── merchant_private.key
│   ├── merchant_certificate.cer
│   └── paynet_public.cer
└── prod/
    ├── merchant_private.key
    ├── merchant_certificate.cer
    └── paynet_public.cer
```

## Benefits of New Structure

### ✅ Organization
- Clear environment separation
- Consistent naming convention
- Easy to locate specific keys

### ✅ Security
- Proper file permissions
- Environment isolation
- Secure storage location

### ✅ Maintainability
- Easy to backup/restore
- Simple to deploy
- Clear documentation

### ✅ Scalability
- Easy to add new environments
- Consistent structure
- Standardized approach

## Troubleshooting

### Common Issues

1. **Permission Denied**
   ```bash
   chmod 600 storage/keys/*/merchant_private.key
   chmod 644 storage/keys/*/merchant_certificate.cer
   chmod 644 storage/keys/*/paynet_public.cer
   ```

2. **Key Not Found**
   ```bash
   # Check if key exists
   ls -la storage/keys/prod/merchant_private.key
   
   # Regenerate if missing
   openssl genrsa -out storage/keys/prod/merchant_private.key 2048
   ```

3. **Environment Mismatch**
   ```bash
   # Check current environment
   echo $PAYNET_ENVIRONMENT
   
   # Clear caches
   php artisan config:clear
   php artisan cache:clear
   ```

### Debug Commands

```bash
# Check key file existence
for env in dev sit uat prod; do
    echo "Checking $env environment:"
    ls -la storage/keys/$env/
    echo ""
done

# Test key loading
php artisan tinker --execute="
\$service = new App\Services\PaynetService();
\$reflection = new ReflectionClass(\$service);
\$method = \$reflection->getMethod('getMerchantPrivateKey');
\$method->setAccessible(true);
\$privateKey = \$method->invoke(\$service);
echo \$privateKey ? '✅ Key loaded' : '❌ Key failed';
"
```

## Summary

The new key structure provides:
- ✅ **Better organization** with environment-specific directories
- ✅ **Improved security** with proper permissions
- ✅ **Easy maintenance** with clear structure
- ✅ **Environment isolation** preventing cross-contamination
- ✅ **Simple deployment** with environment-specific keys
- ✅ **Comprehensive documentation** for future reference

All keys are now properly organized in `storage/keys/<environment>` with appropriate permissions and clear naming conventions. 