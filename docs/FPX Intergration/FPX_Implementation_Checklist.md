# FPX Payment Gateway Implementation Checklist

## Pre-Implementation Requirements

### 1. FPX Account Setup
- [ ] Register for FPX merchant account
- [ ] Obtain Seller Exchange ID (e.g., EX00010946)
- [ ] Obtain Seller ID (e.g., SE00039889)
- [ ] Generate RSA private key pair
- [ ] Submit public key to FPX
- [ ] Configure callback URLs with FPX

### 2. PAYNET Account Setup (Optional Enhancement)
- [ ] Register for PAYNET merchant account
- [ ] Obtain PAYNET_MERCHANT_KEY (PROVIDED BY PAYNET)
- [ ] Configure PAYNET API endpoints (PROVIDED BY PAYNET)
- [ ] Set up PAYNET service access
- [ ] Configure PAYNET environment (sandbox/production)
- [ ] Test PAYNET authentication
- [ ] Obtain service-specific IDs (DuitNow, JomPAY, MEPS) (PROVIDED BY PAYNET)

### 3. Technical Prerequisites
- [ ] Django 3.0+ installed
- [ ] Python 3.7+ environment
- [ ] Database (PostgreSQL/MySQL) configured
- [ ] SSL certificate for production
- [ ] PyCrypto or Cryptodome library installed

### 4. Environment Setup
- [ ] Create environment-specific settings files (dev.py, uat.py, prod.py)
- [ ] Configure environment variables for each environment
- [ ] Set up environment-specific databases
- [ ] Configure environment-specific email settings
- [ ] Set up environment-specific logging
- [ ] Configure environment-specific security settings

## Database Setup

### 5. Create FPX App
```bash
python manage.py startapp FPX
```

### 6. Add to INSTALLED_APPS
```python
INSTALLED_APPS = [
    # ... existing apps
    'FPX',
]
```

### 7. Create Models
- [ ] FPX_Bank model for bank list management
- [ ] AC model for payment acknowledgements
- [ ] Update transaction model with FPX fields

### 8. Run Migrations
```bash
python manage.py makemigrations FPX
python manage.py migrate
```

## Configuration

### 9. Environment-Specific Settings
- [ ] Configure development settings (dev.py)
- [ ] Configure UAT settings (uat.py)
- [ ] Configure production settings (prod.py)
- [ ] Set up environment variables for each environment
- [ ] Configure environment-specific databases
- [ ] Set up environment-specific email configurations
- [ ] Configure environment-specific security settings
- [ ] Set up environment-specific logging

### 10. FPX Settings
```python
# settings.py
FPX_SETTINGS = {
    'SELLER_EX_ID': 'YOUR_SELLER_EX_ID',
    'SELLER_ID': 'YOUR_SELLER_ID',
    'SELLER_BANK_CODE': '01',
    'PRIVATE_KEY_PATH': 'path/to/your/private.key',
    'FPX_VERSION': '7.0',
    'CURRENCY': 'MYR',
    'GATEWAY_URL': 'https://www.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp',
    'BANK_LIST_URL': 'https://www.mepsfpx.com.my/FPXMain/RetrieveBankList',
}
```

### 11. URL Configuration
```python
# urls.py
urlpatterns = [
    path('fpx/', include('FPX.urls')),
]
```

## Transaction ID Implementation

### 12. Transaction ID Generation Setup
- [ ] Implement `get_random_string()` function for internal reference numbers
- [ ] Configure internal reference number format: `JF` + 18 random digits
- [ ] Set up FPX transaction ID field in donation model
- [ ] Implement transaction timestamp generation
- [ ] Add transaction ID validation functions
- [ ] Configure transaction ID logging

### 13. Transaction ID Usage Implementation
- [ ] Generate internal reference number during donation creation
- [ ] Use donation ID for FPX seller exchange order number
- [ ] Store FPX transaction ID from AC response
- [ ] Implement transaction ID traceability
- [ ] Add transaction ID to audit logs

## PAYNET Integration (Optional Enhancement)

### 14. PAYNET Configuration Setup
- [ ] Configure PAYNET_SETTINGS in Django settings
- [ ] Set up PAYNET_MERCHANT_KEY environment variable (PROVIDED BY PAYNET)
- [ ] Configure PAYNET API endpoints (PROVIDED BY PAYNET)
- [ ] Set up PAYNET authentication headers
- [ ] Implement PAYNET error handling
- [ ] Configure PAYNET logging
- [ ] Set up service-specific IDs (PROVIDED BY PAYNET)

### 15. PAYNET Service Integration
- [ ] Implement PAYNET authentication function
- [ ] Add PAYNET headers to FPX requests
- [ ] Implement PAYNET transaction monitoring
- [ ] Add PAYNET transaction reporting
- [ ] Implement PAYNET error handling
- [ ] Add PAYNET security validation
- [ ] Process PAYNET generated responses
- [ ] Store PAYNET provided transaction IDs

### 16. PAYNET Security Implementation
- [ ] Store PAYNET_MERCHANT_KEY securely
- [ ] Implement PAYNET key rotation
- [ ] Add PAYNET request validation
- [ ] Configure PAYNET SSL/TLS
- [ ] Set up PAYNET audit logging
- [ ] Implement PAYNET rate limiting

## Core Implementation

### 17. Views Implementation
- [ ] FPXView - Bank selection page
- [ ] StatusChange - Payment initiation
- [ ] ACResponse - Payment response handler
- [ ] ReceiptView - Payment receipt page
- [ ] BE_request - Bank list update

### 18. Security Implementation
- [ ] RSA checksum generation function
- [ ] CSRF exemption for callback URLs
- [ ] Input validation for all FPX data
- [ ] Error handling and logging

### 19. Templates Creation
- [ ] check_out_page.html - Bank selection
- [ ] status.html - Payment redirect
- [ ] receipt.html - Payment result
- [ ] AC_responds.html - Response handling

## Integration Flow

### 20. Payment Flow Implementation
```
1. User selects bank → FPXView
2. User clicks proceed → StatusChange (AR message)
3. User redirected to bank → Bank login
4. Bank sends response → ACResponse (AC message)
5. System updates status → ReceiptView
```

### 13. Bank List Management
- [ ] Implement BE message for bank list retrieval
- [ ] Parse bank status response
- [ ] Update database with bank availability
- [ ] Disable offline banks in UI

## Testing

### 14. Test Environment
- [ ] Configure test FPX credentials
- [ ] Set up test database
- [ ] Create test transaction data
- [ ] Test with FPX simulator banks

### 15. Test Cases
- [ ] Bank selection functionality
- [ ] Payment initiation (AR message)
- [ ] Payment response handling (AC message)
- [ ] Bank list update
- [ ] Error scenarios
- [ ] Offline bank handling

## Production Deployment

### 16. Security Checklist
- [ ] Private key stored securely
- [ ] HTTPS enabled for all communications
- [ ] Callback URLs accessible from internet
- [ ] Input validation implemented
- [ ] Error logging configured
- [ ] SSL certificates installed

### 17. Monitoring Setup
- [ ] Payment success/failure logging
- [ ] Bank list update monitoring
- [ ] Error alert system
- [ ] Transaction reconciliation

### 18. Documentation
- [ ] API documentation updated
- [ ] User guides created
- [ ] Troubleshooting guide
- [ ] Support contact information

## Post-Implementation

### 19. Go-Live Checklist
- [ ] FPX account activated for production
- [ ] Production credentials configured
- [ ] All banks tested and working
- [ ] Payment flow tested end-to-end
- [ ] Receipt generation working
- [ ] Email notifications configured

### 20. Maintenance Tasks
- [ ] Regular bank list updates
- [ ] Key rotation schedule
- [ ] Security audit schedule
- [ ] Performance monitoring
- [ ] Backup procedures

## Key Files to Create

### Models
```python
# FPX/models.py
- FPX_Bank model
- AC model
```

### Views
```python
# FPX/views.py
- FPXView
- StatusChange
- ACResponse
- ReceiptView
- BE_request
```

### Forms
```python
# FPX/forms.py
- ACForm
```

### URLs
```python
# FPX/urls.py
- All FPX endpoints
```

### Templates
```
# FPX/templates/FPX/
- check_out_page.html
- status.html
- receipt.html
- AC_responds.html
```

### Settings
```python
# settings.py
- FPX_SETTINGS configuration
```

## Common Issues & Solutions

### Checksum Generation
- **Issue**: Invalid checksum error
- **Solution**: Verify private key format and checksum string order

### Bank List Updates
- **Issue**: Banks not updating status
- **Solution**: Check FPX credentials and response parsing

### Payment Failures
- **Issue**: Payments not processing
- **Solution**: Verify transaction parameters and callback URLs

### AC Response Issues
- **Issue**: No response from banks
- **Solution**: Check CSRF exemption and URL accessibility

## Support Resources

- **FPX Documentation**: https://www.mepsfpx.com.my/
- **Technical Support**: Contact FPX support team
- **Bank Integration**: Contact individual banks for specific requirements

---

*This checklist should be completed in order for successful FPX integration.* 