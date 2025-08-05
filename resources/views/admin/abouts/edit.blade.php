@extends('layouts.admin')

@section('title', 'Edit About Content')

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
                    <h1 class="text-2xl font-bold text-gray-900">Edit About Content</h1>
                    <p class="mt-1 text-sm text-gray-600">Update the about page content</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.abouts.show', $about) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View Details
                    </a>
                    <a href="{{ route('admin.abouts.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form id="edit-about-form" action="{{ route('admin.abouts.update', $about) }}" method="POST" data-confirm="Are you sure you want to update this about content?">
            @csrf
            @method('PUT')
            
            <div class="bg-white shadow rounded-lg">
                <!-- Form Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">About Content Details</h3>
                    <p class="mt-1 text-sm text-gray-600">Update the details for the about page content.</p>
                </div>

                <div class="px-6 py-4 space-y-6">
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $about->title) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('title') border-red-500 @enderror"
                                   placeholder="Enter content title">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $about->display_order) }}" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('display_order') border-red-500 @enderror"
                                   placeholder="0">
                            @error('display_order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select name="status" id="status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 @error('status') border-red-500 @enderror">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status', $about->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $about->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $about->is_active) ? 'checked' : '' }}
                                   class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">Is Active</label>
                        </div>
                    </div>

                    <!-- Hero Section -->
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Hero Section</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="hero_badge_text" class="block text-sm font-medium text-gray-700 mb-2">Badge Text</label>
                                <input type="text" name="hero_badge_text" id="hero_badge_text" value="{{ old('hero_badge_text', $about->hero_badge_text) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                       placeholder="About Us">
                            </div>

                            <div>
                                <label for="hero_title" class="block text-sm font-medium text-gray-700 mb-2">Hero Title</label>
                                <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $about->hero_title) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                       placeholder="Building a Better World">
                            </div>

                            <div>
                                <label for="hero_subtitle" class="block text-sm font-medium text-gray-700 mb-2">Hero Subtitle</label>
                                <input type="text" name="hero_subtitle" id="hero_subtitle" value="{{ old('hero_subtitle', $about->hero_subtitle) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                       placeholder="Through Islamic Crowdfunding">
                            </div>

                            <div>
                                <label for="hero_description" class="block text-sm font-medium text-gray-700 mb-2">Hero Description</label>
                                <textarea name="hero_description" id="hero_description" rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                          placeholder="Jariah Fund is Malaysia's premier Shariah-compliant platform...">{{ old('hero_description', $about->hero_description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Mission & Vision -->
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Mission & Vision</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="mission" class="block text-sm font-medium text-gray-700 mb-2">Mission</label>
                                <textarea name="mission" id="mission" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                          placeholder="Enter the organization's mission...">{{ old('mission', $about->mission) }}</textarea>
                            </div>

                            <div>
                                <label for="vision" class="block text-sm font-medium text-gray-700 mb-2">Vision</label>
                                <textarea name="vision" id="vision" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                          placeholder="Enter the organization's vision...">{{ old('vision', $about->vision) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="values" class="block text-sm font-medium text-gray-700 mb-2">Values</label>
                            <textarea name="values" id="values" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                      placeholder="Enter the organization's values...">{{ old('values', $about->values) }}</textarea>
                        </div>
                    </div>

                    <!-- Bank Muamalat Section -->
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Bank Muamalat Section</h4>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="bank_muamalat_title" class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                                <input type="text" name="bank_muamalat_title" id="bank_muamalat_title" value="{{ old('bank_muamalat_title', $about->bank_muamalat_title) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                       placeholder="Bank Muamalat Malaysia Berhad">
                            </div>

                            <div>
                                <label for="bank_muamalat_description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="bank_muamalat_description" id="bank_muamalat_description" rows="6"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                          placeholder="Enter the Bank Muamalat description...">{{ old('bank_muamalat_description', $about->bank_muamalat_description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Payment Section</h4>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="payment_section_title" class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                                <input type="text" name="payment_section_title" id="payment_section_title" value="{{ old('payment_section_title', $about->payment_section_title) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                       placeholder="Simple & Secure Donation">
                            </div>

                            <div>
                                <label for="payment_section_description" class="block text-sm font-medium text-gray-700 mb-2">Section Description</label>
                                <textarea name="payment_section_description" id="payment_section_description" rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                          placeholder="Choose from Malaysia's most trusted payment methods...">{{ old('payment_section_description', $about->payment_section_description) }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="fpx_description" class="block text-sm font-medium text-gray-700 mb-2">FPX Description</label>
                                    <textarea name="fpx_description" id="fpx_description" rows="4"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                              placeholder="Enter FPX payment description...">{{ old('fpx_description', $about->fpx_description) }}</textarea>
                                </div>

                                <div>
                                    <label for="duitnow_description" class="block text-sm font-medium text-gray-700 mb-2">DuitNow Description</label>
                                    <textarea name="duitnow_description" id="duitnow_description" rows="4"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                              placeholder="Enter DuitNow payment description...">{{ old('duitnow_description', $about->duitnow_description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('admin.abouts.show', $about) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000] hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update About Content
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/abouts-crud.js') }}"></script>
<script>
// Show validation errors if any
@if($errors->any())
    showValidationErrors(@json($errors->all()));
@endif
</script>
@endpush 