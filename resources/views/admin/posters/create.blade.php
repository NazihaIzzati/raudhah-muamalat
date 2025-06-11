@extends('layouts.admin')

@section('page-title', 'Create New Poster')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <form action="{{ route('admin.posters.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <!-- Header -->
        <div class="border-b border-gray-200 pb-5 mb-5">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Poster Information</h3>
            <p class="mt-1 text-sm text-gray-500">Create a new promotional poster.</p>
        </div>
        
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="rounded-md bg-red-50 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <!-- Title -->
            <div class="sm:col-span-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <div class="mt-1">
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <!-- Description -->
            <div class="sm:col-span-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div class="mt-1">
                    <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                </div>
                <p class="mt-2 text-sm text-gray-500">Brief description of the poster (optional).</p>
            </div>
            
            <!-- Poster Image -->
            <div class="sm:col-span-6">
                <label for="poster_image" class="block text-sm font-medium text-gray-700">Poster Image</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="poster_image" class="relative cursor-pointer bg-white rounded-md font-medium text-orange-600 hover:text-orange-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-orange-500">
                                <span>Upload a file</span>
                                <input id="poster_image" name="poster_image" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
            </div>
            
            <!-- Status -->
            <div class="sm:col-span-3">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <div class="mt-1">
                    <select id="status" name="status" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
            
            <!-- Campaign -->
            <div class="sm:col-span-3">
                <label for="campaign_id" class="block text-sm font-medium text-gray-700">Associated Campaign (Optional)</label>
                <div class="mt-1">
                    <select id="campaign_id" name="campaign_id" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        <option value="">No Campaign</option>
                        @foreach($campaigns as $campaign)
                            <option value="{{ $campaign->id }}" {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>{{ $campaign->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <!-- Display Order -->
            <div class="sm:col-span-2">
                <label for="display_order" class="block text-sm font-medium text-gray-700">Display Order</label>
                <div class="mt-1">
                    <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" min="0" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
                <p class="mt-2 text-sm text-gray-500">Lower numbers display first.</p>
            </div>
            
            <!-- Display Period -->
            <div class="sm:col-span-2">
                <label for="display_from" class="block text-sm font-medium text-gray-700">Display From</label>
                <div class="mt-1">
                    <input type="date" name="display_from" id="display_from" value="{{ old('display_from') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            
            <div class="sm:col-span-2">
                <label for="display_until" class="block text-sm font-medium text-gray-700">Display Until</label>
                <div class="mt-1">
                    <input type="date" name="display_until" id="display_until" value="{{ old('display_until') }}" class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="pt-5 mt-6 border-t border-gray-200">
            <div class="flex justify-end">
                <a href="{{ route('admin.posters.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Cancel
                </a>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Create Poster
                </button>
            </div>
        </div>
    </form>
</div>
@endsection 