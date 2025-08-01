@extends('layouts.admin')

@section('title', 'Donations - Admin Dashboard')
@section('page-title', 'Donations')

@section('content')
<div class="space-y-6 font-sans">
    <!-- Main Content with Enhanced Design -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <!-- Enhanced Header Section -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">Donations Directory</h3>
                        <p class="text-sm text-[#fe5000] mt-1">Track and manage all donation transactions</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                    <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-xl">
                        <span class="text-[#fe5000] font-semibold">{{ $donations->firstItem() ?? 0 }}-{{ $donations->lastItem() ?? 0 }}</span> of <span class="text-[#fe5000] font-semibold">{{ $donations->total() }}</span> donations
                    </div>
                    @if(Route::has('admin.donations.create'))
                        <a href="{{ route('admin.donations.create') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Donation
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <form method="GET" action="{{ route('admin.donations.index') }}" class="space-y-4">
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
                                class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                placeholder="Search donations...">
                        </div>
                    </div>
                    
                    <!-- Status Filter -->
                    <div>
                        <select name="status" 
                            class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none">
                            <option value="">All Status</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="flex space-x-2">
                        <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.donations.index') }}" 
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

        <!-- Donations Table -->
        <div class="overflow-x-auto">
            @if($donations->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Donor</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Campaign</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Amount</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Payment Method</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-700 tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($donations as $donation)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center border border-gray-200">
                                                <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-xs font-semibold text-gray-900">
                                                {{ $donation->donor_name ?? 'Anonymous' }}
                                            </div>
                                            <div class="text-xs text-gray-500">{{ $donation->donor_email ?? 'No email' }}</div>
                                            @if($donation->is_anonymous)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mt-1">
                                                    Anonymous
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($donation->campaign && $donation->campaign->featured_image)
                                                <img class="h-10 w-10 rounded-lg object-cover border border-gray-200" src="{{ asset('storage/' . $donation->campaign->featured_image) }}" alt="{{ $donation->campaign->title }}">
                                            @else
                                                <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center border border-gray-200">
                                                    <svg class="h-5 w-5 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-xs font-semibold text-gray-900">
                                                @if($donation->campaign)
                                                    <a href="{{ route('admin.campaigns.show', $donation->campaign) }}" class="hover:text-[#fe5000] transition-colors duration-200">
                                                        {{ Str::limit($donation->campaign->title, 30) }}
                                                    </a>
                                                @else
                                                    <span class="text-gray-500">No Campaign</span>
                                                @endif
                                            </div>
                                            @if($donation->campaign && $donation->campaign->category)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mt-1">
                                                    {{ ucfirst($donation->campaign->category) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs font-semibold text-[#fe5000]">{{ number_format($donation->amount, 2) }}</div>
                                    <div class="text-xs text-gray-500">{{ $donation->currency ?? 'MYR' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs font-semibold text-gray-900">{{ ucfirst($donation->payment_method ?? 'N/A') }}</div>
                                    @if($donation->transaction_id)
                                        <div class="text-xs text-gray-500">{{ Str::limit($donation->transaction_id, 15) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                                        @if($donation->payment_status === 'completed') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                                        @elseif($donation->payment_status === 'pending') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-200
                                        @elseif($donation->payment_status === 'failed') bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-200
                                        @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200
                                        @endif">
                                        @if($donation->payment_status === 'completed')
                                            <span class="h-2 w-2 rounded-full mr-1 bg-green-400"></span>
                                        @elseif($donation->payment_status === 'pending')
                                            <span class="h-2 w-2 rounded-full mr-1 bg-yellow-400 animate-pulse"></span>
                                        @endif
                                        {{ ucfirst($donation->payment_status ?? 'Unknown') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                    <div>{{ $donation->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $donation->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        @if(Route::has('admin.donations.show'))
                                            <a href="{{ route('admin.donations.show', $donation) }}" 
                                               class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                                <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                        @endif
                                        @if(Route::has('admin.donations.edit'))
                                            <a href="{{ route('admin.donations.edit', $donation) }}" 
                                               class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                                <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                        @endif
                                        @if(Route::has('admin.donations.destroy'))
                                            <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this donation?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-xs font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                                    <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="mx-auto h-24 w-24 bg-gradient-to-br from-[#fe5000]/10 to-orange-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-12 w-12 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No donations found</h3>
                    <p class="text-gray-500 mb-6">
                        @if(request()->hasAny(['search', 'status']))
                            No donations match your current filters. Try adjusting your search criteria.
                        @else
                            Get started by creating your first donation record.
                        @endif
                    </p>
                    <div class="flex justify-center space-x-4">
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.donations.index') }}" 
                               class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Clear Filters
                            </a>
                        @endif
                        @if(Route::has('admin.donations.create'))
                            <a href="{{ route('admin.donations.create') }}" 
                               class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add First Donation
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Enhanced Pagination -->
        @if($donations->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        @if ($donations->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-500 bg-white cursor-default">
                                Previous
                            </span>
                        @else
                            <a href="{{ $donations->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200">
                                Previous
                            </a>
                        @endif

                        @if ($donations->hasMorePages())
                            <a href="{{ $donations->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200">
                                Next
                            </a>
                        @else
                            <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-500 bg-white cursor-default">
                                Next
                            </span>
                        @endif
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-semibold text-[#fe5000]">{{ $donations->firstItem() ?? 0 }}</span> to <span class="font-semibold text-[#fe5000]">{{ $donations->lastItem() ?? 0 }}</span> of <span class="font-semibold text-[#fe5000]">{{ $donations->total() }}</span> results
                            </p>
                        </div>
                        <div>
                            {{ $donations->appends(request()->query())->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>


@endsection 