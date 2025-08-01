@extends('layouts.master')

@section('title', __('app.secure_payment') . ' - Jariah Fund')
@section('description', __('app.processing_your_payment'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        <!-- Page Header -->
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">{{ __('app.secure_payment') }}</h1>
        <p class="text-sm text-gray-600 text-center mb-8">{{ __('app.processing_your_payment') }}</p>
        
        <div class="space-y-6">
            <!-- Payment Status -->
            <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                <div class="text-center mb-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-500 rounded-full mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Processing Your Payment</h3>
                    <p class="text-sm text-gray-600">Redirecting to your bank for secure authentication</p>
                </div>
                
                <!-- Progress Indicator -->
                <div class="mb-6">
                    <div class="flex items-center justify-center space-x-4 mb-4">
                        <div class="w-4 h-4 bg-orange-500 rounded-full animate-pulse"></div>
                        <div class="flex-1 h-2 bg-gray-200 rounded-full">
                            <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-2 rounded-full animate-pulse" style="width: 30%"></div>
                        </div>
                        <div class="w-4 h-4 bg-gray-300 rounded-full"></div>
                        <div class="flex-1 h-2 bg-gray-200 rounded-full">
                            <div class="bg-gray-300 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                        <div class="w-4 h-4 bg-gray-300 rounded-full"></div>
                    </div>
                    <p class="text-center text-gray-600 text-sm" id="progress-message">{{ __('app.establishing_secure_connection') }}</p>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.payment_summary') }}</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Amount:</span>
                        <span class="font-semibold text-orange-600">RM {{ number_format($transaction->amount ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Payment Method:</span>
                        <span class="font-semibold text-gray-900">FPX Online Banking</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Transaction ID:</span>
                        <span class="font-mono text-sm text-gray-900">{{ $transaction->transaction_id ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Donor:</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->donation->donor_name ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Campaign:</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->donation->campaign->title ?? 'General Donation' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="text-orange-600 font-medium">Processing</span>
                    </div>
                </div>
            </div>

            <!-- Security Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.security_privacy') }}</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">256-bit SSL Encryption</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Bank-Level Security</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">PCI DSS Compliant</span>
                    </div>
                </div>
            </div>

            <!-- Payment Process -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.payment_process') }}</h3>
                <div class="space-y-3 text-sm text-gray-700">
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">1</span>
                        </div>
                        <span>You'll be redirected to your bank's secure login page</span>
                    </div>
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">2</span>
                        </div>
                        <span>Log in with your online banking credentials</span>
                    </div>
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">3</span>
                        </div>
                        <span>Review and confirm the payment details</span>
                    </div>
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">4</span>
                        </div>
                        <span>You'll be automatically redirected back with confirmation</span>
                    </div>
                </div>
            </div>

            <!-- Environment Notice -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    <span class="text-sm text-yellow-800">UAT Testing Environment</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <!-- Auto-submit form -->
                <form id="fpxForm" method="POST" action="{{ $fpxUrl ?? '#' }}" style="display: none;">
                    @if(isset($fpxData) && is_array($fpxData))
                        @foreach($fpxData as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    @endif
                </form>
                
                <!-- Manual redirect button -->
                <button id="manualRedirect" onclick="submitForm()" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    Continue to Payment
                </button>
                <p class="text-xs text-gray-500 text-center">Click if you're not redirected automatically</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Progress updates
    let currentStep = 1;
    const steps = document.querySelectorAll('.w-4.h-4');
    const progressMessages = [
        '{{ __("app.establishing_secure_connection") }}',
        '{{ __("app.preparing_payment_gateway") }}',
        '{{ __("app.redirecting_to_bank") }}'
    ];
    
    function updateProgress() {
        const messageElement = document.getElementById('progress-message');
        if (messageElement && currentStep <= progressMessages.length) {
            messageElement.textContent = progressMessages[currentStep - 1];
        }
        
        // Update step indicators
        steps.forEach((step, index) => {
            if (index < currentStep) {
                step.classList.add('bg-orange-500');
                step.classList.remove('bg-gray-300');
            } else if (index === currentStep) {
                step.classList.add('bg-orange-500');
                step.classList.remove('bg-gray-300');
            }
        });
    }
    
    // Auto-submit form after page load
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Secure payment gateway loaded');
        
        // Update progress
        setTimeout(() => {
            currentStep = 2;
            updateProgress();
        }, 1500);
        
        setTimeout(() => {
            currentStep = 3;
            updateProgress();
        }, 3000);
        
        // Submit form after showing progress
        setTimeout(function() {
            console.log('Submitting secure payment form...');
            submitForm();
        }, 5000);
    });
    
    function submitForm() {
        const form = document.getElementById('fpxForm');
        if (form) {
            console.log('Submitting secure payment form...');
            const progressMessage = document.getElementById('progress-message');
            if (progressMessage) {
                progressMessage.textContent = '{{ __("app.redirecting_now") }}';
            }
            form.submit();
        }
    }
    
    // Security: Disable right-click and F12
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) {
            e.preventDefault();
        }
    });
</script>
@endsection