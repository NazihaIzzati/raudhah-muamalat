@extends('layouts.admin')

@section('title', 'Edit Donation - Admin Dashboard')
@section('page-title', 'Edit Donation')

@section('content')
<div class="space-y-6">
    <!-- Main Content -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <form action="{{ route('admin.donations.update', $donation) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Enhanced Header Section -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-[#fe5000]">Edit Donation</h3>
                            <p class="text-sm text-[#fe5000] mt-1">Update donation information and settings</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                        @if(Route::has('admin.donations.show'))
                            <a href="{{ route('admin.donations.show', $donation) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View Donation
                            </a>
                        @endif
                        <a href="{{ route('admin.donations.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Donation Info Banner -->
            <div class="mx-6 mt-6 bg-gradient-to-r from-[#fe5000]/5 to-orange-50 rounded-xl p-6 flex items-center border border-[#fe5000]/20">
                <div class="flex-shrink-0 mr-6">
                    <div class="h-20 w-20 rounded-xl overflow-hidden bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center border-2 border-[#fe5000]/30 shadow-sm">
                        <svg class="h-10 w-10 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900">{{ $donation->donor_name ?? 'Anonymous Donor' }}</h2>
                    <p class="text-sm text-gray-600 flex items-center mt-1">
                        <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Donated {{ $donation->created_at->format('M d, Y') }}
                    </p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                            @if($donation->payment_status === 'completed') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                            @elseif($donation->payment_status === 'pending') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-200
                            @elseif($donation->payment_status === 'failed') bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-200
                            @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200
                            @endif">
                            <span class="h-2 w-2 rounded-full mr-1
                                @if($donation->payment_status === 'completed') bg-green-400
                                @elseif($donation->payment_status === 'pending') bg-yellow-400
                                @elseif($donation->payment_status === 'failed') bg-red-400
                                @else bg-gray-400
                                @endif"></span>
                            {{ ucfirst($donation->payment_status ?? 'Unknown') }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm bg-gradient-to-r from-[#fe5000]/10 to-orange-100 text-[#fe5000] border border-[#fe5000]/20">
                            {{ number_format($donation->amount, 2) }} {{ $donation->currency }}
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mx-6 mt-6 rounded-xl bg-red-50 p-6 border border-red-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-lg bg-red-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-semibold text-red-800">Please fix the following errors:</h3>
                            <div class="mt-3 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="p-6 space-y-8">
                <!-- Donor Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-[#fe5000]/10 to-orange-50 p-4 rounded-xl border border-[#fe5000]/20">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-[#fe5000] rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-[#fe5000]">Donor Information</h4>
                            <p class="text-sm text-[#fe5000]/70">Update the donor's personal details</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Donor Name -->
                        <div class="group">
                            <label for="donor_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Donor Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="donor_name" id="donor_name" value="{{ old('donor_name', $donation->donor_name) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter donor name..." required>
                            </div>
                        </div>
                        
                        <!-- Donor Email -->
                        <div class="group">
                            <label for="donor_email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Donor Email <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input type="email" name="donor_email" id="donor_email" value="{{ old('donor_email', $donation->donor_email) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter donor email...">
                            </div>
                        </div>
                        
                        <!-- Donor Phone -->
                        <div class="group">
                            <label for="donor_phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                Donor Phone <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="donor_phone" id="donor_phone" value="{{ old('donor_phone', $donation->donor_phone) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter donor phone...">
                            </div>
                        </div>
                        
                        <!-- Anonymous Donation -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Privacy Settings
                            </label>
                            <div class="flex items-center">
                                <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" {{ old('is_anonymous', $donation->is_anonymous) ? 'checked' : '' }}
                                    class="h-4 w-4 text-[#fe5000] focus:ring-[#fe5000] border-gray-300 rounded">
                                <label for="is_anonymous" class="ml-2 block text-sm text-gray-700">
                                    Anonymous donation (hide donor name publicly)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Donation Details Section -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-blue-900">Donation Details</h4>
                            <p class="text-sm text-blue-700">Update donation amount and campaign information</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Campaign -->
                        <div class="group">
                            <label for="campaign_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Campaign <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="campaign_id" name="campaign_id" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    @if(isset($campaigns))
                                        @foreach($campaigns as $campaignId => $campaignTitle)
                                            <option value="{{ $campaignId }}" {{ old('campaign_id', $donation->campaign_id) == $campaignId ? 'selected' : '' }}>
                                                {{ $campaignTitle }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Amount -->
                        <div class="group">
                            <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                                Donation Amount <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <input type="number" name="amount" id="amount" value="{{ old('amount', $donation->amount) }}" min="1" step="0.01" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="0.00" required>
                            </div>
                        </div>
                        
                        <!-- Currency -->
                        <div class="group">
                            <label for="currency" class="block text-sm font-semibold text-gray-700 mb-2">
                                Currency <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="currency" name="currency" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="MYR" {{ old('currency', $donation->currency) == 'MYR' ? 'selected' : '' }}>MYR - Malaysian Ringgit</option>
                                    <option value="USD" {{ old('currency', $donation->currency) == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                    <option value="SGD" {{ old('currency', $donation->currency) == 'SGD' ? 'selected' : '' }}>SGD - Singapore Dollar</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Status -->
                        <div class="group">
                            <label for="payment_status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Payment Status <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="payment_status" name="payment_status" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    @if(isset($statuses))
                                        @foreach($statuses as $value => $label)
                                            <option value="{{ $value }}" {{ old('payment_status', $donation->payment_status) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    @else
                                        <option value="completed" {{ old('payment_status', $donation->payment_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="pending" {{ old('payment_status', $donation->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="failed" {{ old('payment_status', $donation->payment_status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                        <option value="refunded" {{ old('payment_status', $donation->payment_status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    @endif
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Method -->
                        <div class="group">
                            <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-2">
                                Payment Method <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="payment_method" name="payment_method" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" required>
                                    @if(isset($paymentMethods))
                                        @foreach($paymentMethods as $value => $label)
                                            <option value="{{ $value }}" {{ old('payment_method', $donation->payment_method) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Select payment method</option>
                                        <option value="credit_card" {{ old('payment_method', $donation->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                        <option value="bank_transfer" {{ old('payment_method', $donation->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        <option value="paypal" {{ old('payment_method', $donation->payment_method) == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                        <option value="cash" {{ old('payment_method', $donation->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="other" {{ old('payment_method', $donation->payment_method) == 'other' ? 'selected' : '' }}>Other</option>
                                    @endif
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Transaction ID -->
                        <div class="group">
                            <label for="transaction_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Transaction ID <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id', $donation->transaction_id) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter transaction ID...">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-purple-900">Additional Information</h4>
                            <p class="text-sm text-purple-700">Optional message and comments</p>
                        </div>
                    </div>
                    
                    <!-- Message -->
                    <div class="group">
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                            Message <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <textarea name="message" id="message" rows="4" 
                                class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400 p-4" 
                                placeholder="Additional message or notes about this donation...">{{ old('message', $donation->message) }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row sm:justify-end sm:space-x-4 space-y-3 sm:space-y-0 pt-6 border-t border-gray-200">
                    @if(Route::has('admin.donations.show'))
                        <a href="{{ route('admin.donations.show', $donation) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                    @else
                        <a href="{{ route('admin.donations.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                    @endif
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Donation
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection