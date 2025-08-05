@extends('layouts.admin')

@section('title', 'Trashed Contacts - Admin Dashboard')
@section('page-title', 'Trashed Contacts')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sweetalert2-custom.css') }}">
@endpush

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <!-- Header Section -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-red-600">Trashed Contacts</h3>
                        <p class="text-sm text-red-600 mt-1">Manage deleted contact messages</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                    <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-xl">
                        <span class="text-red-600 font-semibold">{{ $contacts->firstItem() ?? 0 }}-{{ $contacts->lastItem() ?? 0 }}</span> of <span class="text-red-600 font-semibold">{{ $contacts->total() }}</span> trashed contacts
                    </div>
                    <a href="{{ route('admin.contacts.index') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Active
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <a href="{{ route('admin.contacts.index') }}" 
                   class="border-b-2 py-4 px-1 text-sm font-medium border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Active Contacts
                    <span class="ml-2 bg-gray-100 text-gray-900 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ \App\Models\Contact::whereNull('deleted_at')->count() }}</span>
                </a>
                <a href="{{ route('admin.contacts.trashed') }}" 
                   class="border-b-2 py-4 px-1 text-sm font-medium border-red-500 text-red-600">
                    Trashed Contacts
                    <span class="ml-2 bg-gray-100 text-gray-900 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $contacts->total() }}</span>
                </a>
            </nav>
        </div>

        <!-- Search and Filters -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <form method="GET" action="{{ route('admin.contacts.trashed') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div class="md:col-span-2">
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-red-500 bg-white transition-all duration-200 placeholder-gray-400" 
                                placeholder="Search trashed contacts...">
                        </div>
                    </div>
                    
                    <div>
                        <select name="status" 
                            class="focus:ring-2 focus:ring-red-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-red-500 py-3 px-4 bg-white transition-all duration-200 appearance-none">
                            @foreach($statuses as $value => $label)
                                <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <select name="urgent" 
                            class="focus:ring-2 focus:ring-red-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-red-500 py-3 px-4 bg-white transition-all duration-200 appearance-none">
                            <option value="">All Urgency</option>
                            <option value="true" {{ request('urgent') == 'true' ? 'selected' : '' }}>Urgent Only</option>
                            <option value="false" {{ request('urgent') == 'false' ? 'selected' : '' }}>Not Urgent</option>
                        </select>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                        @if(request()->hasAny(['search', 'status', 'urgent']))
                            <a href="{{ route('admin.contacts.trashed') }}" 
                               class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Contacts Table -->
        <div class="overflow-x-auto">
            @if($contacts->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subject
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deleted
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($contacts as $contact)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-gray-400 to-gray-600 flex items-center justify-center">
                                                <span class="text-sm font-medium text-white">
                                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $contact->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $contact->email }}
                                            </div>
                                            @if($contact->phone)
                                                <div class="text-sm text-gray-500">
                                                    {{ $contact->phone }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ Str::limit($contact->subject, 50) }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ Str::limit($contact->message, 80) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $contact->status_badge_class }}">
                                        {{ $contact->status_display_name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $contact->deleted_at_formatted }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <form action="{{ route('admin.contacts.restore', $contact->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to restore this contact?');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                                <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                </svg>
                                                Restore
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.contacts.force-delete', $contact->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to permanently delete this contact? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-xs font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                                <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete Permanently
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No trashed contacts found</h3>
                    <p class="mt-1 text-sm text-gray-500">No deleted contact messages match your current filters.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($contacts->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $contacts->links() }}
            </div>
        @endif
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