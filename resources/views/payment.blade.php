@extends('layouts.master')

@section('title', __('app.secure_payment') . ' - Jariah Fund')
@section('description', __('app.complete_your_payment'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">@lang('app.secure_payment')</h1>
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
                
                <!-- Card Details Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Card Details</h3>
                    <div class="space-y-4">
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
                    </div>
                </div>

                <!-- Billing Address Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Billing Address</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="billing_address_line1" class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                            <input type="text" name="billing_address_line1" id="billing_address_line1" maxlength="50" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="billing_address_line2" class="block text-sm font-medium text-gray-700 mb-1">Address Line 2</label>
                            <input type="text" name="billing_address_line2" id="billing_address_line2" maxlength="50" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="billing_address_line3" class="block text-sm font-medium text-gray-700 mb-1">Address Line 3</label>
                            <input type="text" name="billing_address_line3" id="billing_address_line3" maxlength="50" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="billing_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                            <input type="text" name="billing_city" id="billing_city" maxlength="50" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="billing_state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                            <select name="billing_state" id="billing_state" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select State</option>
                                <option value="01">Johor</option>
                                <option value="02">Kedah</option>
                                <option value="03">Kelantan</option>
                                <option value="04">Melaka</option>
                                <option value="05">Negeri Sembilan</option>
                                <option value="06">Pahang</option>
                                <option value="07">Pulau Pinang</option>
                                <option value="08">Perak</option>
                                <option value="09">Perlis</option>
                                <option value="10">Selangor</option>
                                <option value="11">Terengganu</option>
                                <option value="12">Sabah</option>
                                <option value="13">Sarawak</option>
                                <option value="14">Kuala Lumpur</option>
                                <option value="15">Labuan</option>
                                <option value="16">Putrajaya</option>
                            </select>
                        </div>
                        <div>
                            <label for="billing_country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                            <select name="billing_country" id="billing_country" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="458">Malaysia</option>
                            </select>
                        </div>
                        <div>
                            <label for="billing_postcode" class="block text-sm font-medium text-gray-700 mb-1">Postcode</label>
                            <input type="text" name="billing_postcode" id="billing_postcode" maxlength="16" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>
                </div>

                <!-- Shipping Address Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Shipping Address</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="shipping_address_line1" class="block text-sm font-medium text-gray-700 mb-1">Address Line 1</label>
                            <input type="text" name="shipping_address_line1" id="shipping_address_line1" maxlength="50" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="shipping_address_line2" class="block text-sm font-medium text-gray-700 mb-1">Address Line 2</label>
                            <input type="text" name="shipping_address_line2" id="shipping_address_line2" maxlength="50" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="shipping_address_line3" class="block text-sm font-medium text-gray-700 mb-1">Address Line 3</label>
                            <input type="text" name="shipping_address_line3" id="shipping_address_line3" maxlength="50" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                            <input type="text" name="shipping_city" id="shipping_city" maxlength="50" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="shipping_state" class="block text-sm font-medium text-gray-700 mb-1">State</label>
                            <select name="shipping_state" id="shipping_state" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select State</option>
                                <option value="01">Johor</option>
                                <option value="02">Kedah</option>
                                <option value="03">Kelantan</option>
                                <option value="04">Melaka</option>
                                <option value="05">Negeri Sembilan</option>
                                <option value="06">Pahang</option>
                                <option value="07">Pulau Pinang</option>
                                <option value="08">Perak</option>
                                <option value="09">Perlis</option>
                                <option value="10">Selangor</option>
                                <option value="11">Terengganu</option>
                                <option value="12">Sabah</option>
                                <option value="13">Sarawak</option>
                                <option value="14">Kuala Lumpur</option>
                                <option value="15">Labuan</option>
                                <option value="16">Putrajaya</option>
                            </select>
                        </div>
                        <div>
                            <label for="shipping_country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                            <select name="shipping_country" id="shipping_country" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="458">Malaysia</option>
                            </select>
                        </div>
                        <div>
                            <label for="shipping_postcode" class="block text-sm font-medium text-gray-700 mb-1">Postcode</label>
                            <input type="text" name="shipping_postcode" id="shipping_postcode" maxlength="16" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                    </div>
                </div>

                <!-- Address Match Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Address Verification</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="MPI_ADDR_MATCH" class="block text-sm font-medium text-gray-700 mb-1">Are billing and shipping addresses the same?</label>
                            <select name="MPI_ADDR_MATCH" id="MPI_ADDR_MATCH" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500" required>
                                <option value="N">No - Different Address</option>
                                <option value="Y">Yes - Same Address</option>
                            </select>
                            <!-- Backup hidden field to ensure the value is submitted -->
                            <input type="hidden" name="addr_match_backup" id="addr_match_backup" value="N">
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" value="" maxlength="254" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="home_phone" class="block text-sm font-medium text-gray-700 mb-1">Home Phone</label>
                            <input type="text" name="home_phone" id="home_phone" value="{{ $donationData['donor_phone'] ?? '' }}" maxlength="15" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="work_phone" class="block text-sm font-medium text-gray-700 mb-1">Work Phone</label>
                            <input type="text" name="work_phone" id="work_phone" maxlength="15" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <div>
                            <label for="mobile_phone" class="block text-sm font-medium text-gray-700 mb-1">Mobile Phone</label>
                            <input type="text" name="mobile_phone" id="mobile_phone" maxlength="15" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
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
    </div>
</div>
@endsection

@push('scripts')
<script>
console.log('Payment page JavaScript loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    
    const cardForm = document.getElementById('card-payment-form');
    console.log('Card form found:', !!cardForm);
    
    if (cardForm) {
        console.log('Setting up card form submit handler');
        
        // Mark JavaScript as enabled
        cardForm.setAttribute('data-js-enabled', 'true');
        
        cardForm.addEventListener('submit', async function(e) {
            console.log('Form submit intercepted');
            e.preventDefault();
            
            const submitBtn = cardForm.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.disabled = true;
            
            const merchantId = '400000000000005';
            const purchaseAmount = cardForm.querySelector('input[name="amount"]').value * 100;
            const purchaseCurrency = '458';
            const donationId = cardForm.querySelector('input[name="donation_id"]').value;
            
            console.log('Payment data:', {
                merchantId,
                purchaseAmount,
                purchaseCurrency,
                donationId
            });
            
            submitBtn.textContent = 'Processing...';
            
            try {
                console.log('Making key exchange request...');
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
                
                console.log('Key exchange response received');
                const result = await response.json();
                console.log('Key exchange result:', result);
                
                if (result.success && result.transaction_id) {
                    console.log('Key exchange successful, transaction ID:', result.transaction_id);
                    
                    // Store transaction_id in hidden input
                    document.getElementById('transaction_id').value = result.transaction_id;
                    
                    // Now submit the form to process payment
                    console.log('Submitting form to process payment...');
                    
                    // Create form data for submission
                    const formData = new FormData(cardForm);
                    
                    // Ensure MPI_ADDR_MATCH field is included
                    const addrMatchField = document.getElementById('MPI_ADDR_MATCH');
                    const addrMatchBackup = document.getElementById('addr_match_backup');
                    if (addrMatchField && addrMatchBackup) {
                        // Sync the backup field with the select value
                        addrMatchBackup.value = addrMatchField.value;
                        
                        // Manually add MPI_ADDR_MATCH to FormData if not present
                        if (!formData.has('MPI_ADDR_MATCH')) {
                            formData.append('MPI_ADDR_MATCH', addrMatchField.value);
                        }
                    }
                    
                    const paymentResponse = await fetch('/api/payment/process', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });
                    
                    console.log('Payment response received');
                    const paymentResult = await paymentResponse.json();
                    console.log('Payment result:', paymentResult);
                    
                    if (paymentResult.success) {
                        if (paymentResult.redirect_url && paymentResult.form_data) {
                            console.log('Redirect flow detected, redirecting to:', paymentResult.redirect_url);
                            
                            // Redirect to Cardzone for 3DS authentication
                            const redirectUrl = new URL('{{ route("payment.redirect") }}', window.location.origin);
                            redirectUrl.searchParams.set('transaction_id', paymentResult.transaction_id);
                            redirectUrl.searchParams.set('redirect_url', paymentResult.redirect_url);
                            redirectUrl.searchParams.set('form_data', JSON.stringify(paymentResult.form_data));
                            
                            console.log('Redirecting to:', redirectUrl.toString());
                            window.location.href = redirectUrl.toString();
                        } else {
                            console.log('No redirect flow, showing success message');
                            alert('Payment processed successfully!');
                        }
                    } else {
                        console.error('Payment failed:', paymentResult.message);
                        alert('Payment failed: ' + (paymentResult.message || 'Unknown error'));
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = 'Proceed to Payment';
                        }
                    }
                } else {
                    console.error('Key exchange failed:', result.message);
                    alert('Key exchange failed: ' + (result.message || 'Unknown error'));
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Proceed to Payment';
                    }
                }
            } catch (error) {
                console.error('Network error:', error);
                alert('Network error occurred. Please try again.');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Proceed to Payment';
                }
            }
        });
    }
});
</script>
@endpush 