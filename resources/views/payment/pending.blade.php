@extends('layouts.master')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <!-- Pending Header -->
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 p-6 sm:p-10">
                    <div class="flex flex-col items-center">
                        <div class="rounded-full bg-white p-3 mb-4">
                            <svg class="h-12 w-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h1 class="text-white text-3xl font-bold text-center">{{ __('app.payment_pending') }}</h1>
                        <p class="text-yellow-100 mt-2 text-center">{{ __('app.donation_processing') }}</p>
                    </div>
                </div>
                
                <!-- Donation Details -->
                <div class="p-6 sm:p-10">
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('app.donation_details') }}</h2>
                        
                        <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-600">{{ __('app.donation_id') }}</span>
                                <span class="font-medium text-gray-900">{{ $donation->id }}</span>
                            </div>
                            
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-600">{{ __('app.amount') }}</span>
                                <span class="font-medium text-gray-900">{{ $donation->currency }} {{ number_format($donation->amount, 2) }}</span>
                            </div>
                            
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-600">{{ __('app.date') }}</span>
                                <span class="font-medium text-gray-900">{{ $donation->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-600">{{ __('app.payment_method') }}</span>
                                <span class="font-medium text-gray-900">{{ ucfirst($donation->payment_method) }}</span>
                            </div>
                            
                            <div class="flex justify-between border-b border-gray-200 pb-3">
                                <span class="text-gray-600">{{ __('app.status') }}</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($donation->payment_status) }}
                                </span>
                            </div>
                            
                            @if($donation->campaign)
                            <div class="flex justify-between pb-3">
                                <span class="text-gray-600">{{ __('app.campaign') }}</span>
                                <span class="font-medium text-gray-900">{{ $donation->campaign->title }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('app.what_happens_next') }}</h2>
                        <div class="prose prose-yellow max-w-none">
                            <ul class="space-y-2">
                                <li>{{ __('app.payment_being_processed') }}</li>
                                <li>{{ __('app.email_confirmation_when_complete') }}</li>
                                <li>{{ __('app.check_status_later') }}</li>
                                <li>{{ __('app.contact_support_if_long') }}</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('home') }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                            {{ __('app.return_to_home') }}
                        </a>
                        
                        @if($donation->campaign)
                        <a href="{{ route('campaigns') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                            {{ __('app.explore_more_campaigns') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 