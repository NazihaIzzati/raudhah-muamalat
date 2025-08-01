# Cardzone 3DS Integration Documentation

## Overview
This document outlines the Cardzone 3DS (3D Secure) payment integration for the Raudhah Muamalat donation system.

## Environment Configuration

### Required Environment Variables
Add these to your `.env` file:

```bash
# Cardzone Configuration
CARDZONE_MERCHANT_ID=400000000000005
CARDZONE_UAT_KEY_EXCHANGE_URL=https://3dsecureczuat.muamalat.com.my/3dss/mkReq
CARDZONE_UAT_MPIREQ_URL=https://3dsecureczuat.muamalat.com.my/3dss/mpReq
CARDZONE_UAT_OBW_URL=https://3dsecureczuat.muamalat.com.my/3dss/mpReqObw
CARDZONE_UAT_QR_URL=https://3dsecureczuat.muamalat.com.my/3dss/mpQrReq
CARDZONE_RESPONSE_URL=https://your-domain.com/payment/cardzone/callback

# Optional: Production URLs (when ready for production)
CARDZONE_PRODUCTION_KEY_EXCHANGE_URL=https://3dsecurecz.muamalat.com.my/3dss/mkReq
CARDZONE_PRODUCTION_MPIREQ_URL=https://3dsecurecz.muamalat.com.my/3dss/mpReq
CARDZONE_PRODUCTION_OBW_URL=https://3dsecurecz.muamalat.com.my/3dss/mpReqObw
CARDZONE_PRODUCTION_QR_URL=https://3dsecurecz.muamalat.com.my/3dss/mpQrReq
```

## Key Management

### Persistent RSA Key Pair
The integration uses a persistent RSA key pair stored in the `ssh-keygen/` directory:

- **Private Key**: `ssh-keygen/jariahfund-dev` (PEM format)
- **Public Key**: `ssh-keygen/jariahfund-dev_public.pem` (PEM format)
- **Key Size**: 2048-bit RSA (Cardzone requirement)
- **Format**: PEM (compatible with OpenSSL)

### Key Usage
- **Private Key**: Used for MAC signing of payment requests and data encryption
- **Public Key**: Used for key exchange with Cardzone (converted to Base64Url)
- **Loading**: Automatically loaded by CardzoneService

### Key Generation
The keys were generated using:
```bash
# Generate 2048-bit RSA private key (Cardzone requirement)
openssl genrsa -out ssh-keygen/jariahfund-dev 2048

# Extract public key in PEM format
openssl rsa -in ssh-keygen/jariahfund-dev -pubout -out ssh-keygen/jariahfund-dev_public.pem
```

## Integration Flow

### 1. Donation Creation
- User fills donation form
- System creates donation record with `pending` status
- Redirects to payment page with donation data in session

### 2. Payment Initiation
- System generates unique 10-digit transaction ID
- Loads persistent RSA key pair from `ssh-keygen/` directory
- Performs key exchange with Cardzone (MPIKeyReq)
- Creates transaction record in database
- Prepares payment form data with MAC signature
- Redirects user to Cardzone payment gateway

### 3. Cardzone Processing
- User completes 3DS authentication on Cardzone
- Cardzone sends callback to your response URL
- System verifies MAC signature using persistent keys
- Updates transaction and donation status

### 4. Payment Completion
- User redirected to success/failure page
- Donation status updated accordingly

## API Endpoints

### Payment Routes
- `GET /payment/page` - Payment page
- `POST /payment/api/initiate-payment` - Initiate payment
- `POST /payment/cardzone/callback` - Cardzone callback
- `GET /payment/success` - Success page
- `GET /payment/failure` - Failure page

### API Routes
- `GET /api/banks` - Get bank list for OBW
- `POST /api/payment/process` - Process payment (donation + payment)

## Database Tables

### transactions
- `transaction_id` - Unique 10-digit Cardzone transaction ID
- `merchant_id` - Cardzone merchant ID
- `amount` - Payment amount
- `currency` - Payment currency
- `payment_method` - card/obw/qr
- `status` - pending/authenticated/authorized/failed
- `cardzone_response_data` - Raw Cardzone response

### cardzone_keys
- `merchant_id` - Merchant identifier
- `merchant_private_key` - Your RSA private key (PEM format)
- `cardzone_public_key` - Cardzone's public key (Base64Url)

## Security Features

### RSA Key Management
- Persistent 2048-bit RSA key pair stored in `ssh-keygen/` directory (Cardzone requirement)
- Automatic key loading by CardzoneService
- Secure private key storage with proper file permissions
- Public key exchange with Cardzone for verification

### MAC Signing
- All requests signed with persistent merchant private key
- MAC verification for all callbacks using Cardzone's public key
- Field order critical for MAC generation
- SHA256 signing algorithm

### Data Encryption
- Sensitive card data encrypted with Cardzone's public key
- RSA-OAEP padding for encryption
- Base64 encoding for encrypted data

## Testing

### Test Transaction IDs
- Must be 10-digit numeric values
- Example: `7108409818` (from Cardzone documentation)

### Test Cards
- Use test card numbers provided by Cardzone
- Test CVV and expiry dates

### Error Handling
- Key exchange failures fall back to demo mode
- Comprehensive logging for debugging
- Graceful error responses to users

## Troubleshooting

### Common Issues

1. **Key Exchange Fails (Error 404)**
   - Verify merchant ID is correct
   - Check UAT environment availability
   - Contact Cardzone support

2. **MAC Verification Fails**
   - Ensure field order matches Cardzone specification
   - Verify public key is correctly stored
   - Check MAC generation algorithm

3. **Transaction ID Invalid**
   - Must be exactly 10 digits
   - Must be numeric only
   - Cannot be reused

4. **Key Loading Issues**
   - Verify `ssh-keygen/jariahfund-dev` exists and is readable
   - Check file permissions (should be 600)
   - Ensure PEM format is correct

### Debug Endpoints
- `GET /payment/test-cardzone` - Test Cardzone connectivity
- Check Laravel logs for detailed error information

## Production Checklist

- [ ] Update environment variables to production URLs
- [ ] Verify merchant credentials with Cardzone
- [ ] Test with real card data (if available)
- [ ] Configure proper SSL certificates
- [ ] Set up monitoring and alerting
- [ ] Review security audit findings
- [ ] Update callback URL to production domain
- [ ] Consider using dedicated production key pair
- [ ] Implement key rotation policies

## Support

For technical support:
1. Check Laravel logs in `storage/logs/laravel.log`
2. Review Cardzone documentation
3. Contact Cardzone merchant support
4. Check network connectivity to Cardzone endpoints
5. Verify key files in `ssh-keygen/` directory 