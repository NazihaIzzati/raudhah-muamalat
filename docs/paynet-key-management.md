# Paynet FPX Key Management Guide

Based on the [official Paynet FPX Key Management documentation](https://docs.developer.paynet.my/docs/fpx/key-management).

## Overview

This guide covers the complete key management process for Paynet FPX integration, including certificate generation, CSR creation, and proper key storage.

## Prerequisites

- OpenSSL installed on your system
- Access to Paynet Developer Portal
- Secure storage for private keys

## Certificate Generation

### Step 1: Generate Private Key

#### Windows Platform
```bash
openssl genrsa -out merchant_private.key 2048
```

#### Linux/Unix Platform
```bash
openssl genrsa -out merchant_private.key 2048
```

### Step 2: Generate Certificate Signing Request (CSR)

#### Windows Platform
```bash
openssl req -out merchant_csr.csr -key merchant_private.key -new -sha256
```

#### Linux/Unix Platform
```bash
openssl req -out merchant_csr.csr -key merchant_private.key -new -sha256
```

### Step 3: CSR Information

When prompted, provide the following information:

- **Country Name**: MY (Malaysia)
- **State or Province Name**: Your state
- **Locality Name**: Your city
- **Organization Name**: Your company name
- **Organizational Unit Name**: IT Department (or relevant department)
- **Common Name**: Your domain name (e.g., yourdomain.com)
- **Email Address**: Your email address
- **Challenge Password**: Leave blank
- **Optional Company Name**: Leave blank

## Environment-Specific Procedures

### UAT Environment

1. **Generate PKI Key Pair**
   - Use OpenSSL to generate 2048-bit RSA key pair
   - Store private key securely
   - Certificate should be in .cer format

2. **Submit CSR to Paynet**
   - Submit CSR file through Paynet Developer Portal
   - Paynet Security Administrator will approve
   - Paynet will upload and authorize certificate

3. **Receive Certificate**
   - Paynet will provide the approved certificate
   - Store certificate securely on server

### Production Environment

1. **Generate PKI Key Pair**
   - Same process as UAT
   - Ensure 2048-bit RSA algorithm
   - Store private key in secure device

2. **Submit CSR to MSC Trustgate**
   - Use URL: https://onsite.msctrustgate.com/services/PaymentsNetworkMalaysiaSdnBhdFPX/digitalidCenter.htm
   - MSC Trustgate will process the request

3. **Paynet Approval**
   - Paynet Security Administrator approves
   - Paynet uploads and authorizes certificate

4. **Receive Certificate**
   - MSC Trustgate provides approved certificate
   - Store certificate securely on server

## File Structure

```
ssh-keygen/
├── merchant_private.key          # Your private key (SECURE!)
├── merchant_csr.csr              # Certificate signing request
├── merchant_certificate.cer      # Your approved certificate
├── paynet_public.cer            # Paynet's public certificate
├── paynet_public_current.cer    # Current Paynet certificate
└── README.md                    # This file
```

## Security Requirements

### Private Key Security
- **Never share** your private key
- Store in secure location
- Use appropriate file permissions (600)
- Backup securely
- Consider hardware security modules (HSM) for production

### Certificate Storage
- Store certificates securely
- Use appropriate file permissions (644)
- Backup certificates
- Monitor certificate expiry dates

## Certificate Renewal

### FPX Certificate Renewal
- UAT: Change from `fpxuat.cer` to `fpxuat_current.cer`
- Download latest FPX certificate from Paynet resources
- Update certificate files before expiry

### Merchant Certificate Renewal
- Monitor certificate expiry dates
- Generate new CSR before expiry
- Follow same approval process
- Update certificate files

## Implementation in Laravel

### Environment Variables
```bash
# Key Management
PAYNET_MERCHANT_ID=your_merchant_id
PAYNET_PRIVATE_KEY_PATH=ssh-keygen/merchant_private.key
PAYNET_PUBLIC_CERT_PATH=ssh-keygen/paynet_public.cer
PAYNET_MERCHANT_CERT_PATH=ssh-keygen/merchant_certificate.cer
```

### Key Management Service
```php
// app/Services/PaynetKeyManagementService.php
class PaynetKeyManagementService
{
    public function generatePrivateKey($filename = 'merchant_private.key')
    {
        $command = "openssl genrsa -out ssh-keygen/{$filename} 2048";
        return shell_exec($command);
    }

    public function generateCSR($privateKeyFile, $csrFile, $config)
    {
        $command = "openssl req -out ssh-keygen/{$csrFile} -key ssh-keygen/{$privateKeyFile} -new -sha256";
        return shell_exec($command);
    }

    public function validateCertificate($certPath)
    {
        $cert = file_get_contents($certPath);
        $certInfo = openssl_x509_parse($cert);
        
        return [
            'valid' => $certInfo !== false,
            'expiry' => $certInfo['validTo_time_t'] ?? null,
            'subject' => $certInfo['subject'] ?? null,
            'issuer' => $certInfo['issuer'] ?? null
        ];
    }
}
```

## Validation Scripts

### Certificate Validation
```bash
#!/bin/bash
# validate-certificates.sh

echo "Validating Paynet certificates..."

# Check merchant private key
if [ -f "ssh-keygen/merchant_private.key" ]; then
    echo "✓ Merchant private key exists"
    openssl rsa -in ssh-keygen/merchant_private.key -check -noout
else
    echo "✗ Merchant private key missing"
fi

# Check Paynet public certificate
if [ -f "ssh-keygen/paynet_public.cer" ]; then
    echo "✓ Paynet public certificate exists"
    openssl x509 -in ssh-keygen/paynet_public.cer -text -noout | grep "Not After"
else
    echo "✗ Paynet public certificate missing"
fi

# Check merchant certificate
if [ -f "ssh-keygen/merchant_certificate.cer" ]; then
    echo "✓ Merchant certificate exists"
    openssl x509 -in ssh-keygen/merchant_certificate.cer -text -noout | grep "Not After"
else
    echo "✗ Merchant certificate missing"
fi
```

### Key Generation Script
```bash
#!/bin/bash
# generate-keys.sh

echo "Generating Paynet FPX keys..."

# Create directory if it doesn't exist
mkdir -p ssh-keygen

# Generate private key
echo "Generating private key..."
openssl genrsa -out ssh-keygen/merchant_private.key 2048

# Generate CSR
echo "Generating CSR..."
openssl req -out ssh-keygen/merchant_csr.csr -key ssh-keygen/merchant_private.key -new -sha256

# Set proper permissions
chmod 600 ssh-keygen/merchant_private.key
chmod 644 ssh-keygen/merchant_csr.csr

echo "✓ Key generation complete!"
echo "📁 Files created:"
echo "  - ssh-keygen/merchant_private.key (PRIVATE - KEEP SECURE!)"
echo "  - ssh-keygen/merchant_csr.csr (Submit to Paynet)"
echo ""
echo "Next steps:"
echo "1. Submit merchant_csr.csr to Paynet"
echo "2. Download approved certificate"
echo "3. Download Paynet public certificate"
echo "4. Update environment variables"
```

## Troubleshooting

### Common Issues

1. **Permission Denied**
   ```bash
   chmod 600 ssh-keygen/merchant_private.key
   chmod 644 ssh-keygen/*.cer
   ```

2. **Certificate Expired**
   - Download latest certificate from Paynet
   - Update certificate files
   - Restart application

3. **Signature Verification Failed**
   - Check certificate paths in environment
   - Verify certificate format (.cer)
   - Check certificate expiry dates

4. **Private Key Not Found**
   - Verify file path in environment
   - Check file permissions
   - Ensure file exists in ssh-keygen directory

### Validation Commands

```bash
# Check private key
openssl rsa -in ssh-keygen/merchant_private.key -check -noout

# Check certificate expiry
openssl x509 -in ssh-keygen/paynet_public.cer -text -noout | grep "Not After"

# Verify certificate format
file ssh-keygen/*.cer

# Check file permissions
ls -la ssh-keygen/
```

## Best Practices

1. **Security**
   - Never commit private keys to version control
   - Use secure file permissions
   - Backup keys securely
   - Monitor certificate expiry

2. **Documentation**
   - Document certificate expiry dates
   - Keep track of renewal procedures
   - Maintain contact information for Paynet support

3. **Monitoring**
   - Set up alerts for certificate expiry
   - Monitor signature verification failures
   - Log certificate validation results

4. **Testing**
   - Test with UAT certificates first
   - Validate signatures in test environment
   - Use test transactions for validation

## Support

For key management issues:
- Paynet Developer Portal: https://developer.paynet.my
- MSC Trustgate: https://onsite.msctrustgate.com
- OpenSSL Documentation: https://www.openssl.org/docs/ 