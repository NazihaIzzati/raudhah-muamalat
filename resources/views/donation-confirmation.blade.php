@extends('layouts.master')

@section('title', __('app.donation_confirmation') . ' - Jariah Fund')
@section('description', __('app.review_your_donation'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        <!-- Page Header -->
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">{{ __('app.donation_confirmation') }}</h1>
        <p class="text-sm text-gray-600 text-center mb-8">{{ __('app.review_your_donation') }}</p>

        <div class="space-y-6">
            <!-- Campaign Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Campaign Details</h3>
                <div class="flex items-start space-x-4">
                    <img src="{{ asset('assets/images/campaigns/' . ($confirmationData['campaign']->image ?? '01.jpg')) }}" 
                         alt="{{ $confirmationData['campaign']->title }}" 
                         class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $confirmationData['campaign']->title }}</h4>
                        <p class="text-sm text-gray-600 mb-3">{{ $confirmationData['campaign']->description }}</p>
                        <div class="flex items-center text-xs text-gray-500 space-x-4">
                            <span>📅 {{ $confirmationData['campaign']->days_left ?? 30 }} days left</span>
                            <span>👥 {{ $confirmationData['campaign']->donor_count ?? 234 }} donors</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donation Details -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Donation Details</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Amount:</span>
                        <span class="font-semibold text-orange-600">RM {{ number_format($confirmationData['amount'], 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Donor Name:</span>
                        <span class="font-semibold text-gray-900">
                            @if($confirmationData['is_anonymous'])
                                Anonymous
                            @else
                                {{ $confirmationData['donor_name'] ?? 'N/A' }}
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email:</span>
                        <span class="font-semibold text-gray-900">{{ $confirmationData['donor_email'] ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Phone:</span>
                        <span class="font-semibold text-gray-900">{{ $confirmationData['donor_phone'] ?? 'N/A' }}</span>
                    </div>
                    @if(!empty($confirmationData['message']))
                    <div class="flex justify-between">
                        <span class="text-gray-600">Message:</span>
                        <span class="font-semibold text-gray-900">{{ $confirmationData['message'] }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-600">Anonymous:</span>
                        <span class="font-semibold text-gray-900">{{ $confirmationData['is_anonymous'] ? 'Yes' : 'No' }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <form method="POST" action="{{ route('donate.process') }}" class="space-y-3" id="payment-form">
                    @csrf
                    <input type="hidden" name="campaign_id" value="{{ $confirmationData['campaign']->id ?? '' }}">
                    <input type="hidden" name="donor_name" value="{{ $confirmationData['donor_name'] ?? '' }}">
                    <input type="hidden" name="donor_email" value="{{ $confirmationData['donor_email'] ?? '' }}">
                    <input type="hidden" name="donor_phone" value="{{ $confirmationData['donor_phone'] ?? '' }}">
                    <input type="hidden" name="message" value="{{ $confirmationData['message'] ?? '' }}">
                    @if($confirmationData['is_anonymous'] ?? false)
                        <input type="hidden" name="is_anonymous" value="1">
                    @endif
                    <input type="hidden" name="amount" value="{{ $confirmationData['amount'] ?? '' }}">
                    
                    <!-- Payment Method Selection -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Select Payment Method</h3>
                        <div class="space-y-4">
                            <!-- Credit/Debit Card -->
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-orange-300 hover:bg-orange-50 transition-all">
                                <input type="radio" name="payment_method" value="card" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300" checked>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        <span class="font-semibold text-gray-900">Credit/Debit Card</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Secure payment with 3D Secure authentication</p>
                                </div>
                            </label>

                            <!-- FPX Online Banking -->
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-orange-300 hover:bg-orange-50 transition-all">
                                <input type="radio" name="payment_method" value="fpx" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        <span class="font-semibold text-gray-900">FPX Online Banking</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Pay through your online banking account</p>
                                </div>
                            </label>

                            <!-- OBW (Online Banking) -->
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-orange-300 hover:bg-orange-50 transition-all">
                                <input type="radio" name="payment_method" value="obw" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        <span class="font-semibold text-gray-900">Online Banking (OBW)</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Direct bank transfer through online banking</p>
                                </div>
                            </label>

                            <!-- QR Payment -->
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-orange-300 hover:bg-orange-50 transition-all">
                                <input type="radio" name="payment_method" value="qr" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300">
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                                        </svg>
                                        <span class="font-semibold text-gray-900">QR Payment</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Scan QR code to complete payment</p>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" id="proceed-button" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Proceed to Payment
                    </button>
                </form>
                
                <a href="{{ route('campaigns.index') }}" 
                   class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Campaigns
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const proceedButton = document.getElementById('proceed-button');

    function updatePaymentMethod() {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
        
        if (selectedMethod) {
            const method = selectedMethod.value;
            
            // Update button text based on method
            if (method === 'fpx') {
                proceedButton.textContent = 'Proceed to FPX Payment';
            } else if (method === 'obw') {
                proceedButton.textContent = 'Proceed to Online Banking';
            } else {
                proceedButton.textContent = 'Proceed to Payment';
            }
            
            proceedButton.disabled = false;
        } else {
            proceedButton.textContent = 'Select Payment Method';
            proceedButton.disabled = true;
        }
    }

    // Listen for payment method changes
    paymentMethods.forEach(method => {
        method.addEventListener('change', updatePaymentMethod);
    });

    // Initialize
    updatePaymentMethod();
});
</script>
@endsection 