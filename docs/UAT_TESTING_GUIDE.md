# UAT Testing Guide - FPX Payment Integration

## Overview

This guide provides comprehensive instructions for testing the FPX payment integration in the UAT (User Acceptance Testing) environment for Jariah Fund.

## 🚀 Quick Start

### 1. Environment Setup

```bash
# Run the UAT setup script
./setup-uat-environment.sh

# Copy UAT environment configuration
cp .env.uat .env

# Run database migrations
php artisan migrate

# Seed test data
php artisan db:seed --class=UatTestDataSeeder

# Validate setup
./validate-uat-setup.sh

# Start the development server
php artisan serve
```

### 2. Test Configuration

| Setting | Value |
|---------|-------|
| Environment | UAT |
| Merchant ID | EX00010946 |
| Gateway URL | https://uat.mepsfpx.com.my/FPXMain/seller2DReceiver.jsp |
| Callback URL | http://localhost:8000/payment/paynet/callback |
| Test Amount | RM 10.00 |

## 🧪 Test Scenarios

### Scenario 1: Successful Payment Flow

**Objective**: Test complete payment flow from initiation to successful completion

**Steps**:
1. Navigate to a campaign page
2. Click "Donate Now"
3. Fill in donation form:
   - Amount: RM 10.00
   - Donor Name: Test User
   - Email: test@jariahfund.com
   - Message: UAT Test Donation
4. Select FPX as payment method
5. Click "Proceed to Payment"
6. Verify redirect to FPX gateway
7. Complete payment on bank page
8. Verify successful callback and receipt

**Expected Results**:
- ✅ Redirect to FPX gateway
- ✅ Payment processed successfully
- ✅ Receipt page displayed
- ✅ Transaction recorded in database
- ✅ Email confirmation sent

### Scenario 2: Pending Payment Flow

**Objective**: Test payment flow when bank response is pending

**Steps**:
1. Follow steps 1-6 from Scenario 1
2. On bank page, simulate pending response
3. Verify pending page display
4. Check transaction status in database

**Expected Results**:
- ✅ Pending page displayed
- ✅ Transaction status: pending
- ✅ Clear instructions provided

### Scenario 3: Failed Payment Flow

**Objective**: Test payment flow when payment fails

**Steps**:
1. Follow steps 1-6 from Scenario 1
2. On bank page, simulate failed payment
3. Verify error page display
4. Check transaction status in database

**Expected Results**:
- ✅ Error page displayed
- ✅ Transaction status: failed
- ✅ Clear error message shown

### Scenario 4: Payment Cancellation

**Objective**: Test payment cancellation flow

**Steps**:
1. Follow steps 1-6 from Scenario 1
2. On bank page, click "Cancel"
3. Verify cancellation handling
4. Check transaction status

**Expected Results**:
- ✅ Cancellation handled gracefully
- ✅ User returned to donation form
- ✅ Transaction status: cancelled

## 🔍 Validation Checklist

### Environment Configuration
- [ ] UAT environment set in `.env`
- [ ] UAT keys generated and accessible
- [ ] Database configured for UAT
- [ ] Test data seeded

### Payment Gateway
- [ ] FPX gateway URL accessible
- [ ] Merchant ID configured correctly
- [ ] Callback URL working
- [ ] Bank list retrieved successfully

### User Interface
- [ ] Payment redirect page displays correctly
- [ ] Progress indicators work
- [ ] Transaction details shown
- [ ] Security information displayed
- [ ] Manual redirect button functional

### Response Pages
- [ ] Success page displays correctly
- [ ] Receipt page shows transaction details
- [ ] Pending page provides clear instructions
- [ ] Error page handles failures gracefully

### Database Integration
- [ ] Transactions recorded correctly
- [ ] Donations linked to transactions
- [ ] Status updates work
- [ ] Response data stored

### Security Features
- [ ] HTTPS redirects work
- [ ] Form validation active
- [ ] CSRF protection enabled
- [ ] Input sanitization working

## 🛠️ Troubleshooting

### Common Issues

#### Issue: "Keys not found"
**Solution**:
```bash
# Regenerate UAT keys
./setup-uat-environment.sh
```

#### Issue: "Database connection failed"
**Solution**:
```bash
# Check database configuration
php artisan config:clear
php artisan cache:clear
```

#### Issue: "FPX gateway not accessible"
**Solution**:
- Verify UAT gateway URL is correct
- Check network connectivity
- Ensure firewall allows connections

#### Issue: "Callback not working"
**Solution**:
- Verify callback URL in configuration
- Check server logs for errors
- Ensure route is properly defined

### Debug Commands

```bash
# Check environment configuration
php artisan config:show paynet

# Test database connection
php artisan tinker
>>> DB::connection()->getPdo()

# Check routes
php artisan route:list | grep payment

# View logs
tail -f storage/logs/laravel.log

# Test UAT keys
openssl x509 -in ssh-keygen/uat_merchant_certificate.cer -text -noout
```

## 📊 Test Data

### Test Campaigns
- **UAT Test Campaign**: RM 10,000 target, active status

### Test Banks
- **TEST001**: Test Bank 1
- **TEST002**: Test Bank 2  
- **TEST003**: Test Bank 3

### Test Transactions
- **Amount Range**: RM 1.00 - RM 500.00
- **Currency**: MYR
- **Payment Method**: FPX

## 🔐 Security Testing

### SSL/TLS Verification
- [ ] HTTPS enforced on payment pages
- [ ] SSL certificates valid
- [ ] Mixed content warnings resolved

### Input Validation
- [ ] Amount validation working
- [ ] Email format validation
- [ ] XSS protection active
- [ ] SQL injection protection

### Session Security
- [ ] Session timeout working
- [ ] CSRF tokens validated
- [ ] Session fixation protection

## 📈 Performance Testing

### Load Testing
- [ ] Payment page loads < 3 seconds
- [ ] Redirect page loads < 2 seconds
- [ ] Receipt page loads < 2 seconds

### Stress Testing
- [ ] Multiple concurrent payments
- [ ] High volume transactions
- [ ] Database performance under load

## 📝 Test Reports

### Daily Test Report Template

```
Date: [DATE]
Tester: [NAME]
Environment: UAT

Test Scenarios Executed:
- [ ] Scenario 1: Successful Payment
- [ ] Scenario 2: Pending Payment  
- [ ] Scenario 3: Failed Payment
- [ ] Scenario 4: Payment Cancellation

Issues Found:
- [ ] Issue 1: [Description]
- [ ] Issue 2: [Description]

Pass Rate: [X]%

Notes:
[Additional observations]
```

## 🎯 Success Criteria

### Functional Requirements
- ✅ All payment flows work correctly
- ✅ Error handling is robust
- ✅ User experience is smooth
- ✅ Data integrity maintained

### Non-Functional Requirements
- ✅ Performance meets standards
- ✅ Security requirements met
- ✅ Accessibility standards followed
- ✅ Mobile responsiveness verified

## 📞 Support

For UAT testing support:
- **Technical Issues**: Check logs and run debug commands
- **Configuration Issues**: Review `.env.uat` settings
- **Payment Issues**: Verify UAT gateway connectivity

## 🔄 Continuous Testing

### Automated Tests
```bash
# Run payment tests
php artisan test --filter=PaymentTest

# Run FPX integration tests
php artisan test --filter=FpxTest
```

### Manual Testing Schedule
- **Daily**: Core payment flows
- **Weekly**: Edge cases and error scenarios
- **Monthly**: Full regression testing

---

**Last Updated**: [DATE]
**Version**: 1.0
**Environment**: UAT 