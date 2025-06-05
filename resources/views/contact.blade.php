<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contact Us - Jariah Fund</title>

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
                        Contact Us
                    </h1>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                        Get in touch with our dedicated team for support, guidance, and assistance with your Islamic crowdfunding journey.
                        We're here to help you make a meaningful impact in your community.
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact Information Section -->
        <section class="py-16 md:py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Get in Touch</h2>
                            <p class="text-lg text-gray-600 mb-8">We're here to help with any questions or support you need.</p>

                            <div class="space-y-6">
                                <!-- Office Address -->
                                <div class="bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-all duration-300 group cursor-pointer" onclick="openMap()">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary-200 transition-colors duration-300">
                                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Office Address</h3>
                                            <p class="text-gray-600 leading-relaxed">
                                                Menara Muamalat, No. 22, Jalan Melaka<br>
                                                50100 Kuala Lumpur, Malaysia
                                            </p>
                                            <p class="text-primary-500 text-sm mt-2 group-hover:text-primary-600 transition-colors duration-300">
                                                Click to view on map
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone Support -->
                                <div class="bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-all duration-300 group cursor-pointer" onclick="callPhone()">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary-200 transition-colors duration-300">
                                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Phone</h3>
                                            <p class="text-gray-600 mb-1">+60 3-2161 2000</p>
                                            <p class="text-gray-600 mb-2">+60 3-2161 2001</p>
                                            <p class="text-primary-500 text-sm group-hover:text-primary-600 transition-colors duration-300">
                                                Click to call
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email Support -->
                                <div class="bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-all duration-300 group cursor-pointer" onclick="sendEmail()">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary-200 transition-colors duration-300">
                                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                                            <p class="text-gray-600 mb-1">info@jariahfund.com</p>
                                            <p class="text-gray-600 mb-2">support@jariahfund.com</p>
                                            <p class="text-primary-500 text-sm group-hover:text-primary-600 transition-colors duration-300">
                                                Click to send email
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Hours -->
                                <div class="bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-all duration-300">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Business Hours</h3>
                                            <div class="space-y-1 text-gray-600">
                                                <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                                                <p>Saturday: 9:00 AM - 1:00 PM</p>
                                                <p>Sunday: Closed</p>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-2">Malaysia Standard Time (GMT+8)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                        <div class="mb-6">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Send us a Message</h2>
                            <p class="text-gray-600">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                        </div>
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" id="first-name" name="first-name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-500" placeholder="Enter your first name">
                                </div>
                                <div>
                                    <label for="last-name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" id="last-name" name="last-name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-500" placeholder="Enter your last name">
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-500" placeholder="Enter your email address">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-500" placeholder="Enter your phone number">
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                                <select id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900">
                                    <option value="">Select a subject</option>
                                    <option value="campaign">Campaign Support</option>
                                    <option value="donation">Donation Inquiry</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="technical">Technical Support</option>
                                    <option value="general">General Inquiry</option>
                                </select>
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-500 resize-vertical" placeholder="Enter your message"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-200 transition-all duration-300">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Send Message
                                </span>
                            </button>

                            <!-- Form Footer -->
                            <div class="mt-6 text-center">
                                <p class="text-gray-500 text-sm">
                                    Your information is secure and will only be used to respond to your inquiry.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>



        @include('components.footer')

        <!-- JavaScript for Interactive Features -->
        <script>
            // Contact interactions
            function openMap() {
                const address = "Menara Muamalat, No. 22, Jalan Melaka, Kuala Lumpur, Malaysia 50100";
                const encodedAddress = encodeURIComponent(address);
                window.open(`https://www.google.com/maps/search/?api=1&query=${encodedAddress}`, '_blank');
            }

            function callPhone() {
                window.location.href = 'tel:+60321612000';
            }

            function sendEmail() {
                window.location.href = 'mailto:info@jariahfund.com?subject=Inquiry from Jariah Fund Website';
            }
        </script>
    </body>
</html>
