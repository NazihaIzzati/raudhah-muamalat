@extends('layouts.admin')

@section('title', $event->title . ' - Event Details')
@section('page-title', 'Event Details')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <!-- Header Section -->
    <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between space-y-4 md:space-y-0">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    @if($event->featured_image)
                        <img src="{{ asset('storage/' . $event->featured_image) }}" alt="{{ $event->title }}" class="h-20 w-20 rounded-lg object-cover border-2 border-[#fe5000]/20 shadow-sm">
                    @else
                        <div class="h-20 w-20 rounded-lg bg-[#fe5000]/10 flex items-center justify-center border-2 border-[#fe5000]/20 shadow-sm">
                            <svg class="h-10 w-10 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 012 0v4h4V3a1 1 0 012 0v4h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h2z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div>
                    <div class="flex items-center space-x-3 mb-2">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $event->title }}</h1>
                        @if($event->is_featured)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Featured Event
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                            @if($event->status === 'published') bg-green-100 text-green-800
                            @elseif($event->status === 'ongoing') bg-blue-100 text-blue-800
                            @elseif($event->status === 'completed') bg-gray-100 text-gray-800
                            @elseif($event->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ ucfirst($event->status) }}
                        </span>
                        @if($event->category)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst($event->category) }}
                            </span>
                        @endif
                        <span>Created by {{ $event->creator->name }}</span>
                        <span>{{ $event->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                <a href="{{ route('admin.events.edit', $event) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#fe5000] hover:bg-[#fe5000]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-colors duration-200">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Event
                </a>
                <a href="{{ route('admin.events.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-colors duration-200">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Events
                </a>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Event Description -->
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex items-center mb-4">
                        <svg class="h-6 w-6 text-[#fe5000] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">Description</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">{{ $event->description }}</p>
                </div>

                <!-- Event Content -->
                @if($event->content)
                    <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                        <div class="flex items-center mb-4">
                            <svg class="h-6 w-6 text-[#fe5000] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900">Detailed Information</h3>
                        </div>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($event->content)) !!}
                        </div>
                    </div>
                @endif

                <!-- Contact Information -->
                @if($event->contact_info)
                    <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                        <div class="flex items-center mb-4">
                            <svg class="h-6 w-6 text-[#fe5000] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                        </div>
                        <div class="space-y-2">
                            @if(isset($event->contact_info['phone']))
                                <div class="flex items-center text-gray-700">
                                    <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span>{{ $event->contact_info['phone'] }}</span>
                                </div>
                            @endif
                            @if(isset($event->contact_info['email']))
                                <div class="flex items-center text-gray-700">
                                    <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $event->contact_info['email'] }}</span>
                                </div>
                            @endif
                            @if(isset($event->contact_info['website']))
                                <div class="flex items-center text-gray-700">
                                    <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                    <a href="{{ $event->contact_info['website'] }}" target="_blank" class="text-[#fe5000] hover:text-[#fe5000]/80">{{ $event->contact_info['website'] }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Social Links -->
                @if($event->social_links)
                    <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                        <div class="flex items-center mb-4">
                            <svg class="h-6 w-6 text-[#fe5000] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-9 0a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V6a2 2 0 00-2-2"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900">Social Media</h3>
                        </div>
                        <div class="flex space-x-4">
                            @if(isset($event->social_links['facebook']))
                                <a href="{{ $event->social_links['facebook'] }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                            @endif
                            @if(isset($event->social_links['twitter']))
                                <a href="{{ $event->social_links['twitter'] }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                                    <span class="sr-only">Twitter</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                            @endif
                            @if(isset($event->social_links['instagram']))
                                <a href="{{ $event->social_links['instagram'] }}" target="_blank" class="text-pink-600 hover:text-pink-800">
                                    <span class="sr-only">Instagram</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.297-3.323C5.902 8.198 7.053 7.708 8.35 7.708s2.448.49 3.323 1.297c.897.875 1.387 2.026 1.387 3.323s-.49 2.448-1.297 3.323c-.875.897-2.026 1.387-3.323 1.387z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Event Details Card -->
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex items-center mb-4">
                        <svg class="h-6 w-6 text-[#fe5000] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">Event Details</h3>
                    </div>
                    <div class="space-y-4">
                        <!-- Date & Time -->
                        <div>
                            <div class="flex items-center text-sm text-gray-500 mb-1">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 012 0v4h4V3a1 1 0 012 0v4h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h2z"></path>
                                </svg>
                                Date
                            </div>
                            <div class="font-medium text-gray-900">{{ $event->date_range }}</div>
                            @if($event->time_range)
                                <div class="text-sm text-gray-600">{{ $event->time_range }}</div>
                            @endif
                        </div>

                        <!-- Location -->
                        <div>
                            <div class="flex items-center text-sm text-gray-500 mb-1">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Location
                            </div>
                            <div class="font-medium text-gray-900">{{ $event->location }}</div>
                            @if($event->address)
                                <div class="text-sm text-gray-600">{{ $event->address }}</div>
                            @endif
                        </div>

                        <!-- Registration -->
                        @if($event->registration_required)
                            <div>
                                <div class="flex items-center text-sm text-gray-500 mb-1">
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    Registration
                                </div>
                                @if($event->max_participants)
                                    <div class="font-medium text-gray-900">{{ $event->registered_participants }}/{{ $event->max_participants }} participants</div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                        <div class="bg-[#fe5000] h-2 rounded-full" style="width: {{ $event->registrationPercentage() }}%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $event->availableSpots() }} spots remaining</div>
                                @else
                                    <div class="font-medium text-gray-900">{{ $event->registered_participants }} participants</div>
                                    <div class="text-sm text-gray-600">No participant limit</div>
                                @endif
                                
                                @if($event->registration_fee > 0)
                                    <div class="text-sm text-gray-600 mt-1">
                                        Registration Fee: {{ $event->currency }} {{ number_format($event->registration_fee, 2) }}
                                    </div>
                                @else
                                    <div class="text-sm text-green-600 mt-1">Free Registration</div>
                                @endif

                                @if($event->registration_deadline)
                                    <div class="text-sm text-gray-600 mt-1">
                                        Deadline: {{ $event->registration_deadline->format('M d, Y g:i A') }}
                                    </div>
                                @endif
                            </div>
                        @else
                            <div>
                                <div class="flex items-center text-sm text-gray-500 mb-1">
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    Registration
                                </div>
                                <div class="font-medium text-gray-900">No registration required</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Event Statistics -->
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex items-center mb-4">
                        <svg class="h-6 w-6 text-[#fe5000] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">Statistics</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Created</span>
                            <span class="text-sm font-medium text-gray-900">{{ $event->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Last Updated</span>
                            <span class="text-sm font-medium text-gray-900">{{ $event->updated_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Event ID</span>
                            <span class="text-sm font-medium text-gray-900">#{{ $event->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Slug</span>
                            <span class="text-sm font-medium text-gray-900">{{ $event->slug }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 