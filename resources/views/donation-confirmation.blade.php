@extends('layouts.master')

@section('title', __('app.donation_confirmation') . ' - Jariah Fund')
@section('description', __('app.review_your_donation'))

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-8 animate-fade-in">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('app.donation_confirmation') }}</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">{{ __('app.review_your_donation') }}</p>
        </div>

        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Campaign Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ __('app.campaign_details') }}</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('assets/images/campaigns/' . ($confirmationData['campaign']->image ?? '01.jpg')) }}" 
                             alt="{{ $confirmationData['campaign']->title }}" 
                             class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $confirmationData['campaign']->title }}</h3>
                            <p class="text-gray-600 mb-3">{{ $confirmationData['campaign']->description }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="mr-4">📅 {{ $confirmationData['campaign']->days_left ?? 30 }} days left</span>
                                <span>👥 {{ $confirmationData['campaign']->donor_count ?? 234 }} donors</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donation Details -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">{{ __('app.donation_details') }}</h2>
                            <p class="text-sm text-gray-600">Review your donation information before proceeding</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <!-- Campaign Information -->
                    <div class="mb-8">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('app.campaign_information') }}</h3>
                        </div>
                        
                        <!-- Campaign Card -->
                        <div class="bg-gradient-to-r from-primary-50 to-blue-50 rounded-xl p-6 mb-6 border border-primary-100">
                            <div class="flex items-start space-x-4">
                                <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $confirmationData['campaign']->title }}</h4>
                                    <p class="text-gray-600 text-sm mb-3">{{ $confirmationData['campaign']->description ?? 'Supporting a meaningful cause' }}</p>
                                    <div class="flex items-center space-x-4 text-sm">
                                        @if($confirmationData['is_anonymous'])
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Anonymous
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Donation Details Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Amount -->
                            <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">{{ __('app.donation_amount') }}</p>
                                        <p class="text-xl font-bold text-gray-900">RM {{ number_format($confirmationData['amount'], 2) }}</p>
                                    </div>
                                </div>
                            </div>



                            <!-- Payment Method -->
                            <div class="bg-white rounded-lg border border-gray-200 p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">{{ __('app.payment_method') }}</p>
                                        <p class="text-lg font-semibold text-gray-900" id="selected-payment-method">{{ __('app.select_payment_method') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donor Information -->
                    <div class="border-t border-gray-100 pt-8">
                        <div class="flex items-center space-x-2 mb-6">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('app.donor_information') }}</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Donor Name -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">{{ __('app.donor_name') }}</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $confirmationData['donor_name'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Donor Email -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">{{ __('app.donor_email') }}</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $confirmationData['donor_email'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Donor Phone -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">{{ __('app.donor_phone') }}</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $confirmationData['donor_phone'] ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Donation Message -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-700">{{ __('app.donation_message') }}</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $confirmationData['message'] ?? 'No message provided' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Information -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('app.secure_encrypted_payment') }}</h3>
                            <p class="text-sm text-gray-600">Your payment information is encrypted and secure</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            SSL Encrypted
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            PCI Compliant
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Bank-Level Security
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amount Summary -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ __('app.donation_summary') }}</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">{{ __('app.donation_amount') }}</span>
                            <span class="font-semibold text-gray-900">RM {{ number_format($confirmationData['amount'], 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Processing Fee</span>
                            <span class="font-semibold text-gray-900">RM 0.00</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900">Total</span>
                                <span class="text-2xl font-bold text-primary-600">RM {{ number_format($confirmationData['amount'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <!-- Form Header -->
                <div class="px-8 py-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ __('app.secure_payment') }}</h2>
                    <p class="text-gray-600">{{ __('app.choose_payment_method') }}</p>
                </div>

                <!-- Professional Payment Form -->
                <div class="px-8 py-8">
                    <form action="{{ route('donate.process') }}" method="POST" id="donation-form">
                        @csrf
                        <input type="hidden" name="campaign_id" value="{{ $confirmationData['campaign']->id }}">
                        <input type="hidden" name="amount" value="{{ $confirmationData['amount'] }}">
                        <input type="hidden" name="donor_name" value="{{ $confirmationData['donor_name'] }}">
                        <input type="hidden" name="donor_email" value="{{ $confirmationData['donor_email'] }}">
                        <input type="hidden" name="donor_phone" value="{{ $confirmationData['donor_phone'] }}">
                        <input type="hidden" name="message" value="{{ $confirmationData['message'] }}">
                        <input type="hidden" name="is_anonymous" value="{{ $confirmationData['is_anonymous'] ? '1' : '0' }}">
                        <input type="hidden" name="payment_method" id="payment-method-input" value="">

                        <!-- Payment Method Selection -->
                        <div class="mb-8">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Credit/Debit Card Option -->
                                <label class="cursor-pointer payment-option group relative block">
                                    <input type="radio" name="payment_method_radio" value="card" id="payment_card" class="absolute opacity-0 w-full h-full left-0 top-0 z-10 cursor-pointer" required>
                                    <div class="payment-card relative p-4 border-2 border-gray-200 rounded-lg transition-all duration-200 hover:border-blue-500 hover:shadow-md bg-white group-focus-within:border-blue-600">
                                        <div class="flex items-center space-x-3">
                                            <i class="bx bx-credit-card text-blue-600 text-2xl"></i>
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ __('app.credit_debit_card') }}</h4>
                                                <p class="text-sm text-gray-600">Visa, Mastercard, Amex</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <!-- FPX Online Banking Option -->
                                <label class="cursor-pointer payment-option group relative block">
                                    <input type="radio" name="payment_method_radio" value="obw" id="payment_obw" class="absolute opacity-0 w-full h-full left-0 top-0 z-10 cursor-pointer">
                                    <div class="payment-card relative p-4 border-2 border-gray-200 rounded-lg transition-all duration-200 hover:border-green-500 hover:shadow-md bg-white group-focus-within:border-green-600">
                                        <div class="flex items-center space-x-3">
                                            <i class="bx bx-bank text-green-600 text-2xl"></i>
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ __('app.fpx_online_banking') }}</h4>
                                                <p class="text-sm text-gray-600">Direct bank transfer</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <!-- QR Payment Option -->
                                <label class="cursor-pointer payment-option group relative block">
                                    <input type="radio" name="payment_method_radio" value="qr" id="payment_qr" class="absolute opacity-0 w-full h-full left-0 top-0 z-10 cursor-pointer">
                                    <div class="payment-card relative p-4 border-2 border-gray-200 rounded-lg transition-all duration-200 hover:border-purple-500 hover:shadow-md bg-white group-focus-within:border-purple-600">
                                        <div class="flex items-center space-x-3">
                                            <i class="bx bx-qr text-purple-600 text-2xl"></i>
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ __('app.duitnow_qr') }}</h4>
                                                <p class="text-sm text-gray-600">Scan to pay</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Continue Button -->
                        <div class="mt-8">
                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 px-6 rounded-lg text-base font-semibold transition-all duration-300 flex items-center justify-center">
                                Continue to Payment
                            </button>
                        </div>

                        <!-- Payment Status Messages -->
                        <div id="paymentMessage" class="hidden mt-4 p-4 rounded-lg text-center font-medium"></div>

                        <!-- 3DS Authentication Iframe -->
                        <div id="cardzoneIframeContainer" class="hidden mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('app.secure_authentication') }}</h3>
                            <p class="text-gray-600 mb-4">{{ __('app.complete_authentication_notice') }}</p>
                            <iframe name="cardzone_iframe" id="cardzoneIframe" class="w-full h-96 border border-gray-300 rounded-lg"></iframe>
                            <button id="cancelPaymentBtn" onclick="cancelPayment()" class="w-full bg-red-600 text-white py-3 px-6 rounded-lg font-semibold mt-4 hover:bg-red-700 transition-colors">
                                {{ __('app.cancel_payment') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Trust Indicators -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-shadow duration-300 ease-in-out">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Why Choose Jariah Fund?</h3>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">100% Shariah Compliant</p>
                                <p class="text-xs text-gray-600">All transactions follow Islamic principles</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">No Admin Fees</p>
                                <p class="text-xs text-gray-600">100% of your donation goes to the cause</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Full Transparency</p>
                                <p class="text-xs text-gray-600">Track how your donation is used</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Set payment method in hidden input when selected
window.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input[name="payment_method_radio"]').forEach(input => {
        input.addEventListener('change', function() {
            document.getElementById('payment-method-input').value = this.value;
        });
    });
});
</script>
@endpush 