@extends('layouts.admin')

@section('title', 'News Details - Admin Dashboard')
@section('page-title', 'News Details')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sweetalert2-custom.css') }}">
@endpush

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $news->title }}</h3>
                        <p class="text-sm text-gray-500">News article details and information</p>
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <a href="{{ route('admin.news.edit', $news) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to News
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Status -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-blue-600">Status</p>
                            <p class="text-2xl font-bold text-blue-900">{{ ucfirst($news->status) }}</p>
                        </div>
                    </div>
                    @if($news->status === 'published')
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="h-2 w-2 rounded-full bg-green-400 mr-1"></span>
                                Live
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Category -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-purple-600">Category</p>
                            <p class="text-2xl font-bold text-purple-900">{{ ucfirst($news->category) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Display Order -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-green-500 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-green-600">Display Order</p>
                            <p class="text-2xl font-bold text-green-900">{{ $news->display_order }}</p>
                        </div>
                    </div>
                </div>

                <!-- Created Date -->
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 border border-orange-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-orange-500 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-orange-600">Created</p>
                            <p class="text-lg font-bold text-orange-900">{{ $news->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="text-xs text-orange-600">{{ $news->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Featured Status -->
            @if($news->featured)
                <div class="mb-6 p-4 bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="text-sm font-medium text-yellow-800">This news article is featured and will appear prominently on the website</span>
                    </div>
                </div>
            @endif

            <!-- Published Date -->
            @if($news->published_at)
                <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-green-800">
                            Published on {{ $news->published_at->format('M d, Y \a\t g:i A') }}
                        </span>
                    </div>
                </div>
            @endif

            <!-- Content Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- News Image -->
                    @if($news->image_path)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">News Image</h3>
                            <div class="relative">
                                <img src="{{ asset('storage/' . $news->image_path) }}" 
                                     alt="{{ $news->title }}" 
                                     class="w-full h-auto rounded-lg shadow-sm">
                            </div>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
                        <div class="prose max-w-none">
                            {!! nl2br(e($news->content)) !!}
                        </div>
                    </div>

                    <!-- Excerpt -->
                    @if($news->excerpt)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Excerpt</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $news->excerpt }}</p>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Creator Info -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Created By</h3>
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">
                                    {{ strtoupper(substr($news->creator->name ?? 'U', 0, 1)) }}
                                </span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $news->creator->name ?? 'Unknown' }}</p>
                                <p class="text-sm text-gray-500">{{ $news->creator->email ?? 'No email' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.news.edit', $news) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit News
                            </a>
                            
                            <button type="button" 
                                    data-delete-news
                                    data-news-title="{{ $news->title }}"
                                    data-delete-url="{{ route('admin.news.destroy', $news) }}"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Move to Trash
                            </button>
                        </div>
                    </div>

                    <!-- Status Information -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Information</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Current Status:</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($news->status === 'published') bg-green-100 text-green-800
                                    @elseif($news->status === 'draft') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($news->status) }}
                                </span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Featured:</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($news->featured) bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $news->featured ? 'Yes' : 'No' }}
                                </span>
                            </div>
                            
                            @if($news->published_at)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Published:</span>
                                    <span class="text-sm text-gray-900">{{ $news->published_at->format('M d, Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/news-crud.js') }}"></script>
<script>
    // Show success/error messages from session
    @if(session('success'))
        showSuccess('{{ session('success') }}');
    @endif
    
    @if(session('error'))
        showError('{{ session('error') }}');
    @endif
    
    @if(session('warning'))
        showWarning('{{ session('warning') }}');
    @endif
    
    @if(session('info'))
        showInfo('{{ session('info') }}');
    @endif
    
    // Show validation errors
    @if($errors->any())
        showValidationErrors(@json($errors->all()));
    @endif
</script>
@endpush
@endsection 