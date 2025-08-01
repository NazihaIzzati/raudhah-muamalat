@extends('layouts.master')

@section('title', __('app.payment_successful') . ' - Jariah Fund')
@section('description', __('app.donation_processed'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        <!-- Page Header -->
        <h1 class="text-2xl font-bold text-gray-900 mb-6 text-center">{{ __('app.payment_successful') }}</h1>
        <p class="text-sm text-gray-600 text-center mb-8">{{ __('app.donation_processed') }}</p>
        
        <div class="space-y-6">
            <!-- Success Status -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <div class="text-center mb-4">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-500 rounded-full mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('app.payment_successful') }}!</h3>
                    <p class="text-sm text-gray-600">{{ __('app.donation_processed') }}</p>
                </div>
            </div>

            <!-- Transaction Details -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.transaction_details') }}</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Amount:</span>
                        <span class="font-semibold text-orange-600">RM {{ number_format($transaction->amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Transaction ID:</span>
                        <span class="font-mono text-sm text-gray-900">{{ $transaction->transaction_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Date & Time:</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->created_at->format('d M Y, h:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Payment Method:</span>
                        <span class="font-semibold text-gray-900">FPX Online Banking</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="text-green-600 font-medium">Completed</span>
                    </div>
                </div>
            </div>

            <!-- Bank Details -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.bank_details') }}</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">FPX Transaction ID:</span>
                        <span class="font-mono text-sm text-gray-900">{{ $transaction->paynet_response_data['fpx_fpxTxnId'] ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Bank Name:</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->paynet_response_data['fpx_buyerBankId'] ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Buyer Name:</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->paynet_response_data['fpx_buyerName'] ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Donation Details -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.donation_details') }}</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Campaign:</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->donation->campaign->title ?? 'General Donation' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Donor Name:</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->donation->donor_name ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Donor Email:</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->donation->donor_email ?? 'N/A' }}</span>
                    </div>
                    @if(!empty($transaction->donation->message))
                    <div class="flex justify-between">
                        <span class="text-gray-600">Message:</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->donation->message }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- What Happens Next -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('app.what_happens_next') }}</h3>
                <div class="space-y-3 text-sm text-gray-700">
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">1</span>
                        </div>
                        <span>{{ __('app.receipt_email_sent') }}</span>
                    </div>
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">2</span>
                        </div>
                        <span>{{ __('app.donation_will_help') }}</span>
                    </div>
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                            <span class="text-orange-600 font-semibold text-xs">3</span>
                        </div>
                        <span>{{ __('app.track_donation_dashboard') }}</span>
                    </div>
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
    // Print functionality
    function printReceipt() {
        window.print();
    }
    
    // Auto-print after 3 seconds (optional)
    setTimeout(function() {
        // Uncomment the line below to enable auto-print
        // printReceipt();
    }, 3000);
</script>
@endsection 