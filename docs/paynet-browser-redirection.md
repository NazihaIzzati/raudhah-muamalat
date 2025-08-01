# Paynet FPX Browser Redirection Guide

Based on the [official Paynet FPX Browser Redirection documentation](https://docs.developer.paynet.my/docs/fpx/browser-redirection).

## Overview

This guide covers the complete browser redirection flow for Paynet FPX payments, including merchant requirements, bank integration, and proper redirection handling.

## Redirection Flow

```
Merchant → FPX → Buyer Bank → FPX → Merchant
```

## Merchant Requirements

### 1. Merchant Web Page Requirements

#### FPX Information Display
Merchant must display the following FPX information:

- **FPX Logo**: Official Paynet FPX logo
- **FPX Operating Hours**: Current operating hours
- **FPX Information Link**: Link to https://www.paynet.my/personal-fpx.html

#### Mobile Browser Compatibility
Merchant web pages must be compatible with major mobile browsers:
- iOS: Safari, Chrome
- Android: Chrome, Android mobile browser, Mozilla Firefox

#### Terms and Conditions
Merchant must include FPX Terms and Conditions with proper linking:

| Environment | URL |
|-------------|-----|
| UAT | https://uat.mepsfpx.com.my/FPXMain/termsAndConditions.jsp |
| Production | https://www.mepsfpx.com.my/FPXMain/termsAndConditions.jsp |

**Requirements**:
- Statement on FPX Terms and Conditions
- Link opens in new browser window
- "Proceed" button indicates buyer acceptance

### 2. Redirection Requirements

#### Form POST via SSL
- Use FORM POST request via SSL
- Display Internet Banking page in full browser window
- **DO NOT** use pop-up windows or new browser tabs
- **DO NOT** use HTML iFrame

#### Buyer Bank List
- Display all buyer banks in dropdown
- Show "Offline" for banks with Blocked (B) status
- Implement auto-sending of BE message for bank list
- FPX responds with BC message containing bank details

### 3. Merchant Receipt Page

Display the following transaction details:

- Transaction Date
- Transaction Amount
- Seller Order Number
- FPX Transaction ID
- Buyer Bank Name
- Transaction Status

**Transaction Status Codes**:
- **Successful (00)**: Transaction completed successfully
- **Pending for Authorization (99)**: Awaiting bank authorization
- **Pending (09)**: Transaction in progress
- **Others**: Any other response codes

### 4. Other Requirements

#### IP Address
- **DO NOT** whitelist FPX IP addresses in firewall
- Use PayNet's URL for all messages
- Ensures no disruption during IP changes

#### Transaction Limits
- Follow FPX minimum and maximum transaction limits
- **DO NOT** hardcode limit values
- FPX may change limits at any time

#### Buyer's Email Address
- Capture customer email address when possible
- Pass email address in AR and AE messages to FPX

#### Automatic Certificate Renewal
- Implement functionality to replace FPX Certificate automatically
- Ensure FPX transactions are not affected during transition

## Implementation in Laravel

### 1. Merchant Page Implementation

```php
// resources/views/payment.blade.php
<div class="fpx-payment-section">
    <!-- FPX Logo -->
    <img src="{{ asset('images/payment/fpx-logo.png') }}" alt="FPX" class="fpx-logo">
    
    <!-- FPX Information -->
    <div class="fpx-info">
        <p><strong>FPX Operating Hours:</strong> 24/7</p>
        <p><a href="https://www.paynet.my/personal-fpx.html" target="_blank">Learn more about FPX</a></p>
    </div>
    
    <!-- Bank Selection -->
    <div class="bank-selection">
        <label for="fpx_bank">Select Your Bank:</label>
        <select name="fpx_bank" id="fpx_bank" required>
            <option value="">-- Select Bank --</option>
            @foreach($banks as $bank)
                <option value="{{ $bank->code }}" 
                        {{ $bank->status === 'B' ? 'disabled' : '' }}>
                    {{ $bank->name }}
                    {{ $bank->status === 'B' ? ' (Offline)' : '' }}
                </option>
            @endforeach
        </select>
    </div>
    
    <!-- Terms and Conditions -->
    <div class="terms-conditions">
        <label>
            <input type="checkbox" name="accept_terms" required>
            I accept the <a href="{{ $fpxTermsUrl }}" target="_blank">FPX Terms and Conditions</a>
        </label>
    </div>
    
    <!-- Proceed Button -->
    <button type="submit" class="proceed-btn">Proceed to Payment</button>
</div>
```

### 2. Redirection Controller

```php
// app/Http/Controllers/PaymentController.php

public function redirectToFpx(Request $request)
{
    // Validate request
    $request->validate([
        'fpx_bank' => 'required|string',
        'amount' => 'required|numeric|min:1',
        'accept_terms' => 'required|accepted'
    ]);
    
    // Create transaction
    $transaction = $this->createTransaction($request);
    
    // Generate FPX payment data
    $fpxData = $this->paynetService->createFpxPayment($transaction);
    
    // Get FPX redirect URL based on environment
    $fpxUrl = config('paynet.fpx_redirect_url');
    
    return view('payment.fpx-redirect', [
        'fpxUrl' => $fpxUrl,
        'fpxData' => $fpxData,
        'transaction' => $transaction
    ]);
}
```

### 3. FPX Redirect View

```php
// resources/views/payment/fpx-redirect.blade.php
@extends('layouts.master')

@section('content')
<div class="fpx-redirect">
    <h2>Redirecting to FPX...</h2>
    <p>You will be redirected to your bank's secure payment page.</p>
    
    <!-- Auto-submit form -->
    <form id="fpxForm" method="POST" action="{{ $fpxUrl }}">
        @foreach($fpxData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>
    
    <script>
        // Auto-submit form after page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('fpxForm').submit();
        });
    </script>
</div>
@endsection
```

### 4. Receipt Page Implementation

```php
// resources/views/payment/receipt.blade.php
@extends('layouts.master')

@section('content')
<div class="receipt-page">
    <h2>Payment Receipt</h2>
    
    <div class="receipt-details">
        <div class="detail-row">
            <span class="label">Transaction Date:</span>
            <span class="value">{{ $transaction->created_at->format('Y-m-d H:i:s') }}</span>
        </div>
        
        <div class="detail-row">
            <span class="label">Transaction Amount:</span>
            <span class="value">RM {{ number_format($transaction->amount, 2) }}</span>
        </div>
        
        <div class="detail-row">
            <span class="label">Seller Order Number:</span>
            <span class="value">{{ $transaction->transaction_id }}</span>
        </div>
        
        <div class="detail-row">
            <span class="label">FPX Transaction ID:</span>
            <span class="value">{{ $transaction->paynet_response_data['fpx_fpxTxnId'] ?? 'N/A' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="label">Buyer Bank Name:</span>
            <span class="value">{{ $transaction->paynet_response_data['fpx_buyerBankId'] ?? 'N/A' }}</span>
        </div>
        
        <div class="detail-row">
            <span class="label">Transaction Status:</span>
            <span class="value status-{{ $transaction->status }}">
                @switch($transaction->status)
                    @case('completed')
                        <span class="success">Successful</span>
                        @break
                    @case('pending')
                        <span class="warning">Pending</span>
                        @break
                    @case('failed')
                        <span class="error">Failed</span>
                        @break
                    @default
                        <span class="unknown">Unknown</span>
                @endswitch
            </span>
        </div>
    </div>
    
    <div class="receipt-actions">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
        <a href="{{ route('donations.index') }}" class="btn btn-secondary">View All Donations</a>
    </div>
</div>
@endsection
```

### 5. Configuration

```php
// config/paynet.php
return [
    'fpx_redirect_url' => env('PAYNET_FPX_REDIRECT_URL', 'https://uat.mepsfpx.com.my/FPXMain/processMesgFromSBIBanks.jsp'),
    'fpx_terms_url' => env('PAYNET_FPX_TERMS_URL', 'https://uat.mepsfpx.com.my/FPXMain/termsAndConditions.jsp'),
    'environment' => env('PAYNET_ENVIRONMENT', 'uat'),
];
```

### 6. Environment Variables

```bash
# FPX Browser Redirection
PAYNET_FPX_REDIRECT_URL=https://uat.mepsfpx.com.my/FPXMain/processMesgFromSBIBanks.jsp
PAYNET_FPX_TERMS_URL=https://uat.mepsfpx.com.my/FPXMain/termsAndConditions.jsp
PAYNET_ENVIRONMENT=uat
```

## Bank Integration Requirements

### 1. FPX to Buyer Bank Redirection

Banks must implement:

- Seamless redirection to Internet Banking
- Use `mesgToBank` parameter for redirection
- Display in same browser page as FPX page

**Sample Code**:
```html
<form action="" method="POST" name="f2">
    <input type="hidden" name="mesgToBank" value="<?xml version="1.0" encoding="UTF-8"?>
    <OFX>
        <AUTHREQ>
            <MSGTYPE>AR</MSGTYPE>
            <MSGTOKEN>01</MSGTOKEN>
            <!-- ... other fields ... -->
        </AUTHREQ>
    </OFX>">
</form>
```

### 2. Buyer Bank to FPX Redirection

Banks must implement:

- Send Indirect AC message back to FPX via Browser
- Use `mesgFromBank` parameter
- Use Response URL from AR message
- Handle "Cancel" button with appropriate response code

**Sample Code**:
```html
<form method="post" action="https://uat.mepsfpx.com.my/FPXMain/processMesgFromSBIBanks.jsp">
    <input type="hidden" name="mesgFromBank" value='<?xml version="1.0" encoding="UTF-8"?>
    <OFX>
        <AUTHRESP>
            <MSGTYPE>AC</MSGTYPE>
            <FPXTRANSID>1406180936420602</FPXTRANSID>
            <!-- ... other fields ... -->
        </AUTHRESP>
    </OFX>'>
</form>
```

## CSS Styling

```css
/* FPX Payment Section */
.fpx-payment-section {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
}

.fpx-logo {
    max-width: 150px;
    height: auto;
    margin-bottom: 15px;
}

.fpx-info {
    margin-bottom: 20px;
    padding: 15px;
    background: #e9ecef;
    border-radius: 5px;
}

.fpx-info p {
    margin: 5px 0;
}

.bank-selection {
    margin-bottom: 20px;
}

.bank-selection label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
}

.bank-selection select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 16px;
}

.terms-conditions {
    margin-bottom: 20px;
    padding: 15px;
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 5px;
}

.terms-conditions label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
}

.terms-conditions input[type="checkbox"] {
    margin: 0;
}

.proceed-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
}

.proceed-btn:hover {
    background: #0056b3;
}

/* Receipt Page */
.receipt-page {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.receipt-details {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #dee2e6;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-row .label {
    font-weight: 600;
    color: #495057;
}

.detail-row .value {
    color: #212529;
}

.status-completed .success {
    color: #28a745;
    font-weight: 600;
}

.status-pending .warning {
    color: #ffc107;
    font-weight: 600;
}

.status-failed .error {
    color: #dc3545;
    font-weight: 600;
}

.status-unknown .unknown {
    color: #6c757d;
    font-weight: 600;
}

.receipt-actions {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.btn {
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}
```

## Testing

### 1. UAT Environment Testing

```php
// tests/Feature/FpxBrowserRedirectionTest.php
class FpxBrowserRedirectionTest extends TestCase
{
    public function test_fpx_redirect_page_displays_correctly()
    {
        $response = $this->get('/payment/fpx');
        
        $response->assertStatus(200);
        $response->assertSee('FPX');
        $response->assertSee('Select Your Bank');
        $response->assertSee('Terms and Conditions');
    }
    
    public function test_fpx_redirect_with_valid_data()
    {
        $data = [
            'fpx_bank' => 'MB2U0227',
            'amount' => 100.00,
            'accept_terms' => 'on'
        ];
        
        $response = $this->post('/payment/fpx/redirect', $data);
        
        $response->assertStatus(200);
        $response->assertSee('Redirecting to FPX');
    }
    
    public function test_fpx_redirect_requires_terms_acceptance()
    {
        $data = [
            'fpx_bank' => 'MB2U0227',
            'amount' => 100.00
            // Missing accept_terms
        ];
        
        $response = $this->post('/payment/fpx/redirect', $data);
        
        $response->assertStatus(422);
    }
}
```

### 2. Production Checklist

- [ ] FPX logo displayed correctly
- [ ] Operating hours information shown
- [ ] FPX information link works
- [ ] Terms and conditions link opens in new window
- [ ] Bank selection dropdown populated
- [ ] Offline banks marked correctly
- [ ] Form POST via SSL implemented
- [ ] No pop-ups or iframes used
- [ ] Receipt page shows all required fields
- [ ] Transaction status displayed correctly
- [ ] Mobile browser compatibility tested
- [ ] Certificate renewal functionality implemented

## Security Considerations

1. **SSL/TLS**: All redirections must use HTTPS
2. **No IP Whitelisting**: Don't whitelist FPX IPs
3. **Form Validation**: Validate all input data
4. **CSRF Protection**: Implement CSRF tokens
5. **Session Security**: Secure session management
6. **Error Handling**: Proper error handling without exposing sensitive data

## Best Practices

1. **User Experience**: Clear instructions and progress indicators
2. **Error Messages**: User-friendly error messages
3. **Loading States**: Show loading indicators during redirection
4. **Mobile Optimization**: Ensure mobile-friendly design
5. **Accessibility**: Follow accessibility guidelines
6. **Testing**: Comprehensive testing across browsers and devices

## Support

For browser redirection issues:
- Paynet Developer Portal: https://developer.paynet.my
- FPX Documentation: https://docs.developer.paynet.my/docs/fpx/browser-redirection
- Technical Support: Contact Paynet support team 