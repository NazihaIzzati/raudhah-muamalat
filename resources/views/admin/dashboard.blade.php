@extends('layouts.admin')

@section('title', 'Admin Dashboard - Jariah Fund')
@section('page-title', 'Campaign Management')

@section('content')
<div class="space-y-8">
    <!-- Page Description -->
    <div class="max-w-3xl">
        <p class="text-base text-gray-500">Create, manage and track your marketing campaigns</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Active Campaigns -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-500">Active Campaigns</h3>
                <span class="text-orange-600 bg-orange-50 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    ↑ 20% from last month
                </span>
            </div>
            <div class="flex items-baseline">
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_campaigns'] ?? 12 }}</p>
            </div>
        </div>

        <!-- Total Reach -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-500">Total Reach</h3>
                <span class="text-orange-600 bg-orange-50 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    ↑ 15.3% from last month
                </span>
            </div>
            <div class="flex items-baseline">
                <p class="text-2xl font-semibold text-gray-900">1.2M</p>
            </div>
        </div>

        <!-- Engagement Rate -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-500">Engagement Rate</h3>
                <span class="text-orange-600 bg-orange-50 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    ↑ 0.5% from last month
                </span>
            </div>
            <div class="flex items-baseline">
                <p class="text-2xl font-semibold text-gray-900">4.8%</p>
            </div>
        </div>

        <!-- Conversion Rate -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-gray-500">Conversion Rate</h3>
                <span class="text-orange-600 bg-orange-50 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    ↑ 0.2% from last month
                </span>
            </div>
            <div class="flex items-baseline">
                <p class="text-2xl font-semibold text-gray-900">2.4%</p>
            </div>
        </div>
    </div>

    <!-- Campaign Performance -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Campaign Performance</h2>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-sm font-medium rounded-md bg-orange-50 text-orange-600">Last 7 days</button>
                    <button class="px-3 py-1 text-sm font-medium rounded-md text-gray-500 hover:bg-gray-50">Last 30 days</button>
                    <button class="px-3 py-1 text-sm font-medium rounded-md text-gray-500 hover:bg-gray-50">Last 90 days</button>
                    <button class="px-3 py-1 text-sm font-medium rounded-md text-gray-500 hover:bg-gray-50">This year</button>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Impressions</h4>
                    <p class="text-2xl font-semibold text-gray-900 mb-1">245.8K</p>
                    <span class="text-green-600 text-sm font-medium">↑ 12.4%</span>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Clicks</h4>
                    <p class="text-2xl font-semibold text-gray-900 mb-1">12.4K</p>
                    <span class="text-green-600 text-sm font-medium">↑ 8.2%</span>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">CTR</h4>
                    <p class="text-2xl font-semibold text-gray-900 mb-1">5.05%</p>
                    <span class="text-red-600 text-sm font-medium">↓ 0.3%</span>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">Conversions</h4>
                    <p class="text-2xl font-semibold text-gray-900 mb-1">587</p>
                    <span class="text-green-600 text-sm font-medium">↑ 15.7%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Campaign List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-lg font-semibold text-gray-900 truncate">All Campaigns</h2>
                </div>
                <div class="mt-4 sm:mt-0 sm:flex sm:items-center sm:space-x-4">
                    <div class="flex items-center space-x-4">
                        <button class="px-3 py-1 text-sm font-medium rounded-md bg-orange-50 text-orange-600">All Campaigns</button>
                        <button class="px-3 py-1 text-sm font-medium rounded-md text-gray-500 hover:bg-gray-50">Active</button>
                        <button class="px-3 py-1 text-sm font-medium rounded-md text-gray-500 hover:bg-gray-50">Scheduled</button>
                        <button class="px-3 py-1 text-sm font-medium rounded-md text-gray-500 hover:bg-gray-50">Completed</button>
                        <button class="px-3 py-1 text-sm font-medium rounded-md text-gray-500 hover:bg-gray-50">Drafts</button>
                    </div>
                    <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        Create Campaign
                    </button>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Campaign</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-medium text-gray-900">Summer Sale Newsletter</div>
                                <div class="text-sm text-gray-500">Email campaign for summer promotion</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Email</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-orange-500 rounded-full h-2" style="width: 75%"></div>
                                </div>
                                <span class="ml-2 text-sm text-gray-500">75%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">Jun 15 - Jun 30, 2023</div>
                            <div class="text-sm text-orange-600">5 days left</div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                            <a href="#" class="text-gray-500 hover:text-orange-600">View</a>
                            <a href="#" class="text-gray-500 hover:text-orange-600">Edit</a>
                            <a href="#" class="text-gray-500 hover:text-orange-600">Duplicate</a>
                            <a href="#" class="text-red-500 hover:text-red-700">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-medium text-gray-900">Product Launch - XYZ Pro</div>
                                <div class="text-sm text-gray-500">Social media campaign for new product</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Social</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Scheduled</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-orange-500 rounded-full h-2" style="width: 0%"></div>
                                </div>
                                <span class="ml-2 text-sm text-gray-500">0%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">Jul 10 - Aug 10, 2023</div>
                            <div class="text-sm text-gray-500">Starts in 15 days</div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                            <a href="#" class="text-gray-500 hover:text-orange-600">View</a>
                            <a href="#" class="text-gray-500 hover:text-orange-600">Edit</a>
                            <a href="#" class="text-gray-500 hover:text-orange-600">Duplicate</a>
                            <a href="#" class="text-red-500 hover:text-red-700">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Add your Chart.js initialization here if needed
</script>
@endpush