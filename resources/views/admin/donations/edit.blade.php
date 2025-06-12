@extends('layouts.admin')

@section('page-title', 'Edit Donation')

@section('content')
<!-- Statistics Cards -->
<div class="mb-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
    <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
        <div class="p-6 text-[#fe5000]">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-sm font-medium text-[#fe5000]">Current Amount</h3>
                    <p class="text-2xl font-bold">{{ number_format($donation->amount, 2) }} {{ $donation->currency }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
        <div class="p-6 text-[#fe5000]">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-sm font-medium text-[#fe5000]">Payment Status</h3>
                    <p class="text-2xl font-bold">{{ ucfirst($donation->payment_status) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
        <div class="p-6 text-[#fe5000]">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-sm font-medium text-[#fe5000]">Donor Name</h3>
                    <p class="text-2xl font-bold">{{ $donation->donor_name }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
        <div class="p-6 text-[#fe5000]">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-sm font-medium text-[#fe5000]">Created</h3>
                    <p class="text-2xl font-bold">{{ $donation->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header -->
<div class="bg-gradient-to-r from-[#fe5000] to-orange-500 shadow-lg rounded-lg mb-6">
    <div class="px-6 py-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-white bg-opacity-20 text-white">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-6">
                    <h1 class="text-3xl font-bold text-white">Edit Donation</h1>
                    <p class="mt-2 text-orange-100">
                        Update donation information and payment details
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-white overflow-hidden shadow-xl rounded-lg">
    <div class="p-8 bg-white">
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="rounded-md bg-red-50 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                        <div class="mt-2 text-sm text-red-700">
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
        
        <form action="{{ route('admin.donations.update', $donation) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Campaign Selection -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-100">
                        <h3 class="text-lg font-semibold text-blue-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Campaign Information
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Campaign -->
                            <div>
                                <label for="campaign_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Campaign <span class="text-red-500">*</span>
                                </label>
                                <select id="campaign_id" name="campaign_id" class="mt-1 block w-full py-3 px-4 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] sm:text-sm transition duration-150 ease-in-out" required>
                                    <option value="">Select Campaign</option>
                                    @foreach($campaigns as $id => $title)
                                        <option value="{{ $id }}" {{ old('campaign_id', $donation->campaign_id) == $id ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                                @error('campaign_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- User (Optional) -->
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    User (Optional)
                                </label>
                                <select id="user_id" name="user_id" class="mt-1 block w-full py-3 px-4 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] sm:text-sm transition duration-150 ease-in-out">
                                    <option value="">Select User</option>
                                    @foreach($users as $id => $name)
                                        <option value="{{ $id }}" {{ old('user_id', $donation->user_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Donor Information -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-xl border border-purple-100">
                        <h3 class="text-lg font-semibold text-purple-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Donor Information
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Donor Name -->
                            <div>
                                <label for="donor_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="donor_name" id="donor_name" value="{{ old('donor_name', $donation->donor_name) }}" class="mt-1 focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg py-3 px-4 transition duration-150 ease-in-out" required>
                                @error('donor_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Donor Email -->
                            <div>
                                <label for="donor_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="donor_email" id="donor_email" value="{{ old('donor_email', $donation->donor_email) }}" class="mt-1 focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg py-3 px-4 transition duration-150 ease-in-out" required>
                                @error('donor_email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Donor Phone -->
                            <div>
                                <label for="donor_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone
                                </label>
                                <input type="text" name="donor_phone" id="donor_phone" value="{{ old('donor_phone', $donation->donor_phone) }}" class="mt-1 focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg py-3 px-4 transition duration-150 ease-in-out">
                                @error('donor_phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Information -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border border-green-100">
                        <h3 class="text-lg font-semibold text-green-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Additional Information
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                    Donation Message
                                </label>
                                <textarea name="message" id="message" rows="4" class="mt-1 focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg py-3 px-4 transition duration-150 ease-in-out" placeholder="Optional message from donor...">{{ old('message', $donation->message) }}</textarea>
                                @error('message')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Anonymous Donation -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="is_anonymous" name="is_anonymous" type="checkbox" class="focus:ring-[#fe5000] h-4 w-4 text-[#fe5000] border-gray-300 rounded" {{ old('is_anonymous', $donation->is_anonymous) ? 'checked' : '' }}>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_anonymous" class="font-medium text-gray-700">Anonymous Donation</label>
                                    <p class="text-gray-500">Don't show donor's name publicly</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Payment Information -->
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-xl border border-yellow-100">
                        <h3 class="text-lg font-semibold text-yellow-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Payment Information
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Amount and Currency -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                                        Amount <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1 relative rounded-lg shadow-sm">
                                        <input type="number" name="amount" id="amount" value="{{ old('amount', $donation->amount) }}" min="0.01" step="0.01" class="focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] block w-full sm:text-sm border-gray-300 rounded-lg py-3 px-4 transition duration-150 ease-in-out" required>
                                    </div>
                                    @error('amount')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">
                                        Currency <span class="text-red-500">*</span>
                                    </label>
                                    <select id="currency" name="currency" class="mt-1 block w-full py-3 px-4 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] sm:text-sm transition duration-150 ease-in-out" required>
                                        @foreach($currencies as $code => $name)
                                            <option value="{{ $code }}" {{ old('currency', $donation->currency) == $code ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('currency')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Payment Method -->
                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">
                                    Payment Method <span class="text-red-500">*</span>
                                </label>
                                <select id="payment_method" name="payment_method" class="mt-1 block w-full py-3 px-4 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] sm:text-sm transition duration-150 ease-in-out" required>
                                    <option value="">Select Payment Method</option>
                                    @foreach($paymentMethods as $value => $label)
                                        <option value="{{ $value }}" {{ old('payment_method', $donation->payment_method) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('payment_method')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Transaction ID -->
                            <div>
                                <label for="transaction_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Transaction ID
                                </label>
                                <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id', $donation->transaction_id) }}" class="mt-1 focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] block w-full shadow-sm sm:text-sm border-gray-300 rounded-lg py-3 px-4 transition duration-150 ease-in-out" placeholder="Enter transaction ID">
                                @error('transaction_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Payment Status -->
                            <div>
                                <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Payment Status <span class="text-red-500">*</span>
                                </label>
                                <select id="payment_status" name="payment_status" class="mt-1 block w-full py-3 px-4 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#fe5000] focus:border-[#fe5000] sm:text-sm transition duration-150 ease-in-out" required>
                                    @foreach($statuses as $value => $label)
                                        <option value="{{ $value }}" {{ old('payment_status', $donation->payment_status) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('payment_status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Donation Metadata -->
                    <div class="bg-gradient-to-r from-gray-50 to-slate-50 p-6 rounded-xl border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Donation Metadata
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white p-4 rounded-lg border border-gray-100">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Created At</p>
                                <p class="text-sm font-semibold text-gray-900 mt-1">{{ $donation->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg border border-gray-100">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Paid At</p>
                                <p class="text-sm font-semibold text-gray-900 mt-1">{{ $donation->paid_at ? $donation->paid_at->format('M d, Y H:i') : 'Not paid yet' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.donations.show', $donation) }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition duration-150 ease-in-out">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-[#fe5000] to-orange-500 hover:from-orange-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition duration-150 ease-in-out">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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