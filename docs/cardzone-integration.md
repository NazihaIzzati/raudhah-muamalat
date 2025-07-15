# Cardzone Payment Integration

This document outlines the integration of Cardzone payment gateway with the Raudhah Muamalat donation system.

## Overview

Cardzone is a payment gateway that allows secure processing of credit card and other payment methods. This integration enables the platform to accept donations through the Cardzone payment gateway.

## Implementation Details

The integration consists of the following components:

1. **CardZoneService** - A service class that handles communication with the Cardzone API
2. **PaymentController** - Controller that processes payment requests and handles callbacks
3. **Donation flow** - Updated to include Cardzone as a payment option

## Configuration

Add the following variables to your `.env` file:

```
# Cardzone Payment Gateway
CARDZONE_PRODUCTION=false
CARDZONE_UAT=false
CARDZONE_SANDBOX_URL=https://3dsecureczuat.muamalat.com.my/3dss/
CARDZONE_UAT_URL=https://3dsecureczuat.muamalat.com.my/3dss/
CARDZONE_PRODUCTION_URL=https://3dsecurecz.muamalat.com.my/3dss/
CARDZONE_MERCHANT_ID=400000000000005
CARDZONE_MERCHANT_PASSWORD=your_merchant_password
CARDZONE_TERMINAL_ID=your_terminal_id
```

### Environment Selection

The system supports three environments:

1. **Sandbox** - Used for initial development and testing (default)
2. **UAT** - User Acceptance Testing environment for pre-production testing
3. **Production** - Live environment for real transactions

To use the UAT environment, set the following in your `.env` file:
```
CARDZONE_UAT=true
CARDZONE_PRODUCTION=false
```

To use the Production environment, set:
```
CARDZONE_PRODUCTION=true
```

## Payment Flow

1. User selects Cardzone as payment method on the donation form
2. User submits the donation form
3. System creates a donation record with 'pending' status
4. User is redirected to the Cardzone payment page
5. User completes payment on Cardzone
6. Cardzone sends a callback to our system
7. System processes the callback and updates the donation status
8. User is redirected to success/pending/failed page based on payment status

## Callback Handling

The system handles two types of callbacks from Cardzone:

1. **Server-to-Server Callback** - Cardzone sends a POST request to our callback URL with payment status
2. **Return URL** - User is redirected back to our return URL after completing payment

## Testing

To test the integration:

1. Set `CARDZONE_PRODUCTION=false` in your `.env` file
2. For sandbox testing, set `CARDZONE_UAT=false`
3. For UAT testing, set `CARDZONE_UAT=true`
4. Use the appropriate credentials provided by Cardzone for each environment
5. Make test donations using the test cards provided by Cardzone

### Test Cards

#### Sandbox Environment
- **Successful Payment**: 4111 1111 1111 1111
- **Failed Payment**: 4000 0000 0000 0002
- **Expired Card**: 4000 0000 0000 0069

#### UAT Environment
- **Successful Payment**: 5555 5555 5555 4444
- **Failed Payment**: 4111 1111 1111 1113
- **3D Secure Testing**: 4212 3456 7890 1237

## Troubleshooting

Common issues:

1. **Callback not received** - Check firewall settings and ensure the callback URL is accessible
2. **Invalid signature** - Verify merchant credentials and signature calculation
3. **Payment stuck in pending** - Check logs for callback errors
4. **Environment mismatch** - Ensure you're using the correct URL and credentials for your selected environment

## Security Considerations

1. Always verify the signature in callbacks
2. Never log sensitive payment information
3. Use HTTPS for all payment-related communications
4. Store merchant credentials securely
5. Use different credentials for each environment

## References

- [Cardzone API Documentation](https://docs.cardzone.com)
- [BMMB-Cardzone 3DS Merchant Interface v2.9](docs/BMMB-Cardzone%203DS%20Merchant%20Interface_v2.9.pdf) 