@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Main Card -->
            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100">
                <!-- Success Header -->
                <div class="bg-gradient-to-r from-green-400 via-emerald-500 to-teal-500 p-8 sm:p-12">
                    <div class="flex flex-col items-center">
                        <div class="relative mb-6">
                            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                                <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <!-- Success animation rings -->
                            <div class="absolute inset-0 w-24 h-24 border-4 border-green-200 rounded-full animate-ping"></div>
                            <div class="absolute inset-0 w-24 h-24 border-2 border-green-300 rounded-full animate-pulse"></div>
                        </div>
                        <h1 class="text-white text-4xl font-bold text-center mb-3">Payment Successful!</h1>
                        <p class="text-green-100 text-xl text-center mb-2">Your donation has been processed successfully</p>
                        <p class="text-green-200 text-sm text-center">Thank you for your generous contribution</p>
                    </div>
                </div>
                
                <!-- Content Section -->
                <div class="p-8 sm:p-12">
                    <!-- Success Animation -->
                    <div class="flex justify-center mb-8">
                        <div class="relative">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center animate-pulse">
                                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="absolute inset-0 w-16 h-16 border-4 border-green-200 rounded-full animate-ping"></div>
                        </div>
                    </div>
                    
                    <!-- Transaction Summary -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Transaction Summary
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    Payment Information
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-blue-100">
                                        <span class="text-gray-600 font-medium">Amount:</span>
                                        <span class="text-2xl font-bold text-green-600">RM {{ number_format($transaction->amount ?? 0, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-blue-100">
                                        <span class="text-gray-600 font-medium">Transaction ID:</span>
                                        <span class="font-mono text-sm bg-white px-3 py-1 rounded-lg border">{{ $transaction->transaction_id ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-blue-100">
                                        <span class="text-gray-600 font-medium">Date & Time:</span>
                                        <span class="text-gray-900">{{ $transaction->created_at->format('d M Y, h:i A') ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600 font-medium">Payment Method:</span>
                                        <span class="font-medium text-blue-600">FPX Online Banking</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Status Information
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center py-2 border-b border-green-100">
                                        <span class="text-gray-600 font-medium">Status:</span>
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 border border-green-200">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Successful
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-green-100">
                                        <span class="text-gray-600 font-medium">FPX Transaction ID:</span>
                                        <span class="font-mono text-sm bg-white px-3 py-1 rounded-lg border">
                                            {{ $transaction->paynet_response_data['fpx_fpxTxnId'] ?? 'N/A' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600 font-medium">Environment:</span>
                                        <span class="font-medium text-green-600">UAT Testing</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- What's Next -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            What happens next?
                        </h2>
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-semibold text-gray-900">Email Confirmation</h4>
                                            <p class="text-sm text-gray-600 mt-1">You'll receive a confirmation email shortly</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-semibold text-gray-900">Receipt Available</h4>
                                            <p class="text-sm text-gray-600 mt-1">Your receipt is ready for download</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-semibold text-gray-900">Campaign Impact</h4>
                                            <p class="text-sm text-gray-600 mt-1">Your donation will make a difference</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-semibold text-gray-900">Stay Updated</h4>
                                            <p class="text-sm text-gray-600 mt-1">Follow our progress and impact</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-semibold rounded-xl text-white bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Back to Dashboard
                        </a>
                        
                        <a href="{{ route('donations.index') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 border border-gray-300 text-lg font-semibold rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            View All Donations
                        </a>
                        
                        <button onclick="window.print()" 
                                class="inline-flex items-center justify-center px-8 py-4 border border-gray-300 text-lg font-semibold rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Print Receipt
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Environment Notice -->
            <div class="text-center mt-8">
                <div class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    UAT Testing Environment - This is a test transaction
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.animate-ping {
    animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
}
@keyframes ping {
    75%, 100% {
        transform: scale(2);
        opacity: 0;
    }
}
</style>
@endsection 