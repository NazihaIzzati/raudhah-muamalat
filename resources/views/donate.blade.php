@extends('layouts.master')

@section('title', 'Donate Now - Jariah Fund')
@section('description', 'Make a secure donation to support meaningful campaigns that create lasting impact in communities across Malaysia. Every donation makes a difference.')

@section('content')

        <!-- Hero Section -->
        <section class="py-20 bg-gradient-to-br from-primary-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-6">
                        <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">Secure Donation</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Make a Difference
                        <span class="text-primary-500 relative block">
                            Today
                            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200" viewBox="0 0 100 12" fill="currentColor">
                                <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                            </svg>
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed mb-8">
                        Support <strong>verified campaigns</strong> that make a real difference in communities worldwide.
                        Each donation is secured with <span class="text-primary-600 font-medium">complete transparency</span> and
                        <span class="text-primary-600 font-medium">effective impact</span>.
                    </p>
                </div>
            </div>
        </section>

        <!-- Campaign & Donation Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                    <!-- Campaign Information - Left Side -->
                    <div class="order-2 lg:order-1">
                        <!-- Campaign Image -->
                        <div class="relative mb-8">
                            <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                 alt="Emergency Food Relief for Gaza Families"
                                 class="w-full h-80 object-cover rounded-xl">

                            <!-- Overlay Content -->
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent rounded-xl flex items-end">
                                <div class="p-8 text-white w-full">
                                    <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                                        <span class="text-white font-medium text-sm">Featured Campaign</span>
                                    </div>
                                    <h1 class="text-3xl font-bold mb-2">
                                        Emergency Food Relief for Gaza Families
                                    </h1>
                                    <p class="text-white/90 text-base">
                                        Provide essential food packages to families in need
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Indicator -->
                        <div class="bg-white rounded-xl p-6 mb-8 border border-gray-100">
                            <div class="flex justify-between items-baseline mb-4">
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">RM 45,230</div>
                                    <div class="text-sm text-gray-500">raised of RM 62,000 goal</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-semibold text-primary-600">73%</div>
                                    <div class="text-sm text-gray-500">funded</div>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                <div style="background-color: #FE5000; width: 73%;" class="h-2 rounded-full transition-all duration-1000"></div>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <div class="flex items-center">
                                    @include('components.uxwing-icon', ['name' => 'people', 'class' => 'w-4 h-4 mr-2'])
                                    <span>234 donors</span>
                                </div>
                                <div>15 days left</div>
                            </div>
                        </div>

                        <!-- Campaign Content -->
                        <div class="bg-white rounded-xl border border-gray-100 p-8">
                            <!-- Organization Info -->
                            <div class="flex items-center mb-8 pb-6 border-b border-gray-100">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4 bg-primary-50">
                                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Yayasan Muslimin</h3>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 mr-3">Verified Islamic Foundation</span>
                                        <div class="flex items-center px-2 py-1 bg-green-50 rounded-full">
                                            <svg class="w-3 h-3 text-green-600 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <span class="text-xs font-medium text-green-700">Verified</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Campaign Title -->
                            <h1 class="text-2xl font-bold text-gray-900 mb-6 leading-tight">
                                Emergency Food Relief for Gaza Families
                            </h1>

                            <!-- Campaign Description -->
                            <div class="space-y-6">
                                <p class="text-gray-600 leading-relaxed">
                                    Provide essential food packages to families in Gaza who are facing severe food shortages. Each package feeds a family of 6 for one month and includes rice, flour, oil, lentils, and other nutritious staples.
                                </p>

                                <!-- Quranic Quote -->
                                <div class="p-6 bg-primary-50 rounded-xl border-l-4 border-primary-500">
                                    <blockquote class="text-gray-800 font-medium mb-2">
                                        "And whoever saves a life, it is as if he has saved all of mankind."
                                    </blockquote>
                                    <cite class="text-gray-600 text-sm">— Quran 5:32</cite>
                                </div>

                                <!-- Key Benefits -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Why Support This Campaign?</h3>
                                    <div class="space-y-3">
                                        <div class="flex items-start space-x-3">
                                            <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900 text-sm">Immediate Impact</h4>
                                                <p class="text-gray-600 text-sm">Food packages are distributed directly to families in urgent need.</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start space-x-3">
                                            <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900 text-sm">Verified Distribution</h4>
                                                <p class="text-gray-600 text-sm">All distributions are verified and documented for transparency.</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start space-x-3">
                                            <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900 text-sm">Life-Saving Support</h4>
                                                <p class="text-gray-600 text-sm">Your donation helps prevent malnutrition and saves lives.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Share Section -->
                            <div class="border-t border-gray-100 pt-6 mt-8">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-1">Share this campaign</h4>
                                        <p class="text-sm text-gray-600">Help us reach more people</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick="shareOnFacebook()" class="w-9 h-9 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center transition-colors" title="Share on Facebook">
                                            @include('components.uxwing-icon', ['name' => 'facebook', 'class' => 'w-4 h-4'])
                                        </button>
                                        <button onclick="shareOnTwitter()" class="w-9 h-9 bg-black hover:bg-gray-800 text-white rounded-lg flex items-center justify-center transition-colors" title="Share on X">
                                            @include('components.uxwing-icon', ['name' => 'twitter', 'class' => 'w-4 h-4'])
                                        </button>
                                        <button onclick="shareOnWhatsApp()" class="w-9 h-9 bg-green-500 hover:bg-green-600 text-white rounded-lg flex items-center justify-center transition-colors" title="Share on WhatsApp">
                                            @include('components.uxwing-icon', ['name' => 'whatsapp', 'class' => 'w-4 h-4'])
                                        </button>
                                        <button onclick="copyLink()" class="w-9 h-9 bg-gray-500 hover:bg-gray-600 text-white rounded-lg flex items-center justify-center transition-colors" title="Copy Link">
                                            @include('components.uxwing-icon', ['name' => 'copy-link', 'class' => 'w-4 h-4'])
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donation Form - Right Side -->
                    <div class="order-1 lg:order-2">
                        <div class="bg-white rounded-xl border border-gray-200 sticky top-6">
                            <!-- Form Header -->
                            <div class="px-8 py-6 border-b border-gray-100">
                                <h2 class="text-xl font-semibold text-gray-900 mb-2">Make Your Donation</h2>
                                <p class="text-gray-600">Every contribution makes a difference</p>
                            </div>

                            <!-- Professional Form -->
                            <div class="px-8 py-8">
                                <form action="#" method="POST" class="space-y-8" onsubmit="return handleDonationSubmit(event)">
                                    @csrf
                                    <input type="hidden" name="campaign_id" value="1">
                                    <input type="hidden" name="donation_type" id="donation-type-input" value="single">

                                    <!-- Donation Type -->
                                    <div>
                                        <label class="block text-base font-medium text-gray-900 mb-4">Donation Type</label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button type="button" id="single-btn" class="py-3 px-4 border-2 border-primary-500 bg-primary-500 text-white rounded-lg text-sm font-medium transition-colors hover:bg-primary-600 hover:border-primary-600">
                                                One-Time
                                            </button>
                                            <button type="button" id="monthly-btn" class="py-3 px-4 border-2 border-gray-200 bg-white text-gray-700 rounded-lg text-sm font-medium transition-colors hover:border-gray-300 hover:bg-gray-50">
                                                Monthly
                                            </button>
                                        </div>
                                    </div>



                                    <!-- Amount Selection -->
                                    <div>
                                        <label class="block text-base font-medium text-gray-900 mb-4">Select Amount (MYR)</label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <label class="cursor-pointer amount-option">
                                                <input type="radio" name="amount" value="50" class="sr-only">
                                                <div class="amount-button border-2 border-gray-200 py-4 px-4 rounded-lg text-center transition-colors hover:border-primary-300 hover:bg-primary-50">
                                                    <div class="text-lg font-semibold text-gray-900">RM 50</div>
                                                </div>
                                            </label>
                                            <label class="cursor-pointer amount-option">
                                                <input type="radio" name="amount" value="150" class="sr-only">
                                                <div class="amount-button border-2 border-gray-200 py-4 px-4 rounded-lg text-center transition-colors hover:border-primary-300 hover:bg-primary-50">
                                                    <div class="text-lg font-semibold text-gray-900">RM 150</div>
                                                </div>
                                            </label>
                                            <label class="cursor-pointer amount-option">
                                                <input type="radio" name="amount" value="250" class="sr-only" checked>
                                                <div class="amount-button border-2 border-primary-500 bg-primary-500 py-4 px-4 rounded-lg text-center transition-colors">
                                                    <div class="text-lg font-semibold text-white">RM 250</div>
                                                </div>
                                            </label>
                                            <label class="cursor-pointer amount-option">
                                                <input type="radio" name="amount" value="500" class="sr-only">
                                                <div class="amount-button border-2 border-gray-200 py-4 px-4 rounded-lg text-center transition-colors hover:border-primary-300 hover:bg-primary-50">
                                                    <div class="text-lg font-semibold text-gray-900">RM 500</div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Custom Amount -->
                                    <div>
                                        <label class="block text-base font-medium text-gray-900 mb-4">Custom Amount</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <span class="text-sm font-medium text-gray-500">MYR</span>
                                            </div>
                                            <input type="number" name="custom_amount" id="custom-amount" placeholder="Enter amount" min="1" step="1"
                                                   class="w-full pl-16 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                    </div>

                                    <!-- Payment Methods -->
                                    <div>
                                        <label class="block text-base font-medium text-gray-900 mb-4">Payment Method</label>
                                        <div class="space-y-3">
                                            <!-- FPX Option -->
                                            <label class="cursor-pointer payment-option">
                                                <input type="radio" name="payment_method" value="fpx" class="sr-only" checked>
                                                <div class="payment-card flex items-center p-4 border-2 border-primary-500 bg-primary-50 rounded-lg transition-colors">
                                                    <div class="w-10 h-8 bg-blue-600 rounded text-white text-xs flex items-center justify-center font-semibold mr-4">FPX</div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-900">FPX Online Banking</div>
                                                        <div class="text-sm text-gray-600">Direct bank transfer</div>
                                                    </div>
                                                    <div class="w-5 h-5 border-2 border-primary-500 rounded-full flex items-center justify-center">
                                                        <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                                                    </div>
                                                </div>
                                            </label>

                                            <!-- DuitNow QR Option -->
                                            <label class="cursor-pointer payment-option">
                                                <input type="radio" name="payment_method" value="duitnow_qr" class="sr-only">
                                                <div class="payment-card flex items-center p-4 border-2 border-gray-200 rounded-lg transition-colors hover:border-gray-300">
                                                    <div class="w-10 h-8 bg-green-600 rounded text-white text-xs flex items-center justify-center font-semibold mr-4">QR</div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-900">DuitNow QR</div>
                                                        <div class="text-sm text-gray-600">Scan with banking app</div>
                                                    </div>
                                                    <div class="payment-radio w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                                        <div class="w-2 h-2 bg-primary-500 rounded-full" style="display: none;"></div>
                                                    </div>
                                                </div>
                                            </label>

                                            <!-- Credit/Debit Card Option -->
                                            <label class="cursor-pointer payment-option">
                                                <input type="radio" name="payment_method" value="card" class="sr-only">
                                                <div class="payment-card flex items-center p-4 border-2 border-gray-200 rounded-lg transition-colors hover:border-gray-300">
                                                    <div class="flex space-x-1 mr-4">
                                                        <div class="w-6 h-4 bg-blue-700 rounded text-white text-xs flex items-center justify-center font-semibold">V</div>
                                                        <div class="w-6 h-4 bg-red-500 rounded text-white text-xs flex items-center justify-center font-semibold">M</div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-900">Credit/Debit Card</div>
                                                        <div class="text-sm text-gray-600">Visa, Mastercard</div>
                                                    </div>
                                                    <div class="payment-radio w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                                        <div class="w-2 h-2 bg-primary-500 rounded-full" style="display: none;"></div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Donate Button -->
                                    <div class="pt-8 border-t border-gray-100">
                                        <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white py-4 px-6 rounded-lg text-lg font-semibold transition-colors">
                                            Donate Now
                                        </button>

                                        <!-- Trust Indicators -->
                                        <div class="mt-6 text-center">
                                            <div class="flex items-center justify-center text-sm text-gray-600 mb-4">
                                                @include('components.uxwing-icon', ['name' => 'security', 'class' => 'w-4 h-4 text-green-600 mr-2'])
                                                <span>Secure & encrypted payment</span>
                                            </div>
                                            <div class="flex justify-center gap-6 text-xs text-gray-500">
                                                <div class="flex items-center">
                                                    <span class="mr-1">🔒</span>
                                                    <span>SSL Secured</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="mr-1">⚡</span>
                                                    <span>Instant</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="mr-1">🏆</span>
                                                    <span>Tax Receipt</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>





@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle buttons functionality
    const singleBtn = document.getElementById('single-btn');
    const monthlyBtn = document.getElementById('monthly-btn');
    const donationTypeInput = document.getElementById('donation-type-input');

    function setActiveButton(activeBtn, inactiveBtn, type) {
        // Reset buttons
        activeBtn.classList.remove('text-gray-700', 'bg-white', 'border-gray-200');
        activeBtn.classList.add('text-white', 'border-primary-500', 'bg-primary-500');

        inactiveBtn.classList.remove('text-white', 'border-primary-500', 'bg-primary-500');
        inactiveBtn.classList.add('text-gray-700', 'bg-white', 'border-gray-200');

        // Update hidden input
        if (donationTypeInput) {
            donationTypeInput.value = type;
        }
    }

    // Button events
    if (singleBtn && monthlyBtn) {
        singleBtn.addEventListener('click', function() {
            setActiveButton(singleBtn, monthlyBtn, 'single');
        });

        monthlyBtn.addEventListener('click', function() {
            setActiveButton(monthlyBtn, singleBtn, 'monthly');
        });
    }

    // Amount selection functionality
    const amountInputs = document.querySelectorAll('input[name="amount"]');
    const customAmountInput = document.getElementById('custom-amount');

    // Handle amount selection
    amountInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Clear custom amount when radio button is selected
            if (customAmountInput) {
                customAmountInput.value = '';
            }

            // Update visual state for all amount buttons
            amountInputs.forEach(otherInput => {
                const button = otherInput.closest('label').querySelector('.amount-button');
                const textElement = button.querySelector('div');
                if (otherInput === this) {
                    // Selected state
                    button.classList.remove('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
                    button.classList.add('border-primary-500', 'bg-primary-500');
                    textElement.classList.remove('text-gray-900');
                    textElement.classList.add('text-white');
                } else {
                    // Unselected state
                    button.classList.remove('border-primary-500', 'bg-primary-500');
                    button.classList.add('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
                    textElement.classList.remove('text-white');
                    textElement.classList.add('text-gray-900');
                }
            });
        });
    });

    // Handle custom amount input
    if (customAmountInput) {
        customAmountInput.addEventListener('input', function() {
            if (this.value) {
                // Clear amount radio selections when custom amount is entered
                amountInputs.forEach(input => {
                    input.checked = false;
                    const button = input.closest('label').querySelector('.amount-button');
                    const textElement = button.querySelector('div');
                    button.classList.remove('border-primary-500', 'bg-primary-500');
                    button.classList.add('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
                    textElement.classList.remove('text-white');
                    textElement.classList.add('text-gray-900');
                });
            }
        });
    }

    // Handle payment method selection
    const paymentInputs = document.querySelectorAll('input[name="payment_method"]');
    paymentInputs.forEach(input => {
        input.addEventListener('change', function() {
            paymentInputs.forEach(otherInput => {
                const card = otherInput.closest('label').querySelector('.payment-card');
                const radio = otherInput.closest('label').querySelector('.payment-radio');
                const radioInner = radio ? radio.querySelector('div') : null;

                if (otherInput === this) {
                    // Selected state
                    card.classList.remove('border-gray-200', 'hover:border-gray-300');
                    card.classList.add('border-primary-500', 'bg-primary-50');
                    if (radio) {
                        radio.classList.remove('border-gray-300');
                        radio.classList.add('border-primary-500');
                        // Show inner dot
                        if (radioInner) {
                            radioInner.style.display = 'block';
                        }
                    }
                } else {
                    // Unselected state
                    card.classList.remove('border-primary-500', 'bg-primary-50');
                    card.classList.add('border-gray-200', 'hover:border-gray-300');
                    if (radio) {
                        radio.classList.remove('border-primary-500');
                        radio.classList.add('border-gray-300');
                        // Hide inner dot
                        if (radioInner) {
                            radioInner.style.display = 'none';
                        }
                    }
                }
            });
        });
    });

    // Form validation and submission handler
    window.handleDonationSubmit = function(e) {
        e.preventDefault();

        const selectedAmount = document.querySelector('input[name="amount"]:checked');
        const customAmount = customAmountInput ? customAmountInput.value : '';
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked');

        // Validate amount
        if (!selectedAmount && !customAmount) {
            showNotification('Please select or enter a donation amount.', 'error');
            return false;
        }

        if (customAmount && parseFloat(customAmount) < 1) {
            showNotification('Please enter a valid donation amount (minimum RM 1).', 'error');
            return false;
        }

        // Validate payment method
        if (!selectedPayment) {
            showNotification('Please select a payment method.', 'error');
            return false;
        }

        // Get donation details
        const amount = selectedAmount ? selectedAmount.value : customAmount;
        const donationType = donationTypeInput ? donationTypeInput.value : 'single';
        const paymentMethod = selectedPayment.value;

        // Show success message
        showNotification(`Thank you! Your ${donationType} donation of RM ${amount} via ${getPaymentMethodName(paymentMethod)} has been processed successfully.`, 'success');

        // Reset form after successful submission
        setTimeout(() => {
            document.querySelector('form').reset();
            // Reset visual states
            resetFormStates();
        }, 2000);

        return false;
    };

    function getPaymentMethodName(method) {
        switch(method) {
            case 'fpx': return 'FPX Online Banking';
            case 'duitnow_qr': return 'DuitNow QR';
            case 'card': return 'Credit/Debit Card';
            default: return method;
        }
    }

    function resetFormStates() {
        // Reset donation type buttons
        if (singleBtn && monthlyBtn) {
            setActiveButton(singleBtn, monthlyBtn, 'single');
        }

        // Reset amount buttons
        amountInputs.forEach(input => {
            const button = input.closest('label').querySelector('.amount-button');
            const textElement = button.querySelector('div');
            button.classList.remove('border-primary-500', 'bg-primary-500');
            button.classList.add('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
            textElement.classList.remove('text-white');
            textElement.classList.add('text-gray-900');
        });

        // Reset payment method buttons
        const paymentInputs = document.querySelectorAll('input[name="payment_method"]');
        paymentInputs.forEach(input => {
            const card = input.closest('label').querySelector('.payment-card');
            const radio = input.closest('label').querySelector('.payment-radio');
            const radioInner = radio ? radio.querySelector('div') : null;

            if (input.value === 'fpx') {
                // Set FPX as default
                input.checked = true;
                card.classList.add('border-primary-500', 'bg-primary-50');
                if (radio) {
                    radio.classList.add('border-primary-500');
                    if (radioInner) radioInner.style.display = 'block';
                }
            } else {
                card.classList.remove('border-primary-500', 'bg-primary-50');
                card.classList.add('border-gray-200', 'hover:border-gray-300');
                if (radio) {
                    radio.classList.remove('border-primary-500');
                    radio.classList.add('border-gray-300');
                    if (radioInner) radioInner.style.display = 'none';
                }
            }
        });
    }

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.textContent = message;

        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-4 rounded-lg shadow-lg z-50 transition-all duration-300 max-w-md`;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, type === 'success' ? 4000 : 3000);
    }

    // Accessibility improvements
    const amountLabels = document.querySelectorAll('label[class*="cursor-pointer"]');
    amountLabels.forEach(label => {
        label.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const input = this.querySelector('input');
                if (input) {
                    input.checked = true;
                    input.dispatchEvent(new Event('change'));
                }
            }
        });

        // Make labels focusable
        label.setAttribute('tabindex', '0');
    });

    // Social Media Share Functions
    window.shareOnFacebook = function() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent('Emergency Food Relief for Gaza Families');
        const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    };

    window.shareOnTwitter = function() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('Help provide emergency food relief for Gaza families! Every donation saves lives and provides essential nutrition.');
        const shareUrl = `https://twitter.com/intent/tweet?text=${text}&url=${url}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    };

    window.shareOnWhatsApp = function() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('🍽️ Help provide emergency food relief for Gaza families!\n\nEmergency Food Relief for Gaza Families\n\nEvery donation provides essential food packages to families in urgent need. Join us in this life-saving mission.');
        const shareUrl = `https://wa.me/?text=${text}%20${url}`;
        window.open(shareUrl, '_blank');
    };

    window.shareOnTelegram = function() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('🍽️ Help provide emergency food relief for Gaza families!\n\nEmergency Food Relief for Gaza Families');
        const shareUrl = `https://t.me/share/url?url=${url}&text=${text}`;
        window.open(shareUrl, '_blank');
    };

    window.copyLink = function() {
        const url = window.location.href;

        if (navigator.clipboard && window.isSecureContext) {
            // Use modern clipboard API
            navigator.clipboard.writeText(url).then(function() {
                showCopyNotification('Link copied to clipboard!');
            }).catch(function() {
                fallbackCopyTextToClipboard(url);
            });
        } else {
            // Fallback for older browsers
            fallbackCopyTextToClipboard(url);
        }
    };

    function fallbackCopyTextToClipboard(text) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
            showCopyNotification('Link copied to clipboard!');
        } catch (err) {
            showCopyNotification('Failed to copy link');
        }

        document.body.removeChild(textArea);
    }

    function showCopyNotification(message) {
        showNotification(message, 'success');
    }
});
</script>
@endpush
