@extends('layouts.admin')

@section('title', 'Trashed Campaigns - Admin Dashboard')
@section('page-title', 'Trashed Campaigns')

@section('content')
<div class="space-y-6 font-sans">
    <!-- Main Content with Enhanced Design -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <!-- Enhanced Header Section -->
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
                        <h3 class="text-xl font-bold text-red-600">Trashed Campaigns</h3>
                        <p class="text-sm text-red-600 mt-1">Manage deleted campaigns</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                    <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-xl">
                        <span class="text-red-600 font-semibold">{{ $campaigns->firstItem() ?? 0 }}-{{ $campaigns->lastItem() ?? 0 }}</span> of <span class="text-red-600 font-semibold">{{ $campaigns->total() }}</span> trashed campaigns
                    </div>
                    <a href="{{ route('admin.campaigns.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Campaigns
                    </a>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <form method="GET" action="{{ route('admin.campaigns.trashed') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-red-500 bg-white transition-all duration-200 placeholder-gray-400" 
                                placeholder="Search trashed campaigns...">
                        </div>
                    </div>
                    
                    <!-- Status Filter -->
                    <div>
                        <select name="status" 
                            class="focus:ring-2 focus:ring-red-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-red-500 py-3 px-4 bg-white transition-all duration-200 appearance-none">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="paused" {{ request('status') == 'paused' ? 'selected' : '' }}>Paused</option>
                        </select>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="flex space-x-2">
                        <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.campaigns.trashed') }}" 
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

        <!-- Campaigns Table -->
        <div class="overflow-x-auto">
            @if($campaigns->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Campaign</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Organization</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Goal</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Raised</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Deleted</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($campaigns as $campaign)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if($campaign->featured_image)
                                            <img class="h-12 w-12 rounded-lg object-cover" src="{{ asset('storage/' . $campaign->featured_image) }}" alt="{{ $campaign->title }}">
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $campaign->title }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($campaign->description, 50) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $campaign->organization_name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $campaign->currency }} {{ number_format($campaign->goal_amount, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $campaign->currency }} {{ number_format($campaign->raised_amount, 2) }}</div>
                                <div class="text-xs text-gray-500">{{ number_format($campaign->percentageReached(), 1) }}%</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($campaign->status === 'active') bg-green-100 text-green-800
                                    @elseif($campaign->status === 'completed') bg-blue-100 text-blue-800
                                    @elseif($campaign->status === 'draft') bg-gray-100 text-gray-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($campaign->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $campaign->deleted_at->format('M j, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <form action="{{ route('admin.campaigns.restore', $campaign) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-900 transition-colors duration-200" onclick="return confirm('Are you sure you want to restore this campaign?')">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.campaigns.force-delete', $campaign) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" onclick="return confirm('Are you sure you want to permanently delete this campaign? This action cannot be undone.')">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No trashed campaigns</h3>
                    <p class="mt-1 text-sm text-gray-500">No campaigns have been deleted yet.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.campaigns.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Campaigns
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($campaigns->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $campaigns->links() }}
            </div>
        @endif
    </div>
</div>

<!-- SweetAlert2 for notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="{{ asset('css/sweetalert2-custom.css') }}">

<script>
// Display session messages
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#fe5000'
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#fe5000'
    });
@endif

@if(session('warning'))
    Swal.fire({
        icon: 'warning',
        title: 'Warning!',
        text: '{{ session('warning') }}',
        confirmButtonColor: '#fe5000'
    });
@endif

@if(session('info'))
    Swal.fire({
        icon: 'info',
        title: 'Info!',
        text: '{{ session('info') }}',
        confirmButtonColor: '#fe5000'
    });
@endif

// Display validation errors
@if($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Validation Error!',
        html: `
            <ul class="text-left">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        `,
        confirmButtonColor: '#fe5000'
    });
@endif
</script>
@endsection 