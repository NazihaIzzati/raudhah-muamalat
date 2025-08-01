# Paynet FPX Integration Documentation

## Overview
This document outlines the Paynet FPX (Financial Process Exchange) payment integration for the Raudhah Muamalat donation system. This is an alternative to the Cardzone integration and uses Paynet services for FPX payments.

## Environment Configuration

### Required Environment Variables
Add these to your `.env` file:

```bash
# Paynet Configuration
PAYNET_MERCHANT_ID=your_merchant_id
PAYNET_API_URL=https://sandbox.api.paynet.my
PAYNET_CALLBACK_URL=https://your-domain.com/payment/paynet/callback

# Optional: Production URLs (when ready for production)
PAYNET_PRODUCTION_API_URL=https://api.paynet.my
PAYNET_PRODUCTION_CALLBACK_URL=https://your-domain.com/payment/paynet/callback
```

### Required Key Files
Place these files in the `ssh-keygen/` directory:

```bash
# Merchant private key for signature generation
ssh-keygen/merchant_private.key

# Paynet public certificate for signature verification
ssh-keygen/paynet_public.cer

# Merchant certificate (after approval)
ssh-keygen/merchant_certificate.cer

# Certificate signing request (for submission to Paynet)
ssh-keygen/merchant_csr.csr
```

### Key Management
Use our provided scripts for key management:

```bash
# Generate private key and CSR
./scripts/generate-paynet-keys.sh

# Validate certificates and keys
./scripts/validate-paynet-certificates.sh
```

For detailed key management procedures, see: [docs/paynet-key-management.md](docs/paynet-key-management.md)

## Integration Flow

Based on the [official Paynet FPX B2C documentation](https://docs.developer.paynet.my/docs/fpx/b2c-overview), our implementation follows the 16-step transaction flow:

### 1. Buyer Initiation (Steps 1-2)
```
User selects FPX payment → User selects preferred bank → Form submission
```

### 2. AR Message to FPX (Step 3)
```
Merchant sends AR (Authorization Request) message to FPX via SSL
```

### 3. Bank Authentication (Steps 4-6)
```
FPX redirects to bank → Bank performs debiting → Bank sends Direct AC to FPX
```

### 4. Acknowledgment Flow (Steps 7-9)
```
FPX sends acknowledgment to bank → FPX sends Direct AC to merchant → Merchant responds with 'OK'
```

### 5. Status Display & Redirect (Steps 10-13)
```
Bank displays status → Bank redirects to FPX → FPX redirects to merchant → Merchant displays status
```

### 6. Settlement (Steps 14-16)
```
FPX sends RR message to acquiring bank → Bank performs crediting → Bank sends RC message to FPX
```

## API Endpoints

### FPX Payment Creation
- **URL**: `POST /payment/api/fpx/payment`
- **Purpose**: Create FPX payment request with proper signature
- **Parameters**:
  - `donation_id` (required): Donation ID
  - `amount` (required): Payment amount (formatted as per Paynet requirements)
  - `donor_name` (required): Donor name
  - `donor_email` (required): Donor email
  - `fpx_bank` (required): Selected FPX bank code
  - `campaign_id` (required): Campaign ID
  - `donor_phone` (optional): Donor phone number
  - `message` (optional): Donation message
  - `is_anonymous` (optional): Anonymous donation flag

### FPX Bank List
- **URL**: `GET /api/fpx/banks`
- **Purpose**: Get list of available FPX banks from Paynet
- **External API**: `https://sandbox.api.paynet.my/fpx/banks/v1`
- **Response**: Array of bank objects with code and name

### Paynet Direct AC Callback
- **URL**: `POST /payment/paynet/callback`
- **Purpose**: Handle Direct AC (Direct Acknowledgment) message from FPX
- **Parameters**: All callback data from Paynet including `fpx_checkSum` signature
- **Signature Verification**: Uses Paynet public certificate for verification

### Paynet Acknowledgment
- **URL**: `POST /fpx/ack` (internal to PaynetService)
- **Purpose**: Send acknowledgment to FPX (Step 9 of the flow)
- **Parameters**: FPX message format with proper signature

## FPX Bank Codes

Based on the [official Paynet FPX Mapping Table](https://docs.developer.paynet.my/docs/fpx/mapping-table):

### Production Banks
| Bank Code | Bank Name |
|-----------|-----------|
| ABB0232 | Affin Bank Berhad |
| ABB0233 | Affin Bank Berhad B2C |
| ABMB0212 | Alliance Bank Malaysian Berhad B2C |
| ABMB0213 | Alliance Bank Malaysian Berhad B2B |
| AMBB0208 | AmBank Malaysia Berhad B2B |
| AMBB0209 | AmBank Malaysia Berhad B2C |
| BCBB0235 | CIMB Bank Berhad |
| BIMB0340 | Bank Islam Malaysia Berhad |
| BMMB0341 | Bank Muamalat Malaysia Berhad |
| BMMB0342 | Bank Muamalat Malaysia Berhad B2B |
| BKRM0602 | Bank Kerjasama Rakyat Malaysia B2C |
| BSN0601 | Bank Simpanan Nasional |
| DBB0199 | Deutsche Bank (Malaysia) Berhad |
| HLB0224 | Hong Leong Bank Berhad |
| HLB0225 | Hong Leong Bank Berhad B2B2 |
| HSBC0223 | HSBC Bank Berhad FPX |
| KFH0346 | Kuwait Finance House |
| MB2U0227 | Malayan Banking Berhad (M2U) |
| MBB0227 | Malayan Banking Berhad (M2E) |
| MBB0228 | Malayan Banking Berhad B2B |
| OCBC0229 | OCBC Bank Malaysia Berhad |
| PBB0233 | Public Bank Berhad |
| RHB0218 | RHB Bank Berhad |
| SCB0215 | Standard Chartered Bank Malaysia Berhad B2B |
| SCB0216 | Standard Chartered Bank Malaysia Berhad B2C |
| TPAGHL | GHL CardPay Sdn Bhd |
| TPAIPAY88 | Mobile88.com Sdn Bhd |
| TPAMOLPAY | MOL Pay Sdn Bhd |
| TPAREVENUE | Revenue Harvest Sdn Bhd |
| UOB0226 | United Overseas Bank B2C |
| UOB0227 | United Overseas Bank B2B1 |
| UOB0228 | United Overseas Bank B2B1 Regional |

### Test Banks (Development/Testing)
| Bank Code | Bank Name |
|-----------|-----------|
| TEST0021 | SBI Bank A |
| TEST0022 | SBI Bank B |
| TEST0023 | SBI Bank C |

## Special Character Handling

Based on the [official Paynet FPX Mapping Table](https://docs.developer.paynet.my/docs/fpx/mapping-table):

### Supported Special Characters
The following special characters are supported by FPX:
- `@` (At-sign)
- `/` (Slash)
- `\` (Backslash)
- `(` (Open bracket)
- `)` (Close bracket)
- ` ` (Blank space)
- `.` (Full stop)
- `-` (Hyphen)
- `_` (Underscore)
- `,` (Comma)
- `&` (Ampersand)
- `'` (Apostrophe)

### Additional Special Characters for Buyer Name
The following additional characters are supported specifically for buyer names:
- `` ` `` (Grave accent)
- `~` (Tilde)
- `*` (Asterisk)
- `"` (Double quote)
- `;` (Semicolon)
- `:` (Colon)

### Character Sanitization
Our implementation automatically sanitizes buyer names by:
1. Removing unsupported special characters
2. Trimming whitespace
3. Limiting length to 100 characters
4. Preserving supported special characters

## Security Features

Based on the [official Paynet FPX Authentication documentation](https://docs.developer.paynet.my/docs/fpx/authentication):

### OAuth2.0 Authentication
- API uses OAuth2.0 for client authentication
- TLS 1.2 encryption for all connections
- Secure transport layer protection

### Asymmetric Cryptography
- RSA-SHA1 signature algorithm for message signing
- Merchant private key for signature generation
- Paynet public certificate for signature verification
- Source string construction with pipe-separated values

### Message Signature Process
1. **Source String Construction**: All data element values sorted in ascending order
2. **Pipe Separation**: Values joined with "|" character
3. **Private Key Signing**: Source string signed with merchant private key
4. **Hex Conversion**: Binary signature converted to uppercase hex string
5. **Header Inclusion**: Signature added to `X-Signature` header field

### Transaction Tracking
- Unique transaction IDs generated for each payment
- Full audit trail maintained in database
- Response data stored for debugging

## Error Handling

Based on the [official Paynet FPX Response Codes documentation](https://docs.developer.paynet.my/docs/fpx/response-code):

### FPX Services Response Codes
Our implementation handles all official Paynet response codes:

#### Success Codes
- **00**: Approved
- **03**: Approved

#### Common Error Codes
- **05**: Invalid Seller Or Acquiring Bank Code
- **09**: Transaction Pending
- **12**: Invalid Transaction
- **13/14**: Invalid Amount
- **20**: Invalid Response
- **30**: Format Error
- **31/39**: Invalid Bank
- **45**: Duplicate Seller Order Number
- **46/47**: Invalid Seller Exchange Or Seller
- **48/49**: Maximum Transaction Limit Exceeded
- **50**: Invalid Seller for Merchant Specific Limit
- **51**: Insufficient Funds
- **53**: No Buyer Account Number
- **57**: Transaction Not Permitted
- **58**: Transaction To Merchant Not Permitted
- **70**: Invalid Serial Number
- **76**: Transaction Not Found
- **77**: Invalid Buyer Name Or Buyer ID
- **78**: Decryption Failed
- **79**: Host Decline When Down
- **80**: Buyer Cancel Transaction
- **83**: Invalid Transaction Model
- **84**: Invalid Transaction Type
- **85/87**: Internal Error At Bank System
- **88**: Credit Failed Exception Handling
- **89**: Transaction Not Received Exception Handling
- **90**: Bank Internet Banking Unavailable
- **92**: Invalid Buyer Bank
- **96**: System Malfunction
- **98**: MAC Error
- **99/BB**: Pending Authorization (Applicable for B2B model)
- **BC**: Transaction Cancelled By Customer

#### User Session Error Codes
- **1B**: Buyer Failed To Provide The Necessary Info To Login To Internet Banking Login Page
- **1C**: Buyer Choose Cancel At Login Page
- **1D**: Buyer Session Timeout At Account Selection Page
- **1E**: Buyer Failed To Provide The Necessary Info At Account Selection Page
- **1F**: Buyer Choose Cancel At Account Selection Page
- **1G**: Buyer Session Timeout At TAC Request Page
- **1H**: Buyer Failed To Provide The Necessary Info At TAC Request Page
- **1I**: Buyer Choose Cancel At TAC Request Page
- **1J**: Buyer Session Timeout At Confirmation Page
- **1K**: Buyer Failed To Provide The Necessary Info At Confirmation Page
- **1L**: Buyer Choose Cancel At Confirmation Page
- **1M**: Internet Banking Session Timeout

#### Other Error Codes
- **DA**: Invalid Application Type
- **DB**: Invalid Email Format
- **DC**: Invalid Maximum Frequency
- **DD**: Invalid Frequency Mode
- **DE**: Invalid Expiry Date
- **DF**: Invalid e-Mandate Buyer Bank ID
- **FE**: Internal Error
- **OE/OF**: Transaction Rejected As Not In FPX Operating Hours
- **SB**: Invalid Acquiring Bank Code
- **XA/XB**: Invalid Source IP Address (Applicable for B2B2 model)
- **XE**: Invalid Message
- **XF/XI**: Invalid Number Of Orders
- **XM**: Invalid FPX Transaction Model
- **XN**: Transaction Rejected Due To Duplicate Seller Exchange Order Number
- **XO**: Duplicate Exchange Order Number
- **XS**: Seller Does Not Belong To Exchange
- **XT**: Invalid Transaction Type
- **XW/1A**: Seller Exchange Date Difference Exceeded
- **2A**: Transaction Amount Is Lower Than Minimum Limit
- **2X**: Transaction Is Canceled By Merchant

### Error Response Format
```json
{
    "success": false,
    "message": "Error description",
    "response_code": "51",
    "response_description": "Insufficient Funds",
    "error": "Technical error details (debug mode only)"
}
```

### Common Error Scenarios
1. **Invalid Bank Selection**: User must select a valid FPX bank
2. **Network Issues**: Graceful handling of API timeouts
3. **Signature Mismatch**: Callback verification failures logged
4. **Transaction Not Found**: Proper error responses for missing transactions
5. **Insufficient Funds**: Response code 51 handling
6. **Bank System Issues**: Response codes 90, 96, 98 handling
7. **User Cancellation**: Response codes 80, BC, 1C, 1F, 1I, 1L handling

## Testing

### Test Endpoints
- **Connectivity Test**: `GET /payment/test-paynet`
- **Bank List Test**: `GET /api/fpx/banks`
- **Payment Test**: Use UAT environment for testing

### Test Data
- Use test merchant credentials in UAT environment
- Test with small amounts (RM 1.00)
- Verify callback handling with test transactions

## Database Schema

### Transactions Table Updates
- Added `paynet_response_data` JSON column
- Stores complete Paynet API responses
- Supports debugging and audit trails

### Migration
```bash
php artisan migrate
```

## Frontend Integration

### Payment Form
- FPX payment option added to payment page
- Bank selection dropdown with all supported banks
- Payment summary display
- AJAX form submission with error handling

### JavaScript Features
- Form validation before submission
- Loading states during API calls
- Error message display
- Automatic redirect to Paynet payment page

## Monitoring and Logging

### Log Files
- All Paynet API calls logged to Laravel logs
- Callback verification results logged
- Error scenarios captured with full context

### Debug Information
- API request/response logging
- Signature verification details
- Transaction status updates

## Production Considerations

### Security
- Use production merchant credentials
- Enable HTTPS for all endpoints
- Implement rate limiting
- Monitor for suspicious activity

### Performance
- Optimize database queries
- Implement caching for bank lists
- Monitor API response times
- Set appropriate timeouts

### Monitoring
- Set up alerts for failed payments
- Monitor callback success rates
- Track payment completion times
- Log all production errors

## Troubleshooting

### Common Issues
1. **Callback Not Received**: Check URL configuration and server accessibility
2. **Signature Verification Failed**: Verify merchant key configuration
3. **Payment Not Completed**: Check transaction status in Paynet dashboard
4. **Bank Selection Issues**: Ensure bank codes match Paynet specifications

### Debug Steps
1. Check Laravel logs for detailed error messages
2. Verify environment variables are correctly set
3. Test API connectivity using test endpoint
4. Review transaction records in database

## Support

For technical support with Paynet integration:
- Check Paynet API documentation
- Review Laravel logs for detailed error messages
- Test with UAT environment first
- Contact Paynet support for API-specific issues 