<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Donate Now - Jariah Fund</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Fallback styles */
                body { font-family: 'Instrument Sans', sans-serif; }
            </style>
        @endif
    </head>
    <body class="bg-gray-50 text-gray-900 font-sans">
        @include('components.navigation')

        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-primary-50 to-white py-12 md:py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 md:mb-6">
                        Make a <span class="text-primary-500">Donation</span>
                    </h1>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-6 md:mb-8">
                        Your generosity helps us create lasting impact in communities across Malaysia. Every donation, no matter the size, makes a meaningful difference in someone's life.
                    </p>
                    <div class="flex items-center justify-center space-x-6 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Secure & Safe</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Tax Deductible</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                            <span>100% Transparent</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Donation Form Section -->
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-8 md:p-12">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Choose Your Donation Amount</h2>
                            <p class="text-gray-600">Select an amount below or enter a custom amount</p>
                        </div>

                        <form action="#" method="POST" class="space-y-8">
                            @csrf

                            <!-- Quick Amount Selection -->
                            <div>
                                <label class="block text-lg font-semibold text-gray-900 mb-4">Select Amount</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="amount" value="50" class="sr-only peer">
                                        <div class="border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 p-6 rounded-xl text-center transition-all duration-300 hover:border-primary-300">
                                            <div class="text-2xl font-bold text-primary-600">RM 50</div>
                                            <div class="text-sm text-gray-600 mt-1">Basic Support</div>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="amount" value="100" class="sr-only peer">
                                        <div class="border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 p-6 rounded-xl text-center transition-all duration-300 hover:border-primary-300">
                                            <div class="text-2xl font-bold text-primary-600">RM 100</div>
                                            <div class="text-sm text-gray-600 mt-1">Standard</div>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="amount" value="250" class="sr-only peer">
                                        <div class="border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 p-6 rounded-xl text-center transition-all duration-300 hover:border-primary-300">
                                            <div class="text-2xl font-bold text-primary-600">RM 250</div>
                                            <div class="text-sm text-gray-600 mt-1">Generous</div>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="amount" value="500" class="sr-only peer">
                                        <div class="border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 p-6 rounded-xl text-center transition-all duration-300 hover:border-primary-300">
                                            <div class="text-2xl font-bold text-primary-600">RM 500</div>
                                            <div class="text-sm text-gray-600 mt-1">Impactful</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Custom Amount -->
                            <div>
                                <label for="custom-amount" class="block text-lg font-semibold text-gray-900 mb-4">Or Enter Custom Amount</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-lg font-medium">RM</span>
                                    <input type="number" id="custom-amount" name="custom_amount" placeholder="0.00" min="10"
                                           class="w-full pl-12 pr-4 py-4 text-lg border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Minimum donation amount is RM 10</p>
                            </div>

                            <!-- Donation Type -->
                            <div>
                                <label class="block text-lg font-semibold text-gray-900 mb-4">Donation Frequency</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="donation_type" value="one_time" checked class="sr-only peer">
                                        <div class="border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 p-4 rounded-xl transition-all duration-300">
                                            <div class="flex items-center">
                                                <div class="w-4 h-4 border-2 border-gray-300 peer-checked:border-primary-500 rounded-full mr-3 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-primary-500 rounded-full opacity-0 peer-checked:opacity-100"></div>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">One-time Donation</div>
                                                    <div class="text-sm text-gray-600">Make a single donation today</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="donation_type" value="monthly" class="sr-only peer">
                                        <div class="border-2 border-gray-200 peer-checked:border-primary-500 peer-checked:bg-primary-50 p-4 rounded-xl transition-all duration-300">
                                            <div class="flex items-center">
                                                <div class="w-4 h-4 border-2 border-gray-300 peer-checked:border-primary-500 rounded-full mr-3 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-primary-500 rounded-full opacity-0 peer-checked:opacity-100"></div>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">Monthly Donation</div>
                                                    <div class="text-sm text-gray-600">Ongoing monthly support</div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div>
                                <label class="block text-lg font-semibold text-gray-900 mb-4">Payment Method</label>
                                <select name="payment_method" class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                    <option value="">Select Payment Method</option>
                                    <option value="duitnow">DuitNow QR</option>
                                    <option value="fpx">FPX Online Banking</option>
                                    <option value="card">Credit/Debit Card</option>
                                </select>
                            </div>

                            <!-- Donor Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="donor_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                    <input type="text" id="donor_name" name="donor_name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="donor_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                    <input type="email" id="donor_email" name="donor_email" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="donor_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                    <input type="tel" id="donor_phone" name="donor_phone"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="donor_address" class="block text-sm font-medium text-gray-700 mb-2">Address (for receipt)</label>
                                    <input type="text" id="donor_address" name="donor_address"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>

                            <!-- Anonymous Donation -->
                            <div class="flex items-center">
                                <input type="checkbox" id="anonymous" name="anonymous" class="w-4 h-4 text-primary-500 border-gray-300 rounded focus:ring-primary-500">
                                <label for="anonymous" class="ml-2 text-sm text-gray-700">Make this donation anonymous</label>
                            </div>

                            <!-- Donate Button -->
                            <div class="text-center">
                                <button type="submit" class="w-full md:w-auto bg-primary-500 text-white px-12 py-4 rounded-xl text-lg font-semibold hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    Donate Now
                                </button>
                            </div>

                            <!-- Terms -->
                            <div class="text-center text-sm text-gray-500">
                                <p>By donating, you agree to our <a href="#" class="text-primary-500 hover:underline">Terms of Service</a> and <a href="#" class="text-primary-500 hover:underline">Privacy Policy</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Impact Section -->
        <section class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Your Impact</h2>
                    <p class="text-base md:text-lg text-gray-600">See how your donation makes a real difference</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Impact Card 1 -->
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-gray-100">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Education</h3>
                        <p class="text-gray-600 mb-4">RM 50 can provide school supplies for one child for a month</p>
                        <div class="text-2xl font-bold text-blue-600">2,450+</div>
                        <div class="text-sm text-gray-500">Children Supported</div>
                    </div>

                    <!-- Impact Card 2 -->
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-gray-100">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Healthcare</h3>
                        <p class="text-gray-600 mb-4">RM 100 can provide medical care for a family in need</p>
                        <div class="text-2xl font-bold text-green-600">1,850+</div>
                        <div class="text-sm text-gray-500">Families Helped</div>
                    </div>

                    <!-- Impact Card 3 -->
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-gray-100">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Community</h3>
                        <p class="text-gray-600 mb-4">RM 250 can support community development projects</p>
                        <div class="text-2xl font-bold text-primary-600">320+</div>
                        <div class="text-sm text-gray-500">Projects Funded</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                    <p class="text-base md:text-lg text-gray-600">Common questions about donating</p>
                </div>

                <div class="space-y-6">
                    <!-- FAQ Item 1 -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Is my donation secure?</h3>
                        <p class="text-gray-600">Yes, all donations are processed through secure, encrypted payment gateways. We use industry-standard security measures to protect your personal and financial information.</p>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Will I receive a receipt for tax purposes?</h3>
                        <p class="text-gray-600">Yes, you will receive an official tax-deductible receipt via email immediately after your donation is processed. This receipt can be used for tax deduction purposes.</p>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">How is my donation used?</h3>
                        <p class="text-gray-600">100% of your donation goes directly to our programs. We maintain complete transparency in how funds are allocated and provide regular updates on the impact of your contribution.</p>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Can I cancel my monthly donation?</h3>
                        <p class="text-gray-600">Yes, you can cancel or modify your monthly donation at any time by contacting our support team or through your donor portal. There are no cancellation fees.</p>
                    </div>
                </div>
            </div>
        </section>

        @include('components.footer')

    </body>
</html>
