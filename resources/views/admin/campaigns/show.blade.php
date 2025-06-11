@extends('layouts.admin')

@section('page-title', 'Campaign Details')

@section('content')
<div class="space-y-6">
    <!-- Campaign Header -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">{{ $campaign->title }}</h1>
                    <p class="mt-1 text-sm text-gray-500">Created by {{ $campaign->creator->name }} on {{ $campaign->created_at->format('M d, Y') }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        Edit Campaign
                    </a>
                    <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this campaign?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Campaign Details -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="md:col-span-2 space-y-6">
            <!-- Campaign Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($campaign->featured_image)
                        <div class="mb-6">
                            <img src="{{ asset('storage/' . $campaign->featured_image) }}" alt="{{ $campaign->title }}" class="w-full h-64 object-cover rounded-lg">
                        </div>
                    @endif
                    
                    <div class="prose max-w-none">
                        <h2 class="text-xl font-semibold mb-4">Description</h2>
                        <p>{{ $campaign->description }}</p>
                        
                        @if($campaign->content)
                            <h2 class="text-xl font-semibold mt-6 mb-4">Detailed Content</h2>
                            <div>{{ $campaign->content }}</div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Recent Donations -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 bg-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">Recent Donations</h3>
                        <a href="{{ route('admin.donations.index', ['campaign_id' => $campaign->id]) }}" class="text-sm text-orange-600 hover:text-orange-900">View All</a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentDonations as $donation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $donation->donor_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $donation->donor_email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ number_format($donation->amount, 2) }} {{ $donation->currency }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($donation->payment_status === 'completed') bg-green-100 text-green-800
                                            @elseif($donation->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($donation->payment_status === 'failed') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($donation->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $donation->created_at->format('M d, Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No donations found for this campaign.
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 bg-white">
                    <h3 class="text-lg font-medium text-gray-900">Campaign Status</h3>
                </div>
                <div class="p-6 bg-white">
                    <div class="space-y-4">
                        <div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($campaign->status === 'active') bg-green-100 text-green-800
                                @elseif($campaign->status === 'draft') bg-gray-100 text-gray-800
                                @elseif($campaign->status === 'completed') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($campaign->status) }}
                            </span>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500">Start Date</p>
                            <p class="text-sm font-medium">{{ $campaign->start_date->format('M d, Y') }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500">End Date</p>
                            <p class="text-sm font-medium">{{ $campaign->end_date ? $campaign->end_date->format('M d, Y') : 'No end date' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Fundraising Progress -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 bg-white">
                    <h3 class="text-lg font-medium text-gray-900">Fundraising Progress</h3>
                </div>
                <div class="p-6 bg-white">
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between">
                                <p class="text-sm font-medium text-gray-700">{{ $campaign->percentageReached() }}% Complete</p>
                                <p class="text-sm font-medium text-gray-700">{{ number_format($campaign->raised_amount, 2) }} / {{ number_format($campaign->goal_amount, 2) }} {{ $campaign->currency }}</p>
                            </div>
                            <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-orange-600 h-2.5 rounded-full" style="width: {{ $campaign->percentageReached() }}%"></div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div>
                                <p class="text-sm text-gray-500">Total Donations</p>
                                <p class="text-sm font-medium">{{ $totalDonations }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Average Donation</p>
                                <p class="text-sm font-medium">{{ number_format($averageDonation, 2) }} {{ $campaign->currency }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 