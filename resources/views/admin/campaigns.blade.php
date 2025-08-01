@extends('layouts.admin')

@section('title', 'Campaigns Management - Admin Dashboard')
@section('page-title', 'Campaigns Management')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">All Campaigns</h3>
            <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                Create New Campaign
            </button>
        </div>
    </div>
    
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No campaigns yet</h3>
        <p class="mt-1 text-sm text-gray-500">Get started by creating your first campaign.</p>
        <div class="mt-6">
            <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-500 hover:bg-orange-600">
                <svg class="mr-2 -ml-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Create Campaign
            </button>
        </div>
    </div>
</div>
@endsection