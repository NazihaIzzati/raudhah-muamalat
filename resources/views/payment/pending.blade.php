@extends('layouts.master')

@section('title', __('app.payment_pending') . ' - Jariah Fund')
@section('description', __('app.donation_processing'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        <!-- Page Header -->
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">{{ __('app.payment_pending') }}</h1>
        <p class="text-sm text-gray-600 text-center mb-8">{{ __('app.donation_processing') }}</p>
        
        <div class="space-y-6">
            <!-- Pending Status -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <div class="text-center mb-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-500 rounded-full mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('app.donation_processing') }}</h3>
                    <p class="text-sm text-gray-600">{{ __('app.please_wait_processing') }}</p>
                </div>
                
                <!-- Progress Indicator -->
                <div class="mb-6">
                    <div class="flex items-center justify-center space-x-4 mb-4">
                        <div class="w-4 h-4 bg-yellow-500 rounded-full animate-pulse"></div>
                        <div class="flex-1 h-2 bg-gray-200 rounded-full">
                            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 h-2 rounded-full animate-pulse" style="width: 60%"></div>
                        </div>
                        <div class="w-4 h-4 bg-orange-500 rounded-full animate-pulse" style="animation-delay: 0.5s"></div>
                        <div class="flex-1 h-2 bg-gray-200 rounded-full">
                            <div class="bg-gradient-to-r from-orange-400 to-amber-500 h-2 rounded-full animate-pulse" style="width: 30%"></div>
                        </div>
                        <div class="w-4 h-4 bg-amber-500 rounded-full animate-pulse" style="animation-delay: 1s"></div>
                    </div>
                    <p class="text-center text-gray-600 text-sm" id="progress-message">{{ __('app.processing_payment_bank') }}</p>
                </div>
            </div>

            <!-- Donation Details -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.donation_details') }}</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ __('app.donation_id') }}:</span>
                        <span class="font-mono text-sm text-gray-900">{{ $donation->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ __('app.amount') }}:</span>
                        <span class="font-semibold text-orange-600">{{ $donation->currency }} {{ number_format($donation->amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ __('app.date') }}:</span>
                        <span class="font-semibold text-gray-900">{{ $donation->created_at->format('d M Y, h:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ __('app.payment_method') }}:</span>
                        <span class="font-semibold text-gray-900">{{ ucfirst($donation->payment_method) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ __('app.status') }}:</span>
                        <span class="text-yellow-600 font-medium">{{ ucfirst($donation->payment_status) }}</span>
                    </div>
                </div>
            </div>

            <!-- Campaign Information -->
            @if($donation->campaign)
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.campaign_information') }}</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Campaign:</span>
                        <span class="font-semibold text-gray-900">{{ $donation->campaign->title }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Donor Name:</span>
                        <span class="font-semibold text-gray-900">{{ $donation->donor_name ?? 'Anonymous' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Donor Email:</span>
                        <span class="font-semibold text-gray-900">{{ $donation->donor_email ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Processing Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.processing_information') }}</h3>
                <div class="space-y-3 text-sm text-gray-700">
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">1</span>
                        </div>
                        <span>Payment request received and validated</span>
                    </div>
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">2</span>
                        </div>
                        <span>Processing with your bank's payment system</span>
                    </div>
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">3</span>
                        </div>
                        <span>Awaiting bank confirmation...</span>
                    </div>
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">4</span>
                        </div>
                        <span>You will be redirected once processing is complete</span>
                    </div>
                </div>
            </div>

            <!-- Environment Notice -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    <span class="text-sm text-yellow-800">UAT Testing Environment - This is a test transaction</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    {{ __('app.return_to_home') }}
                </a>
                
                <a href="{{ route('campaigns.index') }}" class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    {{ __('app.explore_more_campaigns') }}
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Progress updates
    let currentStep = 1;
    const progressMessages = [
        '{{ __("app.processing_payment_bank") }}',
        '{{ __("app.validating_transaction_details") }}',
        '{{ __("app.awaiting_bank_confirmation") }}',
        '{{ __("app.finalizing_payment") }}'
    ];
    
    function updateProgress() {
        const messageElement = document.getElementById('progress-message');
        if (messageElement && currentStep <= progressMessages.length) {
            messageElement.textContent = progressMessages[currentStep - 1];
        }
    }
    
    // Auto-update progress
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Payment pending page loaded');
        
        // Update progress every 2 seconds
        setTimeout(() => {
            currentStep = 2;
            updateProgress();
        }, 2000);
        
        setTimeout(() => {
            currentStep = 3;
            updateProgress();
        }, 4000);
        
        setTimeout(() => {
            currentStep = 4;
            updateProgress();
        }, 6000);
    });
</script>
@endsection 