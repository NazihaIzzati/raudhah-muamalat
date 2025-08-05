@extends('layouts.admin')

@section('title', 'View About Content')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sweetalert2-custom.css') }}">
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">About Content Details</h1>
                    <p class="mt-1 text-sm text-gray-600">View details of the about page content</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.abouts.edit', $about) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </a>
                    <button onclick="deleteAbout({{ $about->id }}, '{{ $about->title }}')" class="inline-flex items-center justify-center px-6 py-3 border border-red-300 rounded-xl shadow-sm text-sm font-semibold text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                    <a href="{{ route('admin.abouts.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000] hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4" data-success-message="{{ session('success') }}">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4" data-error-message="{{ session('error') }}">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $about->title }}</h3>
                        <div class="mt-1 flex items-center space-x-4">
                            @if($about->isActive())
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Inactive
                                </span>
                            @endif
                            <span class="text-sm text-gray-500">Order: {{ $about->display_order }}</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Created {{ $about->created_at->format('M d, Y H:i') }}</p>
                        @if($about->creator)
                            <p class="text-sm text-gray-500">by {{ $about->creator->name }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content Sections -->
            <div class="px-6 py-4 space-y-8">
                <!-- Hero Section -->
                @if($about->hero_badge_text || $about->hero_title || $about->hero_subtitle || $about->hero_description)
                    <div class="border-b border-gray-200 pb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Hero Section</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($about->hero_badge_text)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Badge Text</label>
                                    <p class="text-sm text-gray-900">{{ $about->hero_badge_text }}</p>
                                </div>
                            @endif

                            @if($about->hero_title)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Hero Title</label>
                                    <p class="text-sm text-gray-900">{{ $about->hero_title }}</p>
                                </div>
                            @endif

                            @if($about->hero_subtitle)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Hero Subtitle</label>
                                    <p class="text-sm text-gray-900">{{ $about->hero_subtitle }}</p>
                                </div>
                            @endif

                            @if($about->hero_description)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Hero Description</label>
                                    <p class="text-sm text-gray-900">{{ $about->hero_description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Mission & Vision -->
                @if($about->mission || $about->vision || $about->values)
                    <div class="border-b border-gray-200 pb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Mission & Vision</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($about->mission)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mission</label>
                                    <p class="text-sm text-gray-900">{{ $about->mission }}</p>
                                </div>
                            @endif

                            @if($about->vision)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Vision</label>
                                    <p class="text-sm text-gray-900">{{ $about->vision }}</p>
                                </div>
                            @endif

                            @if($about->values)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Values</label>
                                    <p class="text-sm text-gray-900">{{ $about->values }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Bank Muamalat Section -->
                @if($about->bank_muamalat_title || $about->bank_muamalat_description)
                    <div class="border-b border-gray-200 pb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Bank Muamalat Section</h4>
                        <div class="space-y-4">
                            @if($about->bank_muamalat_title)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
                                    <p class="text-sm text-gray-900">{{ $about->bank_muamalat_title }}</p>
                                </div>
                            @endif

                            @if($about->bank_muamalat_description)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <p class="text-sm text-gray-900">{{ $about->bank_muamalat_description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Payment Section -->
                @if($about->payment_section_title || $about->payment_section_description || $about->fpx_description || $about->duitnow_description)
                    <div class="border-b border-gray-200 pb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Payment Section</h4>
                        <div class="space-y-4">
                            @if($about->payment_section_title)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Section Title</label>
                                    <p class="text-sm text-gray-900">{{ $about->payment_section_title }}</p>
                                </div>
                            @endif

                            @if($about->payment_section_description)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Section Description</label>
                                    <p class="text-sm text-gray-900">{{ $about->payment_section_description }}</p>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @if($about->fpx_description)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">FPX Description</label>
                                        <p class="text-sm text-gray-900">{{ $about->fpx_description }}</p>
                                    </div>
                                @endif

                                @if($about->duitnow_description)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">DuitNow Description</label>
                                        <p class="text-sm text-gray-900">{{ $about->duitnow_description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Meta Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Meta Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <p class="text-sm text-gray-900">{{ ucfirst($about->status) }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Is Active</label>
                            <p class="text-sm text-gray-900">{{ $about->is_active ? 'Yes' : 'No' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                            <p class="text-sm text-gray-900">{{ $about->display_order }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                            <p class="text-sm text-gray-900">{{ $about->created_at->format('M d, Y H:i') }}</p>
                        </div>

                        @if($about->updated_at != $about->created_at)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Updated</label>
                                <p class="text-sm text-gray-900">{{ $about->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        @endif

                        @if($about->updater)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Updated By</label>
                                <p class="text-sm text-gray-900">{{ $about->updater->name }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.abouts.edit', $about) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('admin.abouts.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000] hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/abouts-crud.js') }}"></script>
@endpush 