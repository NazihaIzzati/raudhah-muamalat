@extends('layouts.admin')

@section('page-title', 'Create New Branch')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <form action="{{ route('admin.branches.store') }}" method="POST" class="p-6">
        @csrf
        
        <!-- Header -->
        <div class="border-b border-gray-200 pb-5 mb-5">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Branch Information</h3>
            <p class="mt-1 text-sm text-gray-500">Create a new branch office.</p>
        </div>
        
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="rounded-md bg-red-50 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
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
        
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <!-- Basic Information Section -->
            <div class="sm:col-span-6">
                <h4 class="text-md font-medium text-gray-900 mb-3">Basic Information</h4>
            </div>
            
            <!-- Name -->
            <div class="sm:col-span-3">
                <label for="name" class="block text-sm font-medium text-gray-700">Branch Name</label>
                <div class="mt-1">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- Code -->
            <div class="sm:col-span-3">
                <label for="code" class="block text-sm font-medium text-gray-700">Branch Code</label>
                <div class="mt-1">
                    <input type="text" name="code" id="code" value="{{ old('code') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                <p class="mt-2 text-xs text-gray-500">Unique identifier for this branch (e.g., KL-001).</p>
            </div>
            
            <!-- Status -->
            <div class="sm:col-span-3">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <div class="mt-1">
                    <select id="status" name="status" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            
            <!-- Manager Name -->
            <div class="sm:col-span-3">
                <label for="manager_name" class="block text-sm font-medium text-gray-700">Branch Manager</label>
                <div class="mt-1">
                    <input type="text" name="manager_name" id="manager_name" value="{{ old('manager_name') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- Address Section -->
            <div class="sm:col-span-6 pt-3">
                <h4 class="text-md font-medium text-gray-900 mb-3">Address Information</h4>
            </div>
            
            <!-- Address -->
            <div class="sm:col-span-6">
                <label for="address" class="block text-sm font-medium text-gray-700">Street Address</label>
                <div class="mt-1">
                    <input type="text" name="address" id="address" value="{{ old('address') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- City -->
            <div class="sm:col-span-2">
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <div class="mt-1">
                    <input type="text" name="city" id="city" value="{{ old('city') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- State -->
            <div class="sm:col-span-2">
                <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                <div class="mt-1">
                    <input type="text" name="state" id="state" value="{{ old('state') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- Postal Code -->
            <div class="sm:col-span-2">
                <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                <div class="mt-1">
                    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- Country -->
            <div class="sm:col-span-3">
                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                <div class="mt-1">
                    <input type="text" name="country" id="country" value="{{ old('country', 'Malaysia') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- Contact Section -->
            <div class="sm:col-span-6 pt-3">
                <h4 class="text-md font-medium text-gray-900 mb-3">Contact Information</h4>
            </div>
            
            <!-- Phone -->
            <div class="sm:col-span-3">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <div class="mt-1">
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- Email -->
            <div class="sm:col-span-3">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <div class="mt-1">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- Additional Information Section -->
            <div class="sm:col-span-6 pt-3">
                <h4 class="text-md font-medium text-gray-900 mb-3">Additional Information</h4>
            </div>
            
            <!-- Opening Hours -->
            <div class="sm:col-span-3">
                <label for="opening_hours" class="block text-sm font-medium text-gray-700">Opening Hours</label>
                <div class="mt-1">
                    <input type="text" name="opening_hours" id="opening_hours" value="{{ old('opening_hours') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="e.g., Mon-Fri: 9AM-5PM">
                </div>
            </div>
            
            <!-- Description -->
            <div class="sm:col-span-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div class="mt-1">
                    <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                </div>
                <p class="mt-2 text-sm text-gray-500">Additional information about this branch.</p>
            </div>
            
            <!-- Location Section -->
            <div class="sm:col-span-6 pt-3">
                <h4 class="text-md font-medium text-gray-900 mb-3">Location Coordinates (Optional)</h4>
            </div>
            
            <!-- Latitude -->
            <div class="sm:col-span-3">
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <div class="mt-1">
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="e.g., 3.1390">
                </div>
            </div>
            
            <!-- Longitude -->
            <div class="sm:col-span-3">
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <div class="mt-1">
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="e.g., 101.6869">
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="pt-5 mt-6 border-t border-gray-200">
            <div class="flex justify-end">
                <a href="{{ route('admin.branches.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Cancel
                </a>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Create Branch
                </button>
            </div>
        </div>
    </form>
</div>
@endsection 