@extends('layouts.admin')

@section('page-title', 'Campaign Details')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000]">Goal Amount</h3>
                        <p class="text-2xl font-bold">{{ number_format($campaign->goal_amount, 0) }}</p>
                        <p class="text-xs text-[#fe5000]/70">{{ $campaign->currency }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000]">Raised Amount</h3>
                        <p class="text-2xl font-bold">{{ number_format($campaign->raised_amount, 0) }}</p>
                        <p class="text-xs text-[#fe5000]/70">{{ $campaign->currency }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000]">Progress</h3>
                        <p class="text-2xl font-bold">{{ $campaign->percentageReached() }}%</p>
                        <p class="text-xs text-[#fe5000]/70">Complete</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000]">Total Donations</h3>
                        <p class="text-2xl font-bold">{{ $totalDonations }}</p>
                        <p class="text-xs text-[#fe5000]/70">Contributions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Header -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-[#fe5000] to-orange-600 px-6 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-white bg-opacity-20 rounded-full p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $campaign->title }}</h1>
                        <p class="text-orange-100 mt-1">Created by {{ $campaign->creator->name }} on {{ $campaign->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-orange-100 text-sm">Campaign Progress</div>
                    <div class="text-white text-2xl font-bold">{{ $campaign->percentageReached() }}%</div>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.campaigns.edit', $campaign) }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Edit Campaign
                </a>
                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this campaign?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Campaign Details -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="md:col-span-2 space-y-6">
            <!-- Campaign Info -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="p-6">
                    @if($campaign->featured_image)
                        <div class="mb-6">
                            <img src="{{ asset('storage/' . $campaign->featured_image) }}" alt="{{ $campaign->title }}" class="w-full h-64 object-cover rounded-xl border border-gray-200">
                        </div>
                    @endif
                    
                    <div class="prose max-w-none">
                        <div class="mb-6">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 mb-4">
                                <h2 class="text-xl font-bold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Description
                                </h2>
                            </div>
                            <p class="text-gray-700 leading-relaxed">{{ $campaign->description }}</p>
                        </div>
                        
                        @if($campaign->content)
                            <div class="mb-6">
                                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-4 mb-4">
                                    <h2 class="text-xl font-bold text-white flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Detailed Content
                                    </h2>
                                </div>
                                <div class="text-gray-700 leading-relaxed">{{ $campaign->content }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Recent Donations -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-50 to-blue-50">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Recent Donations
                        </h3>
                        <a href="{{ route('admin.donations.index', ['campaign_id' => $campaign->id]) }}" 
                           class="text-sm font-medium text-[#fe5000] hover:text-orange-600 transition-colors duration-200">
                            View All Donations
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Donor</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentDonations as $donation)
                                <tr class="hover:bg-gradient-to-r hover:from-orange-50 hover:to-orange-100 transition-all duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                                    <span class="text-sm font-bold text-blue-600">{{ substr($donation->donor_name, 0, 1) }}</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900">{{ $donation->donor_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $donation->donor_email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">{{ number_format($donation->amount, 2) }} {{ $donation->currency }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold border-2
                                            @if($donation->payment_status === 'completed') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border-green-300
                                            @elseif($donation->payment_status === 'pending') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border-yellow-300
                                            @elseif($donation->payment_status === 'failed') bg-gradient-to-r from-red-100 to-red-200 text-red-800 border-red-300
                                            @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border-gray-300
                                            @endif">
                                            @if($donation->payment_status === 'completed')
                                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                            @endif
                                            {{ ucfirst($donation->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $donation->created_at->format('M d, Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12">
                                        <div class="text-center">
                                            <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <h3 class="mt-4 text-lg font-medium text-gray-900">No donations yet</h3>
                                            <p class="mt-2 text-sm text-gray-500">No donations found for this campaign.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Campaign Status -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-blue-50">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Campaign Status
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="text-center">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold border-2
                                @if($campaign->status === 'active') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border-green-300
                                @elseif($campaign->status === 'draft') bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border-gray-300
                                @elseif($campaign->status === 'completed') bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border-blue-300
                                @else bg-gradient-to-r from-red-100 to-red-200 text-red-800 border-red-300
                                @endif">
                                @if($campaign->status === 'active')
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                @endif
                                {{ ucfirst($campaign->status) }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm font-medium text-green-800">Start Date</p>
                                </div>
                                <p class="text-sm font-bold text-green-900 mt-1">{{ $campaign->start_date->format('M d, Y') }}</p>
                            </div>
                            
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-4 rounded-lg border border-red-200">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm font-medium text-red-800">End Date</p>
                                </div>
                                <p class="text-sm font-bold text-red-900 mt-1">{{ $campaign->end_date ? $campaign->end_date->format('M d, Y') : 'No end date' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Fundraising Progress -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-orange-50 to-yellow-50">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Fundraising Progress
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between mb-3">
                                <p class="text-sm font-bold text-gray-700">{{ $campaign->percentageReached() }}% Complete</p>
                                <p class="text-sm font-bold text-[#fe5000]">{{ number_format($campaign->raised_amount, 2) }} / {{ number_format($campaign->goal_amount, 2) }} {{ $campaign->currency }}</p>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                <div class="bg-gradient-to-r from-[#fe5000] to-orange-600 h-4 rounded-full transition-all duration-500" style="width: {{ $campaign->percentageReached() }}%"></div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200 text-center">
                                <p class="text-xs font-medium text-blue-600">Total Donations</p>
                                <p class="text-lg font-bold text-blue-800">{{ $totalDonations }}</p>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200 text-center">
                                <p class="text-xs font-medium text-purple-600">Average Donation</p>
                                <p class="text-lg font-bold text-purple-800">{{ number_format($averageDonation, 0) }}</p>
                                <p class="text-xs text-purple-600">{{ $campaign->currency }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 