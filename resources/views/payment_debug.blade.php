@extends('layouts.master')

@section('title', __('app.secure_payment') . ' - Jariah Fund')
@section('description', __('app.complete_your_payment'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">@lang('app.secure_payment') - DEBUG</h1>
        
        <!-- Debug Info -->
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
            <strong>Debug Mode:</strong> This page has enhanced logging to help identify JavaScript issues.
        </div>
        
        @php $method = $donationData['payment_method'] ?? null; @endphp
        @if(!$method)
            <div class="text-center text-red-600 font-semibold">No payment method selected. Please go back and choose a payment method.</div>
        @elseif($method === 'card')
            <form method="POST" action="{{ route('api.payment.process') }}" class="space-y-5" id="card-payment-form" data-js-enabled="false">
                @csrf
                <input type="hidden" name="donation_id" value="{{ $donationData['donation_id'] ?? '' }}">
                <input type="hidden" name="campaign_id" value="{{ $donationData['campaign_id'] ?? '' }}">
                <input type="hidden" name="donor_name" value="{{ $donationData['donor_name'] ?? '' }}">
                <input type="hidden" name="donor_email" value="{{ $donationData['donor_email'] ?? '' }}">
                <input type="hidden" name="donor_phone" value="{{ $donationData['donor_phone'] ?? '' }}">
                <input type="hidden" name="message" value="{{ $donationData['message'] ?? '' }}">
                <input type="hidden" name="is_anonymous" value="{{ $donationData['is_anonymous'] ?? '' }}">
                <input type="hidden" name="amount" value="{{ $donationData['amount'] ?? '' }}">
                <input type="hidden" name="payment_method" value="card">
                <input type="hidden" name="transaction_id" id="transaction_id">
                
                <div>
                    <label for="card_holder_name" class="block text-sm font-medium text-gray-700 mb-1">Cardholder Name</label>
                    <input type="text" name="card_holder_name" id="card_holder_name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500" required>
                </div>
                <div>
                    <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                    <input type="text" name="card_number" id="card_number" maxlength="19" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500" placeholder="0000 0000 0000 0000" required>
                </div>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <label for="card_expiry" class="block text-sm font-medium text-gray-700 mb-1">Expiry (MM/YY)</label>
                        <input type="text" name="card_expiry" id="card_expiry" maxlength="5" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500" placeholder="MM/YY" required>
                    </div>
                    <div class="flex-1">
                        <label for="card_cvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                        <input type="text" name="card_cvv" id="card_cvv" maxlength="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500" placeholder="123" required>
                    </div>
                </div>
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition">Proceed to Payment</button>
            </form>
        @elseif($method === 'obw')
            <form method="POST" action="{{ route('api.payment.process') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="donation_id" value="{{ $donationData['donation_id'] ?? '' }}">
                <input type="hidden" name="campaign_id" value="{{ $donationData['campaign_id'] ?? '' }}">
                <input type="hidden" name="donor_name" value="{{ $donationData['donor_name'] ?? '' }}">
                <input type="hidden" name="donor_email" value="{{ $donationData['donor_email'] ?? '' }}">
                <input type="hidden" name="donor_phone" value="{{ $donationData['donor_phone'] ?? '' }}">
                <input type="hidden" name="message" value="{{ $donationData['message'] ?? '' }}">
                <input type="hidden" name="is_anonymous" value="{{ $donationData['is_anonymous'] ?? '' }}">
                <input type="hidden" name="amount" value="{{ $donationData['amount'] ?? '' }}">
                <input type="hidden" name="payment_method" value="obw">
                <div>
                    <label for="obw_bank" class="block text-sm font-medium text-gray-700 mb-1">Select Your Bank</label>
                    <select name="obw_bank" id="obw_bank" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500" required>
                        <option value="">-- Select Bank --</option>
                        @foreach($banks as $bank)
                            <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition">Proceed to Payment</button>
            </form>
        @elseif($method === 'qr')
            <div class="text-center">
                <p class="mb-4 text-gray-700">Scan the QR code below with your banking app to complete the payment.</p>
                <div class="flex justify-center mb-4">
                    <img src="https://placehold.co/180x180/e0f2fe/0c4a6e?text=QR+Code" alt="QR Code" class="rounded-lg border border-gray-200">
                </div>
                <form method="POST" action="{{ route('api.payment.process') }}">
                    @csrf
                    <input type="hidden" name="donation_id" value="{{ $donationData['donation_id'] ?? '' }}">
                    <input type="hidden" name="campaign_id" value="{{ $donationData['campaign_id'] ?? '' }}">
                    <input type="hidden" name="donor_name" value="{{ $donationData['donor_name'] ?? '' }}">
                    <input type="hidden" name="donor_email" value="{{ $donationData['donor_email'] ?? '' }}">
                    <input type="hidden" name="donor_phone" value="{{ $donationData['donor_phone'] ?? '' }}">
                    <input type="hidden" name="message" value="{{ $donationData['message'] ?? '' }}">
                    <input type="hidden" name="is_anonymous" value="{{ $donationData['is_anonymous'] ?? '' }}">
                    <input type="hidden" name="amount" value="{{ $donationData['amount'] ?? '' }}">
                    <input type="hidden" name="payment_method" value="qr">
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition">I've Paid - Continue</button>
                </form>
            </div>
        @endif
        
        <!-- Debug Console -->
        <div class="mt-6 bg-gray-100 border border-gray-300 rounded p-4">
            <h3 class="font-semibold text-gray-700 mb-2">Debug Console:</h3>
            <div id="debug-console" class="bg-black text-green-400 p-3 rounded text-sm font-mono h-32 overflow-y-auto">
                <div>Waiting for JavaScript to load...</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Debug function to log messages
function debugLog(message) {
    const console = document.getElementById('debug-console');
    const timestamp = new Date().toLocaleTimeString();
    console.innerHTML += `<div>[${timestamp}] ${message}</div>`;
    console.scrollTop = console.scrollHeight;
    console.log(`[${timestamp}] ${message}`);
}

debugLog('Payment page JavaScript loaded');

document.addEventListener('DOMContentLoaded', function() {
    debugLog('DOM Content Loaded');
    
    const cardForm = document.getElementById('card-payment-form');
    debugLog(`Card form found: ${!!cardForm}`);
    
    if (cardForm) {
        debugLog('Setting up card form submit handler');
        
        // Mark JavaScript as enabled
        cardForm.setAttribute('data-js-enabled', 'true');
        debugLog('JavaScript enabled flag set');
        
        cardForm.addEventListener('submit', async function(e) {
            debugLog('Form submit intercepted');
            e.preventDefault();
            
            const submitBtn = cardForm.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                debugLog('Submit button disabled');
            }
            
            const merchantId = '400000000000005';
            const purchaseAmount = cardForm.querySelector('input[name="amount"]').value * 100;
            const purchaseCurrency = '458';
            const donationId = cardForm.querySelector('input[name="donation_id"]').value;
            
            debugLog(`Payment data: merchantId=${merchantId}, purchaseAmount=${purchaseAmount}, purchaseCurrency=${purchaseCurrency}, donationId=${donationId}`);
            
            submitBtn.textContent = 'Processing...';
            debugLog('Button text changed to "Processing..."');
            
            try {
                debugLog('Making key exchange request...');
                
                // Check CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    debugLog(`CSRF token found: ${csrfToken.getAttribute('content').substring(0, 10)}...`);
                } else {
                    debugLog('WARNING: CSRF token not found!');
                }
                
                const response = await fetch('/payment/api/key-exchange', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        payment_method: 'card',
                        merchant_id: merchantId,
                        purchase_amount: purchaseAmount,
                        purchase_currency: purchaseCurrency,
                        donation_id: donationId
                    })
                });
                
                debugLog(`Key exchange response status: ${response.status}`);
                const result = await response.json();
                debugLog(`Key exchange result: ${JSON.stringify(result)}`);
                
                if (result.success && result.transaction_id) {
                    debugLog(`Key exchange successful, transaction ID: ${result.transaction_id}`);
                    
                    // Store transaction_id in hidden input
                    document.getElementById('transaction_id').value = result.transaction_id;
                    debugLog('Transaction ID stored in hidden input');
                    
                    // Now submit the form to process payment
                    debugLog('Submitting form to process payment...');
                    
                    // Create form data for submission
                    const formData = new FormData(cardForm);
                    debugLog('FormData created from card form');
                    
                    const paymentResponse = await fetch('/api/payment/process', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });
                    
                    debugLog(`Payment response status: ${paymentResponse.status}`);
                    const paymentResult = await paymentResponse.json();
                    debugLog(`Payment result: ${JSON.stringify(paymentResult)}`);
                    
                    if (paymentResult.success) {
                        if (paymentResult.redirect_url && paymentResult.form_data) {
                            debugLog(`Redirect flow detected, redirecting to: ${paymentResult.redirect_url}`);
                            
                            // Redirect to Cardzone for 3DS authentication
                            const redirectUrl = new URL('{{ route("payment.redirect") }}', window.location.origin);
                            redirectUrl.searchParams.set('transaction_id', paymentResult.transaction_id);
                            redirectUrl.searchParams.set('redirect_url', paymentResult.redirect_url);
                            redirectUrl.searchParams.set('form_data', JSON.stringify(paymentResult.form_data));
                            
                            debugLog(`Redirecting to: ${redirectUrl.toString()}`);
                            window.location.href = redirectUrl.toString();
                        } else {
                            debugLog('No redirect flow, showing success message');
                            alert('Payment processed successfully!');
                        }
                    } else {
                        debugLog(`Payment failed: ${paymentResult.message}`);
                        alert('Payment failed: ' + (paymentResult.message || 'Unknown error'));
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = 'Proceed to Payment';
                        }
                    }
                } else {
                    debugLog(`Key exchange failed: ${result.message}`);
                    alert('Key exchange failed: ' + (result.message || 'Unknown error'));
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Proceed to Payment';
                    }
                }
            } catch (err) {
                debugLog(`Payment error: ${err.message}`);
                console.error('Payment error:', err);
                alert('Payment error: ' + err.message);
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Proceed to Payment';
                }
            }
        });
        
        debugLog('Form submit event listener attached');
    } else {
        debugLog('Card form not found');
    }
});
</script>
@endpush 