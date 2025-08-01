@extends('layouts.admin-new')

@section('title', 'Campaigns')
@section('page-title', 'Campaigns')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Campaign Management</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage your fundraising campaigns</p>
                </div>
                <a href="{{ route('admin.campaigns.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200">
                    <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                    Create Campaign
                </a>
            </div>
        </div>
        
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 p-6">
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-900">{{ $campaigns->total() }}</div>
                <div class="text-sm text-gray-500">Total Campaigns</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ $campaigns->where('status', 'active')->count() }}</div>
                <div class="text-sm text-gray-500">Active</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $campaigns->where('status', 'draft')->count() }}</div>
                <div class="text-sm text-gray-500">Draft</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-red-600">{{ $campaigns->where('status', 'inactive')->count() }}</div>
                <div class="text-sm text-gray-500">Inactive</div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div class="flex-1 max-w-lg">
                <form method="GET" action="{{ route('admin.campaigns.index') }}" class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-5 w-5 text-gray-400"></i>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search campaigns..." 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500">
                </form>
            </div>
            <div class="flex items-center space-x-4">
                <select name="status" 
                        onchange="this.form.submit()" 
                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-lg">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Campaigns List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Campaign
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Progress
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Raised
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($campaigns as $campaign)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if($campaign->image)
                                            <img class="h-12 w-12 rounded-lg object-cover" src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}">
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                                <i data-lucide="target" class="h-6 w-6 text-primary-600"></i>
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
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($campaign->status === 'active') bg-green-100 text-green-800
                                    @elseif($campaign->status === 'draft') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    @if($campaign->status === 'active')
                                        <span class="h-2 w-2 rounded-full mr-1 bg-green-400"></span>
                                    @elseif($campaign->status === 'draft')
                                        <span class="h-2 w-2 rounded-full mr-1 bg-yellow-400"></span>
                                    @else
                                        <span class="h-2 w-2 rounded-full mr-1 bg-red-400"></span>
                                    @endif
                                    {{ ucfirst($campaign->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $progress = $campaign->target_amount > 0 ? ($campaign->raised_amount / $campaign->target_amount) * 100 : 0;
                                @endphp
                                <div class="flex items-center">
                                    <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                                        <div class="bg-primary-600 h-2 rounded-full" style="width: {{ min($progress, 100) }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-500">{{ number_format($progress, 1) }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">${{ number_format($campaign->raised_amount, 2) }}</div>
                                <div class="text-sm text-gray-500">of ${{ number_format($campaign->target_amount, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div>{{ $campaign->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $campaign->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.campaigns.show', $campaign) }}" 
                                       class="text-primary-600 hover:text-primary-900 transition-colors duration-200">
                                        <i data-lucide="eye" class="h-4 w-4"></i>
                                    </a>
                                    <a href="{{ route('admin.campaigns.edit', $campaign) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                        <i data-lucide="edit" class="h-4 w-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.campaigns.destroy', $campaign) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this campaign?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i data-lucide="target" class="mx-auto h-12 w-12 text-gray-400 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No campaigns found</h3>
                                    <p class="text-gray-500 mb-4">Get started by creating your first campaign.</p>
                                    <a href="{{ route('admin.campaigns.create') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200">
                                        <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                                        Create Campaign
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($campaigns->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $campaigns->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 