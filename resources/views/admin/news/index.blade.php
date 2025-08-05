@extends('layouts.admin')

@section('title', 'News - Admin Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sweetalert2-custom.css') }}">
@endpush
@section('page-title', 'News')

@section('content')
<div class="space-y-6">
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <!-- Header Section -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">News Management</h3>
                        <p class="text-sm text-[#fe5000] mt-1">Manage and monitor all news articles</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                    <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-xl">
                        <span class="text-[#fe5000] font-semibold">{{ $news->firstItem() ?? 0 }}-{{ $news->lastItem() ?? 0 }}</span> of <span class="text-[#fe5000] font-semibold">{{ $news->total() }}</span> news articles
                    </div>
                    <a href="{{ route('admin.news.create') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add News
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <a href="{{ route('admin.news.index') }}" 
                   class="border-b-2 py-4 px-1 text-sm font-medium {{ !request('trashed') ? 'border-[#fe5000] text-[#fe5000]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Active News
                    <span class="ml-2 bg-gray-100 text-gray-900 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $activeCount }}</span>
                </a>
                <a href="{{ route('admin.news.index', ['trashed' => 1]) }}" 
                   class="border-b-2 py-4 px-1 text-sm font-medium {{ request('trashed') ? 'border-[#fe5000] text-[#fe5000]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Trashed News
                    <span class="ml-2 bg-gray-100 text-gray-900 py-0.5 px-2.5 rounded-full text-xs font-medium">{{ $trashedCount }}</span>
                </a>
            </nav>
        </div>

        <!-- Search and Filters -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <form method="GET" action="{{ route('admin.news.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                placeholder="Search news...">
                        </div>
                    </div>
                    
                    <div>
                        <select name="status" 
                            class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none">
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                        @if(request()->hasAny(['search', 'status', 'category']))
                            <a href="{{ route('admin.news.index') }}" 
                               class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
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

        <!-- News Table -->
        <div class="overflow-x-auto">
            @if($news->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">News</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Featured</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Created By</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Order</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Created</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($news as $newsItem)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            @if($newsItem->image_path)
                                                <img class="h-12 w-12 rounded-lg object-cover" src="{{ asset('storage/' . $newsItem->image_path) }}" alt="{{ $newsItem->title }}">
                                            @else
                                                <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $newsItem->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($newsItem->excerpt, 80) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                                        @if($newsItem->category === 'general') bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200
                                        @elseif($newsItem->category === 'announcement') bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-200
                                        @elseif($newsItem->category === 'event') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                                        @elseif($newsItem->category === 'campaign') bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 border border-purple-200
                                        @else bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 border border-orange-200
                                        @endif">
                                        {{ ucfirst($newsItem->category) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                                        @if($newsItem->status === 'published') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                                        @elseif($newsItem->status === 'draft') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-200
                                        @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200
                                        @endif">
                                        @if($newsItem->status === 'published')
                                            <span class="h-2 w-2 rounded-full mr-1 bg-green-400 animate-pulse"></span>
                                        @endif
                                        {{ ucfirst($newsItem->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($newsItem->featured)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="-ml-0.5 mr-1.5 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            Featured
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($newsItem->creator)
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                @if($newsItem->creator->profile_picture)
                                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/' . $newsItem->creator->profile_picture) }}" alt="{{ $newsItem->creator->user->name }}">
                                                @else
                                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-blue-600">{{ substr($newsItem->creator->user->name ?? 'S', 0, 1) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $newsItem->creator->user->name ?? 'Unknown' }}</div>
                                                <div class="text-xs text-gray-500">{{ ucfirst($newsItem->creator->role ?? 'Staff') }}</div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">Unknown</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $newsItem->display_order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>{{ $newsItem->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $newsItem->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        @if(!request('trashed'))
                                            <!-- Active News Actions -->
                                            <a href="{{ route('admin.news.show', $newsItem) }}" 
                                               class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                                <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('admin.news.edit', $newsItem) }}" 
                                               class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                                <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button type="button" 
                                                    data-delete-news
                                                    data-news-title="{{ $newsItem->title }}"
                                                    data-delete-url="{{ route('admin.news.destroy', $newsItem) }}"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-xs font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                                <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Move to Trash
                                            </button>
                                        @else
                                            <!-- Trashed News Actions -->
                                            <span class="text-xs text-gray-400 mr-2">
                                                Deleted: {{ $newsItem->deleted_at->format('M d, Y') }}
                                            </span>
                                            <button type="button" 
                                                    data-restore-news
                                                    data-news-title="{{ $newsItem->title }}"
                                                    data-restore-url="{{ route('admin.news.restore', $newsItem->id) }}"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-xs font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                                <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                </svg>
                                                Restore
                                            </button>
                                            <button type="button" 
                                                    data-force-delete-news
                                                    data-news-title="{{ $newsItem->title }}"
                                                    data-force-delete-url="{{ route('admin.news.force-delete', $newsItem->id) }}"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-xs font-medium text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition-all duration-200">
                                                <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete Permanently
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-12">
                    <div class="mx-auto h-24 w-24 text-gray-300 mb-4">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="h-24 w-24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No news found</h3>
                    <p class="text-gray-500 mb-6">Get started by creating your first news article.</p>
                    <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add News
                    </a>
                </div>
            @endif
        </div>

        @if($news->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $news->links() }}
            </div>
        @endif
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