@extends('layouts.admin')

@section('title', 'Edit Contact - Admin Dashboard')
@section('page-title', 'Edit Contact')

@section('content')
<div class="space-y-6">
    <!-- Main Content -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <form id="edit-contact-form" action="{{ route('admin.contacts.update', $contact) }}" method="POST" data-confirm="Are you sure you want to update this contact?">
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
                            <h3 class="text-xl font-bold text-[#fe5000]">Edit Contact</h3>
                            <p class="text-sm text-[#fe5000] mt-1">Update contact status and admin notes</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Contact
                        </a>
                        <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Banner -->
            <div class="mx-6 mt-6 bg-gradient-to-r from-[#fe5000]/5 to-orange-50 rounded-xl p-6 flex items-center border border-[#fe5000]/20">
                <div class="flex-shrink-0 mr-6">
                    <div class="h-20 w-20 rounded-xl overflow-hidden bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center border-2 border-[#fe5000]/30 shadow-sm">
                        <svg class="h-10 w-10 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900">{{ $contact->full_name }}</h2>
                    <p class="text-sm text-gray-600 flex items-center mt-1">
                        <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Received {{ $contact->created_at->format('M d, Y') }}
                    </p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                            @if($contact->status === 'new') bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-200
                            @elseif($contact->status === 'read') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-200
                            @elseif($contact->status === 'replied') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                            @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200
                            @endif">
                            <span class="h-2 w-2 rounded-full mr-1
                                @if($contact->status === 'new') bg-blue-400
                                @elseif($contact->status === 'read') bg-yellow-400
                                @elseif($contact->status === 'replied') bg-green-400
                                @else bg-gray-400
                                @endif"></span>
                            {{ ucfirst($contact->status) }}
                        </span>
                        @if($contact->is_urgent)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-200">
                                <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                Urgent Priority
                            </span>
                        @endif
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm bg-gradient-to-r from-[#fe5000]/10 to-orange-100 text-[#fe5000] border border-[#fe5000]/20">
                            {{ $contact->subject }}
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
                <!-- Contact Management Section -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-[#fe5000]/10 to-orange-50 p-4 rounded-xl border border-[#fe5000]/20">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-[#fe5000] rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-[#fe5000]">Contact Management</h4>
                            <p class="text-sm text-[#fe5000]/70">Update the contact's status and priority</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Status -->
                        <div class="group">
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Contact Status <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="status" name="status" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="new" {{ $contact->status === 'new' ? 'selected' : '' }}>New</option>
                                    <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                    <option value="closed" {{ $contact->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Priority Checkbox -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Priority Level
                            </label>
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <input id="is_urgent" name="is_urgent" type="checkbox" value="1" 
                                        {{ $contact->is_urgent ? 'checked' : '' }}
                                        class="h-4 w-4 text-[#fe5000] focus:ring-[#fe5000] border-gray-300 rounded transition-all duration-200">
                                    <label for="is_urgent" class="ml-3 text-sm font-medium text-gray-700 flex items-center">
                                        <svg class="h-4 w-4 mr-1 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        Mark as Urgent
                                    </label>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Check this box to flag this contact as urgent priority</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Notes Section -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-[#fe5000]/10 to-orange-50 p-4 rounded-xl border border-[#fe5000]/20">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-[#fe5000] rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-[#fe5000]">Admin Notes</h4>
                            <p class="text-sm text-[#fe5000]/70">Add internal notes about this contact</p>
                        </div>
                    </div>
                    
                    <!-- Admin Notes -->
                    <div class="group">
                        <label for="admin_notes" class="block text-sm font-semibold text-gray-700 mb-2">
                            Internal Notes
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <textarea id="admin_notes" name="admin_notes" rows="6"
                                class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400 p-4 resize-vertical"
                                placeholder="Add internal notes about this contact...">{{ old('admin_notes', $contact->admin_notes) }}</textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">These notes are for internal use only and will not be visible to the contact.</p>
                        @error('admin_notes')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contact Information Display -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-xl border border-gray-200">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-gray-600 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-700">Contact Information</h4>
                            <p class="text-sm text-gray-500">Original message details</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <h5 class="text-sm font-semibold text-gray-700 mb-3">Contact Details</h5>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-xs font-medium text-gray-500">Name</dt>
                                    <dd class="text-sm text-gray-900">{{ $contact->full_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-medium text-gray-500">Email</dt>
                                    <dd class="text-sm text-gray-900">
                                        <a href="mailto:{{ $contact->email }}" class="text-[#fe5000] hover:text-orange-600 transition-colors">
                                            {{ $contact->email }}
                                        </a>
                                    </dd>
                                </div>
                                @if($contact->phone)
                                    <div>
                                        <dt class="text-xs font-medium text-gray-500">Phone</dt>
                                        <dd class="text-sm text-gray-900">{{ $contact->phone }}</dd>
                                    </div>
                                @endif
                                <div>
                                    <dt class="text-xs font-medium text-gray-500">Subject</dt>
                                    <dd class="text-sm text-gray-900">{{ $contact->subject }}</dd>
                                </div>
                            </dl>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <h5 class="text-sm font-semibold text-gray-700 mb-3">Original Message</h5>
                            <div class="prose prose-sm max-w-none">
                                <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $contact->message }}</p>
                            </div>
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                <p class="text-xs text-gray-500">
                                    Received {{ $contact->created_at->format('M d, Y \a\t H:i') }}
                                    ({{ $contact->created_at->diffForHumans() }})
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.contacts.show', $contact) }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Contact
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div data-success-message="{{ session('success') }}"></div>
@endif

@if(session('error'))
    <div data-error-message="{{ session('error') }}"></div>
@endif

@if($errors->any())
    <div data-validation-errors="{{ json_encode($errors->toArray()) }}"></div>
@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/contacts-crud.js') }}"></script>
@endpush 