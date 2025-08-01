@extends('layouts.master')

@section('title', __('app.secure_payment') . ' - Jariah Fund')
@section('description', __('app.complete_your_payment'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">@lang('app.secure_payment')</h1>
        <p class="text-sm text-gray-600 text-center mb-8">@lang('app.complete_your_payment')</p>
        
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
        @elseif($method === 'fpx')
            <!-- FPX Online Banking Section -->
            <div class="space-y-6">
                <!-- FPX Header -->
                <div class="text-center mb-6">
                    <img src="{{ asset('assets/images/paynet/FPX_Logo_FA_Full_FC.png') }}" alt="FPX" class="h-16 mx-auto mb-4 object-contain">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">FPX Online Banking</h3>
                    <p class="text-sm text-gray-600">Secure bank transfer via Paynet</p>
                    <div class="mt-2 text-xs text-gray-500">
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Operating Hours: 24/7
                        </span>
                        <span class="mx-2">•</span>
                        <a href="https://www.paynet.my/personal-fpx.html" target="_blank" class="text-blue-600 hover:text-blue-800">Learn More</a>
                    </div>
                </div>

                <!-- FPX Payment Form -->
                <form method="POST" action="{{ route('api.payment.fpx') }}" class="space-y-5" id="fpx-payment-form">
                    @csrf
                    <input type="hidden" name="donation_id" value="{{ $donationData['donation_id'] ?? '' }}">
                    <input type="hidden" name="campaign_id" value="{{ $donationData['campaign_id'] ?? '' }}">
                    <input type="hidden" name="amount" value="{{ $donationData['amount'] ?? '' }}">
                    <input type="hidden" name="donor_name" value="{{ $donationData['donor_name'] ?? '' }}">
                    <input type="hidden" name="donor_email" value="{{ $donationData['donor_email'] ?? '' }}">
                    <input type="hidden" name="donor_phone" value="{{ $donationData['donor_phone'] ?? '' }}">
                    <input type="hidden" name="message" value="{{ $donationData['message'] ?? '' }}">
                    <input type="hidden" name="is_anonymous" value="{{ $donationData['is_anonymous'] ?? '' }}">

                    <!-- Buyer Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-semibold text-gray-900 mb-3">{{ __('app.buyer_information') }}</h4>
                        <div class="space-y-4">
                            <div>
                                <label for="fpx_buyer_name" class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.full_name') }} *</label>
                                <input type="text" name="fpx_buyer_name" id="fpx_buyer_name" 
                                       value="{{ $donationData['donor_name'] ?? '' }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500" 
                                       maxlength="100" required>
                                <p class="text-xs text-gray-500 mt-1">{{ __('app.enter_full_name_bank_account') }}</p>
                            </div>
                            <div>
                                <label for="fpx_buyer_email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('app.email_address') }} *</label>
                                <input type="email" name="fpx_buyer_email" id="fpx_buyer_email" 
                                       value="{{ $donationData['donor_email'] ?? '' }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Selection -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-md font-semibold text-gray-900 mb-3">{{ __('app.select_your_bank') }}</h4>
                        <div>
                            <label for="fpx_bank" class="block text-sm font-medium text-gray-700 mb-1">Bank *</label>
                            <select name="fpx_bank" id="fpx_bank" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-orange-500 focus:border-orange-500" 
                                    required>
                                <option value="">-- {{ __('app.select_your_bank') }} --</option>
                                <optgroup label="Commercial Banks" id="commercial-banks">
                                    <!-- Commercial banks will be populated dynamically -->
                                </optgroup>
                                <optgroup label="Islamic Banks" id="islamic-banks">
                                    <!-- Islamic banks will be populated dynamically -->
                                </optgroup>
                                <optgroup label="Government Banks" id="government-banks">
                                    <!-- Government banks will be populated dynamically -->
                                </optgroup>
                                <optgroup label="Other Banks" id="other-banks">
                                    <!-- Other banks will be populated dynamically -->
                                </optgroup>
                            </select>
                            <div id="bank-loading" class="mt-2 text-sm text-gray-500">
                                <svg class="animate-spin h-4 w-4 inline mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading banks from Paynet...
                            </div>
                            <div id="bank-error" class="mt-2 text-sm text-red-500 hidden">
                                Failed to load banks. Using default list.
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" name="accept_terms" id="accept_terms" 
                                   class="mt-1 h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded" 
                                   required>
                            <div>
                                <label for="accept_terms" class="text-sm text-gray-700">
                                    {{ __('app.accept_fpx_terms') }}
                                    *
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        {{ __('app.proceed_to_fpx_payment') }}
                    </button>
                </form>
            </div>
        @elseif($method === 'qr')
            <div class="text-center">
                <p class="mb-4 text-gray-700">Scan the QR code below with your banking app to complete the payment.</p>
                <div class="flex justify-center mb-4">
                    <div class="w-48 h-48 bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-24 h-24 mx-auto text-gray-400 mb-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 3h6v6H3V3zm2 2v2h2V5H5zm8-2h6v6h-6V3zm2 2v2h2V5h-2zM3 11h6v6H3v-6zm2 2v2h2v-2H5zm8 2h2v2h-2v-2zm4 0h2v2h-2v-2zm-4-4h2v2h-2V9zm4 0h2v2h-2V9zm-4-4h2v2h-2V5zm4 0h2v2h-2V5z"/>
                            </svg>
                            <p class="text-sm text-gray-500">QR Code</p>
                            <p class="text-xs text-gray-400">Scan with your banking app</p>
                        </div>
                    </div>
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
    
    // Fetch banks from Paynet API
    async function loadBanksFromPaynet() {
        const bankSelect = document.getElementById('fpx_bank');
        const loadingDiv = document.getElementById('bank-loading');
        const errorDiv = document.getElementById('bank-error');
        
        console.log('Bank select element found:', !!bankSelect);
        console.log('Loading div found:', !!loadingDiv);
        console.log('Error div found:', !!errorDiv);
        
        if (!bankSelect || !loadingDiv) {
            console.log('Required elements not found, retrying in 500ms...');
            setTimeout(() => {
                loadBanksFromPaynet();
            }, 500);
            return;
        }
        
        try {
            console.log('Fetching banks from Paynet...');
            const response = await fetch('/api/fpx/banks', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            console.log('Bank list response:', result);
            
            if (result.success && result.banks && result.banks.length > 0) {
                // Clear existing options except the first one
                const firstOption = bankSelect.querySelector('option[value=""]');
                bankSelect.innerHTML = '';
                if (firstOption) {
                    bankSelect.appendChild(firstOption);
                }
                
                // Group banks by type
                const commercialBanks = [];
                const islamicBanks = [];
                const governmentBanks = [];
                const otherBanks = [];
                
                result.banks.forEach(bank => {
                    const bankName = bank.name || bank.full_name || 'Unknown Bank';
                    const bankCode = bank.code || bank.id || bank.bank_id;
                    
                    const bankOption = {
                        value: bankCode,
                        text: bankName,
                        group: determineBankGroup(bankName, bankCode)
                    };
                    
                    switch (bankOption.group) {
                        case 'commercial':
                            commercialBanks.push(bankOption);
                            break;
                        case 'islamic':
                            islamicBanks.push(bankOption);
                            break;
                        case 'government':
                            governmentBanks.push(bankOption);
                            break;
                        default:
                            otherBanks.push(bankOption);
                            break;
                    }
                });
                
                // Populate bank groups
                populateBankGroup('commercial-banks', commercialBanks);
                populateBankGroup('islamic-banks', islamicBanks);
                populateBankGroup('government-banks', governmentBanks);
                populateBankGroup('other-banks', otherBanks);
                
                loadingDiv.style.display = 'none';
                console.log('Banks loaded successfully from Paynet');
            } else {
                throw new Error('No banks returned from API');
            }
        } catch (error) {
            console.error('Failed to load banks from Paynet:', error);
            loadingDiv.style.display = 'none';
            errorDiv.classList.remove('hidden');
            errorDiv.textContent = 'Failed to load banks from Paynet. Using default list.';
        }
    }
    
    // Determine bank group based on name and code
    function determineBankGroup(bankName, bankCode) {
        const name = bankName.toLowerCase();
        const code = bankCode.toLowerCase();
        
        // Islamic banks
        if (name.includes('islam') || name.includes('muamalat') || name.includes('kfh') || 
            code.includes('bimb') || code.includes('bmmb') || code.includes('kfh')) {
            return 'islamic';
        }
        
        // Government banks
        if (name.includes('bsn') || name.includes('rakyat') || name.includes('agro') || 
            name.includes('china') || code.includes('bsn') || code.includes('bkrm') || 
            code.includes('agro') || code.includes('bocm')) {
            return 'government';
        }
        
        // Commercial banks (default)
        return 'commercial';
    }
    
    // Populate bank group with options
    function populateBankGroup(groupId, banks) {
        let group = document.getElementById(groupId);
        console.log(`Populating group ${groupId}:`, !!group, 'with', banks.length, 'banks');
        
        if (!group) {
            console.log(`Group ${groupId} not found in DOM, creating it...`);
            // Debug: List all elements with similar IDs
            const allElements = document.querySelectorAll('[id*="bank"]');
            console.log('Available bank-related elements:', Array.from(allElements).map(el => el.id));
            
            // Create the optgroup if it doesn't exist
            const bankSelect = document.getElementById('fpx_bank');
            if (bankSelect) {
                group = document.createElement('optgroup');
                group.id = groupId;
                group.label = groupId.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase());
                bankSelect.appendChild(group);
                console.log(`Created optgroup ${groupId}`);
            } else {
                console.log('Bank select element not found, cannot create optgroup');
                return;
            }
        }
        
        banks.forEach(bank => {
            const option = document.createElement('option');
            option.value = bank.value;
            option.textContent = bank.text;
            group.appendChild(option);
        });
        console.log(`Added ${banks.length} banks to ${groupId}`);
    }
    
    // Load banks when page loads - with a longer delay to ensure DOM is ready
    setTimeout(() => {
        loadBanksFromPaynet();
    }, 500);
    
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

    // FPX Payment Form Handler
    const fpxForm = document.getElementById('fpx-payment-form');
    if (fpxForm) {
        console.log('Setting up FPX form submit handler');
        
        fpxForm.addEventListener('submit', async function(e) {
            console.log('FPX form submit intercepted');
            e.preventDefault();
            
            // Debug: Check if form is valid
            console.log('Form validation check...');
            if (!fpxForm.checkValidity()) {
                console.log('Form validation failed');
                fpxForm.reportValidity();
                return;
            }
            console.log('Form validation passed');
            
            const submitBtn = fpxForm.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Processing...';
            }
            
            try {
                console.log('Making FPX payment request...');
                const formData = new FormData(fpxForm);
                
                // Debug: Check required fields
                const requiredFields = ['donation_id', 'amount', 'fpx_buyer_name', 'fpx_buyer_email', 'fpx_bank', 'campaign_id', 'accept_terms'];
                console.log('Checking required fields...');
                for (const field of requiredFields) {
                    const value = formData.get(field);
                    console.log(`  ${field}: ${value} (${value ? 'present' : 'missing'})`);
                }
                
                // Log form data for debugging
                console.log('Form data:');
                for (let [key, value] of formData.entries()) {
                    console.log(`  ${key}: ${value}`);
                }
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                console.log('CSRF Token:', csrfToken);
                
                const response = await fetch('/payment/api/fpx/payment', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(formData)
                });
                
                console.log('FPX payment response received');
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const result = await response.json();
                console.log('FPX payment result:', result);
                
                if (result.success && result.payment_url) {
                    console.log('FPX payment created successfully, redirecting to:', result.payment_url);
                    
                    // Redirect to Paynet payment page
                    window.location.href = result.payment_url;
                } else {
                    console.error('FPX payment failed:', result.message);
                    alert('FPX payment failed: ' + (result.message || 'Unknown error'));
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Proceed to FPX Payment';
                    }
                }
            } catch (error) {
                console.error('FPX payment network error:', error);
                console.error('Error details:', {
                    message: error.message,
                    stack: error.stack
                });
                alert('Network error occurred. Please try again. Error: ' + error.message);
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Proceed to FPX Payment';
                }
            }
        });
    }
});
</script>
@endpush 