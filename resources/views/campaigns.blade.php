@extends('layouts.master')

@section('title', __('app.campaigns') . ' - ' . __('app.site_title'))
@section('description', __('app.campaigns_description'))

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => __('app.our_campaigns'),
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'
            ],
            'title' => __('app.empowering_communities'),
            'subtitle' => __('app.through_trusted_giving'),
            'description' => __('app.campaigns_hero_description'),
            'highlights' => [
                ['text' => __('app.complete_transparency'), 'delay' => '0.6s'],
                ['text' => __('app.effective_impact'), 'delay' => '0.8s']
            ],
            'pills' => [
                ['text' => __('app.100_secure'), 'delay' => '0.7s'],
                ['text' => __('app.tax_deductible'), 'delay' => '0.8s'],
                ['text' => __('app.transparent_trusted'), 'delay' => '0.9s']
            ]
        ])



        <!-- Featured Campaigns Section -->
        <section id="campaigns" class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-8 gap-3">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ __('app.featured_campaigns') }}</h2>
                    <a href="{{ url('/all-campaigns') }}" class="text-primary-500 font-medium hover:text-primary-600 text-sm md:text-base">{{ __('app.view_all') }}</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @forelse($featuredCampaigns as $campaign)
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            @if($campaign->featured_image)
                                <img src="{{ asset('storage/' . $campaign->featured_image) }}" 
                                     alt="{{ $campaign->title }}" class="w-full h-40 md:h-48 object-cover">
                            @else
                                <div class="w-full h-40 md:h-48 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-4 md:p-6">
                                <div class="flex items-center mb-3">
                                    @if($campaign->partner && $campaign->partner->logo)
                                        <img src="{{ asset('storage/' . $campaign->partner->logo) }}"
                                             alt="{{ $campaign->partner->name }}" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3 object-cover">
                                    @else
                                        <div class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3 bg-primary-100 flex items-center justify-center">
                                            <svg class="w-3 h-3 md:w-4 md:h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="text-xs md:text-sm text-gray-600">
                                        {{ $campaign->partner ? $campaign->partner->name : ($campaign->organization_name ?: 'Organization') }}
                                    </span>
                                </div>
                                <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">{{ $campaign->title }}</h3>
                                <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed line-clamp-3">
                                    {{ $campaign->short_description ?: $campaign->description }}
                                </p>
                                <div class="mb-3 md:mb-4">
                                    @php
                                        $percentage = $campaign->goal_amount > 0 ? min(100, ($campaign->raised_amount / $campaign->goal_amount) * 100) : 0;
                                    @endphp
                                    <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                        <span>{{ __('app.amount_raised', ['amount' => 'RM ' . number_format($campaign->raised_amount, 0)]) }}</span>
                                        <span>{{ __('app.percent_of_goal', ['percent' => round($percentage), 'goal' => 'RM ' . number_format($campaign->goal_amount, 0)]) }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-primary-500 h-2 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs md:text-sm text-gray-500">{{ __('app.donor_count', ['count' => $campaign->donor_count]) }}</span>
                                    <a href="{{ route('donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                        {{ __('app.donate_now') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No featured campaigns</h3>
                            <p class="mt-1 text-sm text-gray-500">No featured campaigns are currently available.</p>
                        </div>
                    @endforelse
                </div>

                </div>
            </div>
        </section>

        <!-- Recent Campaigns Section -->
        @if($recentCampaigns->count() > 0)
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-8 gap-3">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ __('app.recent_campaigns') }}</h2>
                    <a href="{{ route('campaigns.all') }}" class="text-primary-500 font-medium hover:text-primary-600 text-sm md:text-base">{{ __('app.view_all') }}</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach($recentCampaigns as $campaign)
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            @if($campaign->featured_image)
                                <img src="{{ asset('storage/' . $campaign->featured_image) }}" 
                                     alt="{{ $campaign->title }}" class="w-full h-40 md:h-48 object-cover">
                            @else
                                <div class="w-full h-40 md:h-48 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-4 md:p-6">
                                <div class="flex items-center mb-3">
                                    @if($campaign->partner && $campaign->partner->logo)
                                        <img src="{{ asset('storage/' . $campaign->partner->logo) }}"
                                             alt="{{ $campaign->partner->name }}" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3 object-cover">
                                    @else
                                        <div class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3 bg-primary-100 flex items-center justify-center">
                                            <svg class="w-3 h-3 md:w-4 md:h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="text-xs md:text-sm text-gray-600">
                                        {{ $campaign->partner ? $campaign->partner->name : ($campaign->organization_name ?: 'Organization') }}
                                    </span>
                                </div>
                                <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">{{ $campaign->title }}</h3>
                                <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed line-clamp-3">
                                    {{ $campaign->short_description ?: $campaign->description }}
                                </p>
                                <div class="mb-3 md:mb-4">
                                    @php
                                        $percentage = $campaign->goal_amount > 0 ? min(100, ($campaign->raised_amount / $campaign->goal_amount) * 100) : 0;
                                    @endphp
                                    <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                        <span>{{ __('app.amount_raised', ['amount' => 'RM ' . number_format($campaign->raised_amount, 0)]) }}</span>
                                        <span>{{ __('app.percent_of_goal', ['percent' => round($percentage), 'goal' => 'RM ' . number_format($campaign->goal_amount, 0)]) }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-primary-500 h-2 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs md:text-sm text-gray-500">{{ __('app.donor_count', ['count' => $campaign->donor_count]) }}</span>
                                    <a href="{{ route('donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                        {{ __('app.donate_now') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- Successful Campaigns Section -->
        @if($successfulCampaigns->count() > 0)
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-8 gap-3">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ __('app.successful_campaigns') }}</h2>
                    <a href="{{ route('campaigns.all') }}" class="text-primary-500 font-medium hover:text-primary-600 text-sm md:text-base">{{ __('app.view_all') }}</a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($successfulCampaigns as $campaign)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:scale-[1.02] animate-fade-in-up">
                            <!-- Campaign Status Badge -->
                            <div class="relative">
                                <!-- Pills Buttons -->
                                <div class="absolute top-4 left-4 right-4 z-10 flex justify-start items-start">
                                    <div class="flex flex-wrap gap-2">
                                        <div class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                            VERIFIED
                                        </div>
                                        @php
                                            $percentage = $campaign->goal_amount > 0 ? min(100, ($campaign->raised_amount / $campaign->goal_amount) * 100) : 0;
                                        @endphp
                                        @if($campaign->isSuccessful())
                                            @if($percentage >= 100)
                                                <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                                    {{ __('app.goal_exceeded') }}
                                                </div>
                                            @else
                                                <div class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-medium">
                                                    {{ __('app.goal_achieved') }}
                                                </div>
                                            @endif
                                        @else
                                            <div class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-medium">
                                                {{ round($percentage) }}% {{ __('app.of_goal') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Campaign Image -->
                            <div class="relative">
                                @if($campaign->featured_image)
                                    <img src="{{ asset('storage/' . $campaign->featured_image) }}"
                                         alt="{{ $campaign->title }}" class="w-full h-56 object-cover">
                                @else
                                    <div class="w-full h-56 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="p-8">
                                <!-- Campaign Overview -->
                                <div class="mb-8">
                                    <h4 class="text-3xl font-bold text-gray-900 mb-4 animate-slide-in-left">{{ $campaign->title }}</h4>
                                    <p class="text-gray-600 leading-relaxed text-lg animate-slide-in-left delay-100">
                                        {{ $campaign->short_description ?: $campaign->description }}
                                    </p>

                                    <!-- Campaign Details -->
                                    <div class="mt-6 flex items-center space-x-6 text-sm text-gray-500 animate-slide-in-left delay-200">
                                        @if($campaign->hasEnded())
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 0v9m-4-9h8m-4 0V7"/>
                                                </svg>
                                                {{ __('app.campaign_ended') }}: {{ $campaign->end_date->format('M d, Y') }}
                                            </div>
                                        @elseif($campaign->isOngoing())
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                {{ __('app.days_remaining', ['days' => $campaign->days_remaining]) }}
                                            </div>
                                        @endif
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ __('app.campaign_duration', ['days' => $campaign->duration_days ?: 'N/A']) }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Impact Statistics -->
                                <div class="flex justify-between items-center mb-6 bg-gray-50 rounded-lg p-4">
                                    <div class="text-center group animate-scale-in delay-300">
                                        <div class="text-2xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300 animate-count-up">{{ number_format($campaign->raised_amount, 0) }}</div>
                                        <div class="text-xs text-gray-600">{{ __('app.amount_raised') }}</div>
                                    </div>
                                    <div class="text-center group animate-scale-in delay-400">
                                        <div class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 animate-count-up">{{ $campaign->donor_count }}</div>
                                    <div class="text-xs text-gray-600">{{ __('app.donors') }}</div>
                                </div>
                                <div class="text-center group animate-scale-in delay-500">
                                    <div class="text-2xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300 animate-count-up">10</div>
                                    <div class="text-xs text-gray-600">{{ __('app.days') }}</div>
                                </div>
                            </div>

                            <!-- Audit Trail Toggle -->
                            <div class="border-t border-gray-100 pt-6 mb-4">
                                <button onclick="toggleCampaignAudit('campaign-{{ $campaign->id }}')"
                                        class="flex items-center justify-between w-full text-left font-medium text-gray-700 hover:text-gray-900 transition-colors"
                                        id="campaign-{{ $campaign->id }}-audit-toggle">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        {{ __('app.view_campaign_timeline_audit_trail') }}
                                    </span>
                                    <svg class="w-5 h-5 transform transition-transform duration-200 text-gray-400" id="campaign-{{ $campaign->id }}-audit-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Audit Trail Content -->
                                <div id="campaign-{{ $campaign->id }}-audit-content" class="hidden mt-6 space-y-6">
                                    <!-- Campaign Timeline -->
                                    <div class="bg-gray-50 rounded-xl p-6">
                                        <h5 class="font-semibold text-gray-900 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ __('app.campaign_timeline') }}
                                        </h5>
                                        <div class="space-y-4">
                                            @if($campaign->auditTrails && $campaign->auditTrails->count() > 0)
                                                @foreach($campaign->auditTrails->take(5) as $audit)
                                                    <div class="flex items-start space-x-4">
                                                        <div class="w-3 h-3 bg-{{ $audit->action === 'created' ? 'emerald' : ($audit->action === 'donation_received' ? 'blue' : ($audit->action === 'milestone_reached' ? 'purple' : 'gray')) }}-500 rounded-full mt-2 flex-shrink-0"></div>
                                                        <div class="flex-1">
                                                            <div class="flex items-center justify-between mb-1">
                                                                <p class="font-medium text-gray-900">{{ $audit->action_label }}</p>
                                                                <span class="text-sm text-gray-500">{{ $audit->created_at->format('M d, Y') }}</span>
                                                            </div>
                                                            <p class="text-sm text-gray-600">{{ $audit->description }}</p>
                                                            @if($audit->performer)
                                                                <p class="text-xs text-gray-500 mt-1">By {{ $audit->performer->user->name ?? 'Unknown User' }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="text-center py-8">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                    </svg>
                                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No audit trail yet</h3>
                                                    <p class="mt-1 text-sm text-gray-500">Campaign activity will be logged here.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Organization and Actions -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ __('app.yayasan_ikhlas') }}</div>
                                    <div class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                        </svg>
                                        {{ __('app.verified_organization') }}
                                    </div>
                                    <div class="text-sm font-bold text-gray-900 mt-1">
                                        RM 85,000 <span class="text-xs text-gray-600 font-normal">{{ __('app.of_goal', ['goal' => 'RM 80,000']) }}</span>
                                    </div>
                                </div>
                                <div class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                    </svg>
                                    {{ __('app.campaign_completed') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif


            </div>
        </section>

        <!-- More Campaigns Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('app.more_campaigns') }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Small Campaign Card 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Healthcare" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">{{ __('app.mobile_health_clinic') }}</h4>
                            <p class="text-xs text-gray-600 mb-3">{{ __('app.bringing_healthcare_to_remote_villages') }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ __('app.amount') }}: RM 15,000</span>
                                <span class="text-xs text-primary-500 font-medium">{{ __('app.percent_completed', ['percent' => '67']) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small Campaign Card 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Education" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">{{ __('app.scholarship_program') }}</h4>
                            <p class="text-xs text-gray-600 mb-3">{{ __('app.supporting_underprivileged_students') }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ __('app.amount') }}: RM 22,000</span>
                                <span class="text-xs text-primary-500 font-medium">{{ __('app.percent_completed', ['percent' => '84']) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small Campaign Card 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1541544181051-e46607bc22a4?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Water" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">{{ __('app.water_purification_system') }}</h4>
                            <p class="text-xs text-gray-600 mb-3">{{ __('app.clean_water_for_500_families') }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ __('app.amount') }}: RM 35,000</span>
                                <span class="text-xs text-primary-500 font-medium">{{ __('app.percent_completed', ['percent' => '45']) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small Campaign Card 4 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Emergency" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">{{ __('app.disaster_relief_fund') }}</h4>
                            <p class="text-xs text-gray-600 mb-3">{{ __('app.emergency_aid_for_natural_disasters') }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ __('app.amount') }}: RM 50,000</span>
                                <span class="text-xs text-primary-500 font-medium">{{ __('app.percent_completed', ['percent' => '92']) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-20 bg-primary-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    {{ __('app.start_your_own_campaign') }}
                </h2>
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">
                    {{ __('app.join_community_changemakers') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        {{ __('app.start_campaign') }}
                    </a>
                    <a href="#" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-500 transition-colors">
                        {{ __('app.learn_more') }}
                    </a>
                </div>
            </div>
        </section>

@endsection

@push('styles')
<style>
    /* Animation Keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes countUp {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes pulseGentle {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.8;
        }
    }

    @keyframes pulse-button {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.4);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(249, 115, 22, 0);
        }
    }

    @keyframes ping {
        75%, 100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    /* Animation Classes */
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.6s ease-out forwards;
    }

    .animate-scale-in {
        animation: scaleIn 0.5s ease-out forwards;
    }

    .animate-count-up {
        animation: countUp 0.8s ease-out forwards;
    }

    .animate-pulse-gentle {
        animation: pulseGentle 2s ease-in-out infinite;
    }

    .animate-ping {
        animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    .animate-pulse-button {
        animation: pulse-button 2s infinite;
    }

    /* Delay Classes */
    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    .delay-400 {
        animation-delay: 0.4s;
    }

    .delay-500 {
        animation-delay: 0.5s;
    }

    /* Enhanced Hover Effects */
    .group:hover .animate-count-up {
        animation: countUp 0.3s ease-out forwards;
    }

    /* Card Hover Enhancements */
    .bg-white:hover {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    }

    /* Backdrop Blur Enhancement */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }

    /* Hover lift effect */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Campaign Audit Trail functionality
    window.toggleCampaignAudit = function(campaignId) {
        const content = document.getElementById(campaignId + '-audit-content');
        const arrow = document.getElementById(campaignId + '-audit-arrow');
        const toggle = document.getElementById(campaignId + '-audit-toggle');

        if (!content || !arrow) return;

        const isHidden = content.classList.contains('hidden');

        if (isHidden) {
            // Show audit trail
            content.classList.remove('hidden');
            arrow.style.transform = 'rotate(180deg)';
            toggle.classList.add('text-primary-600');

            // Animate content appearance
            content.style.opacity = '0';
            content.style.transform = 'translateY(-10px)';

            requestAnimationFrame(() => {
                content.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                content.style.opacity = '1';
                content.style.transform = 'translateY(0)';
            });
        } else {
            // Hide audit trail
            content.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            content.style.opacity = '0';
            content.style.transform = 'translateY(-10px)';

            setTimeout(() => {
                content.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
                toggle.classList.remove('text-primary-600');
            }, 300);
        }
    };

    // Add hover effects to campaign cards
    const campaignCards = document.querySelectorAll('.bg-gradient-to-br');
    campaignCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Animate statistics on scroll
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stats = entry.target.querySelectorAll('.text-2xl, .text-3xl');
                stats.forEach((stat, index) => {
                    setTimeout(() => {
                        stat.style.transform = 'scale(1.1)';
                        stat.style.transition = 'transform 0.3s ease';

                        setTimeout(() => {
                            stat.style.transform = 'scale(1)';
                        }, 300);
                    }, index * 100);
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe campaign cards for animation
    document.querySelectorAll('.bg-gradient-to-br').forEach(card => {
        observer.observe(card);
    });

    // Add subtle pulse animation to "COMPLETED" badges
    const completedBadges = document.querySelectorAll('.bg-emerald-100');
    completedBadges.forEach(badge => {
        setInterval(() => {
            const dot = badge.querySelector('.bg-emerald-500');
            if (dot) {
                dot.style.transform = 'scale(1.2)';
                dot.style.transition = 'transform 0.3s ease';
                setTimeout(() => {
                    dot.style.transform = 'scale(1)';
                }, 300);
            }
        }, 4000);
    });
});
</script>
@endpush
