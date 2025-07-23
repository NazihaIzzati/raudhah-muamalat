@extends('layouts.admin')

@section('title', 'Cardzone API')

@section('content')
<div class="space-y-6">
    <!-- Main Content with Enhanced Design -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <!-- Enhanced Header Section -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">Cardzone API</h3>
                        <p class="text-sm text-[#fe5000] mt-1">Monitor and test Cardzone payment integration in real-time</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                    <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-xl">
                        <span class="text-[#fe5000] font-semibold">{{ now()->format('M d, Y H:i:s') }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.cardzone.debug.transactions') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-500/90 hover:to-indigo-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            View Transactions
                        </a>
                        <button type="button" onclick="clearLogs()" class="inline-flex items-center justify-center px-4 py-2 border border-red-300 rounded-xl shadow-sm text-sm font-semibold text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Clear Logs
                        </button>
                        <a href="{{ route('admin.cardzone.debug.logs') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            View All Logs
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white overflow-hidden shadow rounded-xl border border-gray-200">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Debug Log Size</p>
                                <p class="text-lg font-semibold text-gray-900" id="debugLogSize">{{ number_format($stats['debug_log_size'] / 1024, 2) }} KB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-xl border border-gray-200">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Transaction Log Size</p>
                                <p class="text-lg font-semibold text-gray-900" id="transactionLogSize">{{ number_format($stats['transaction_log_size'] / 1024, 2) }} KB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-xl border border-gray-200">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Last Updated</p>
                                <p class="text-lg font-semibold text-gray-900" id="lastUpdated">{{ now()->format('H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-xl border border-gray-200">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Transactions</p>
                                <p class="text-lg font-semibold text-gray-900" id="totalTransactions">{{ number_format($stats['total_transactions'] ?? 0) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test Controls Section -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center mb-6">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 bg-gradient-to-br from-[#fe5000]/10 to-orange-100 rounded-xl flex items-center justify-center">
                        <svg class="h-5 w-5 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Test Controls</h3>
                    <p class="text-sm text-gray-500 mt-1">Test payment and key exchange functionality</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Key Exchange Test -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="h-5 w-5 text-[#fe5000] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        Key Exchange Test
                    </h4>
                    
                    <p class="text-sm text-gray-600 mb-4">Test RSA key exchange with Cardzone to verify secure communication.</p>
                    
                    <button type="button" onclick="testKeyExchange()" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                        Test Key Exchange
                    </button>
                </div>

                <!-- Card Payment Test -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="h-5 w-5 text-[#fe5000] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Card Payment Test
                    </h4>
                    
                    <p class="text-sm text-gray-600 mb-4">Test 3D Secure card payment flow with custom card details.</p>
                    
                    <!-- Card Payment Form -->
                    <form id="cardPaymentForm" class="space-y-4 mb-4">
                        <!-- Amount and Currency -->
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="cardAmount" class="block text-sm font-medium text-gray-700 mb-1">Amount (RM)</label>
                                <input type="number" id="cardAmount" name="amount" value="10.00" step="0.01" min="0.01" max="9999.99" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                            </div>
                            <div>
                                <label for="cardCurrency" class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                                <select id="cardCurrency" name="currency" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                    <option value="MYR" selected>MYR (Malaysian Ringgit)</option>
                                    <option value="USD">USD (US Dollar)</option>
                                    <option value="SGD">SGD (Singapore Dollar)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Card Number -->
                        <div>
                            <label for="cardNumber" class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                            <input type="text" id="cardNumber" name="card_number" value="5195982168861592" maxlength="19" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm font-mono"
                                   placeholder="1234 5678 9012 3456">
                        </div>

                        <!-- Card Details Row -->
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <label for="cardExpiry" class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                                <input type="text" id="cardExpiry" name="card_expiry" value="03/28" maxlength="5" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm font-mono"
                                       placeholder="MM/YY">
                            </div>
                            <div>
                                <label for="cardCvv" class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                <input type="text" id="cardCvv" name="card_cvv" value="133" maxlength="4" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm font-mono"
                                       placeholder="123">
                            </div>
                            <div>
                                <label for="cardHolder" class="block text-sm font-medium text-gray-700 mb-1">Cardholder Name</label>
                                <input type="text" id="cardHolder" name="card_holder_name" value="Test Cardholder" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                       placeholder="John Doe">
                            </div>
                        </div>

                        <!-- Test Card Presets -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Test Card Presets</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <button type="button" onclick="loadTestCard('debit')" 
                                        class="text-left p-2 border border-gray-200 rounded-lg hover:bg-gray-50 text-xs">
                                    <span class="font-medium text-gray-900">Debit Card</span><br>
                                    <span class="text-gray-500">5195 9821 6886 1592</span>
                                </button>
                                <button type="button" onclick="loadTestCard('credit')" 
                                        class="text-left p-2 border border-gray-200 rounded-lg hover:bg-gray-50 text-xs">
                                    <span class="font-medium text-gray-900">Credit Card</span><br>
                                    <span class="text-gray-500">4111 1111 1111 1111</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <button type="button" onclick="testCardPaymentWithForm()" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-500/90 hover:to-indigo-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Test Card Payment
                    </button>
                </div>

                <!-- Online Banking Wallet Test -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="h-5 w-5 text-[#fe5000] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        OBW Payment Test
                    </h4>
                    
                    <p class="text-sm text-gray-600 mb-4">Test Online Banking Wallet payment flow with Cardzone.</p>
                    
                    <button type="button" onclick="testOBWPayment()" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-500/90 hover:to-emerald-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        Test OBW Payment
                    </button>
                </div>

                <!-- QR Payment Test -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="h-5 w-5 text-[#fe5000] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                        </svg>
                        QR Payment Test
                    </h4>
                    
                    <p class="text-sm text-gray-600 mb-4">Test QR code payment flow with Cardzone integration.</p>
                    
                    <button type="button" onclick="testQRPayment()" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-500/90 hover:to-pink-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                        </svg>
                        Test QR Payment
                    </button>
                </div>

                <!-- Environment Test -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="h-5 w-5 text-[#fe5000] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Environment Test
                    </h4>
                    
                    <p class="text-sm text-gray-600 mb-4">Test environment configuration and connectivity to Cardzone.</p>
                    
                    <button type="button" onclick="testEnvironment()" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-500/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Test Environment
                    </button>
                </div>

                <!-- MAC Verification Test -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="h-5 w-5 text-[#fe5000] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        MAC Verification Test
                    </h4>
                    
                    <p class="text-sm text-gray-600 mb-4">Test MAC signature generation and verification with Cardzone.</p>
                    
                    <button type="button" onclick="testMACVerification()" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-500/90 hover:to-pink-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Test MAC Verification
                    </button>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Enhanced Result Modal -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" id="resultModal">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-xl bg-white">
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900" id="resultModalTitle">Test Result</h3>
            <button type="button" onclick="hideResultModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="mb-4" id="resultModalBody">
        </div>
        <div class="flex justify-end space-x-3 pt-3 border-t border-gray-200">
            <button type="button" onclick="hideResultModal()" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                Close
            </button>
            <button type="button" onclick="refreshDashboard()" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh Dashboard
            </button>
        </div>
    </div>
</div>

<!-- Loading Spinner -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" id="loadingModal">
    <div class="relative top-20 mx-auto p-5 border w-64 shadow-lg rounded-xl bg-white">
        <div class="flex flex-col items-center justify-center py-8">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#fe5000] mb-4"></div>
            <p class="text-gray-700 font-medium">Processing...</p>
            <p class="text-sm text-gray-500 mt-1">Please wait while we process your request</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Show loading spinner
function showLoading() {
    document.getElementById('loadingModal').classList.remove('hidden');
}

// Hide loading spinner
function hideLoading() {
    document.getElementById('loadingModal').classList.add('hidden');
}

// Show result modal
function showResultModal() {
    document.getElementById('resultModal').classList.remove('hidden');
}

// Hide result modal
function hideResultModal() {
    document.getElementById('resultModal').classList.add('hidden');
}



// Test key exchange function
function testKeyExchange() {
    showLoading();
    fetch('{{ route("admin.cardzone.debug.test-key-exchange") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        showResult('Key Exchange Test Result', data);
        setTimeout(() => refreshDashboard(), 2000);
    })
    .catch(error => {
        hideLoading();
        showResult('Key Exchange Test Error', { success: false, message: error.message });
    });
}

// Test card payment function (legacy - uses default values)
function testCardPayment() {
    showLoading();
    const testData = {
        payment_method: 'card',
        amount: 1000, // RM 10.00 in cents
        currency: 'MYR',
        card_number: '5195982168861592',
        card_expiry: '03/28',
        card_cvv: '133'
    };
    
    fetch('{{ route("admin.cardzone.debug.test-payment") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(testData)
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        showResult('Card Payment Test Result', data);
        setTimeout(() => refreshDashboard(), 2000);
    })
    .catch(error => {
        hideLoading();
        showResult('Card Payment Test Error', { success: false, message: error.message });
    });
}

// Test card payment with form data
function testCardPaymentWithForm() {
    const form = document.getElementById('cardPaymentForm');
    const formData = new FormData(form);
    
    // Validate form
    if (!validateCardForm(formData)) {
        return;
    }
    
    showLoading();
    
    // Convert amount to cents
    const amount = parseFloat(formData.get('amount')) * 100;
    
    const testData = {
        payment_method: 'card',
        amount: Math.round(amount),
        currency: formData.get('currency'),
        card_number: formData.get('card_number').replace(/\s/g, ''),
        card_expiry: formData.get('card_expiry'),
        card_cvv: formData.get('card_cvv'),
        card_holder_name: formData.get('card_holder_name')
    };
    
    fetch('{{ route("admin.cardzone.debug.test-payment") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(testData)
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        showResult('Card Payment Test Result', data);
        setTimeout(() => refreshDashboard(), 2000);
    })
    .catch(error => {
        hideLoading();
        showResult('Card Payment Test Error', { success: false, message: error.message });
    });
}

// Validate card form
function validateCardForm(formData) {
    const amount = parseFloat(formData.get('amount'));
    const cardNumber = formData.get('card_number').replace(/\s/g, '');
    const cardExpiry = formData.get('card_expiry');
    const cardCvv = formData.get('card_cvv');
    const cardHolder = formData.get('card_holder_name');
    
    let errors = [];
    
    // Validate amount
    if (!amount || amount <= 0 || amount > 9999.99) {
        errors.push('Amount must be between RM 0.01 and RM 9,999.99');
    }
    
    // Validate card number
    if (!cardNumber || cardNumber.length < 13 || cardNumber.length > 19) {
        errors.push('Card number must be between 13 and 19 digits');
    }
    
    // Validate expiry date
    if (!cardExpiry || !/^\d{2}\/\d{2}$/.test(cardExpiry)) {
        errors.push('Expiry date must be in MM/YY format');
    }
    
    // Validate CVV
    if (!cardCvv || cardCvv.length < 3 || cardCvv.length > 4) {
        errors.push('CVV must be 3 or 4 digits');
    }
    
    // Validate cardholder name
    if (!cardHolder || cardHolder.trim().length < 2) {
        errors.push('Cardholder name must be at least 2 characters');
    }
    
    if (errors.length > 0) {
        showResult('Form Validation Error', {
            success: false,
            message: 'Please fix the following errors:',
            data: { errors: errors }
        });
        return false;
    }
    
    return true;
}

// Load test card presets
function loadTestCard(type) {
    const cardNumber = document.getElementById('cardNumber');
    const cardExpiry = document.getElementById('cardExpiry');
    const cardCvv = document.getElementById('cardCvv');
    const cardHolder = document.getElementById('cardHolder');
    
    if (type === 'debit') {
        cardNumber.value = '5195982168861592';
        cardExpiry.value = '03/28';
        cardCvv.value = '133';
        cardHolder.value = 'Test Debit Cardholder';
    } else if (type === 'credit') {
        cardNumber.value = '4111111111111111';
        cardExpiry.value = '12/25';
        cardCvv.value = '123';
        cardHolder.value = 'Test Credit Cardholder';
    }
    
    // Format the card number
    formatCardNumber();
}

// Format card number with spaces
function formatCardNumber() {
    const cardNumber = document.getElementById('cardNumber');
    let value = cardNumber.value.replace(/\s/g, '').replace(/\D/g, '');
    
    // Add spaces every 4 digits
    value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    
    cardNumber.value = value;
}

// Format expiry date
function formatExpiryDate() {
    const expiry = document.getElementById('cardExpiry');
    let value = expiry.value.replace(/\D/g, '');
    
    if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    
    expiry.value = value;
}

// Format CVV (numbers only)
function formatCvv() {
    const cvv = document.getElementById('cardCvv');
    cvv.value = cvv.value.replace(/\D/g, '');
}

// Test OBW payment function
function testOBWPayment() {
    showLoading();
    const testData = {
        payment_method: 'obw',
        amount: 1000, // RM 10.00 in cents
        currency: 'MYR',
        bank_code: 'MBBEMYKL' // Maybank
    };
    
    fetch('{{ route("admin.cardzone.debug.test-payment") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(testData)
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        showResult('OBW Payment Test Result', data);
        setTimeout(() => refreshDashboard(), 2000);
    })
    .catch(error => {
        hideLoading();
        showResult('OBW Payment Test Error', { success: false, message: error.message });
    });
}

// Test QR payment function
function testQRPayment() {
    showLoading();
    const testData = {
        payment_method: 'qr',
        amount: 1000, // RM 10.00 in cents
        currency: 'MYR'
    };
    
    fetch('{{ route("admin.cardzone.debug.test-payment") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(testData)
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        showResult('QR Payment Test Result', data);
        setTimeout(() => refreshDashboard(), 2000);
    })
    .catch(error => {
        hideLoading();
        showResult('QR Payment Test Error', { success: false, message: error.message });
    });
}

// Test environment function
function testEnvironment() {
    showLoading();
    fetch('{{ route("admin.cardzone.debug.test-environment") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        showResult('Environment Test Result', data);
        setTimeout(() => refreshDashboard(), 2000);
    })
    .catch(error => {
        hideLoading();
        showResult('Environment Test Error', { success: false, message: error.message });
    });
}

// Test MAC verification function
function testMACVerification() {
    showLoading();
    fetch('{{ route("admin.cardzone.debug.test-mac-verification") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        showResult('MAC Verification Test Result', data);
        setTimeout(() => refreshDashboard(), 2000);
    })
    .catch(error => {
        hideLoading();
        showResult('MAC Verification Test Error', { success: false, message: error.message });
    });
}

// Clear logs function
function clearLogs() {
    if (confirm('Are you sure you want to clear all logs? This action cannot be undone.')) {
        showLoading();
        fetch('{{ route("admin.cardzone.debug.clear-logs") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
        .then(() => {
            hideLoading();
            refreshDashboard();
        })
        .catch(error => {
            hideLoading();
            alert('Error clearing logs: ' + error.message);
        });
    }
}

// Refresh dashboard function
function refreshDashboard() {
    location.reload();
}

// Enhanced result display function with request/response details
function showResult(title, data) {
    const modalTitle = document.getElementById('resultModalTitle');
    const body = document.getElementById('resultModalBody');
    
    modalTitle.textContent = title;
    
    let html = '';
    
    // Status alert
    const alertClass = data.success ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800';
    const iconClass = data.success ? 'text-green-400' : 'text-red-400';
    const iconPath = data.success ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z';
    
    html += `<div class="p-4 mb-4 border rounded-xl ${alertClass}">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 ${iconClass}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${iconPath}"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">
                    ${data.success ? 'Success!' : 'Error!'} ${data.message}
                </p>
            </div>
        </div>
    </div>`;
    
    // Request Details Section (for key exchange)
    if (data.request_details) {
        html += '<div class="bg-blue-50 rounded-xl p-4 mb-4 border border-blue-200">';
        html += '<h4 class="text-sm font-semibold text-blue-900 mb-3 flex items-center">';
        html += '<svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
        html += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>';
        html += '</svg>Request Details</h4>';
        html += '<div class="space-y-2 text-sm">';
        html += `<div><span class="font-medium text-blue-800">URL:</span> <code class="text-blue-700">${data.request_details.url || 'N/A'}</code></div>`;
        html += `<div><span class="font-medium text-blue-800">Method:</span> <code class="text-blue-700">${data.request_details.method || 'POST'}</code></div>`;
        if (data.request_details.payload) {
            html += '<div><span class="font-medium text-blue-800">Payload:</span></div>';
            html += '<div class="bg-blue-100 p-2 rounded text-xs font-mono text-blue-800 overflow-x-auto">';
            html += JSON.stringify(data.request_details.payload, null, 2);
            html += '</div>';
        }
        html += '</div></div>';
    }
    
    // Response Details Section
    if (data.response_details) {
        html += '<div class="bg-green-50 rounded-xl p-4 mb-4 border border-green-200">';
        html += '<h4 class="text-sm font-semibold text-green-900 mb-3 flex items-center">';
        html += '<svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
        html += '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
        html += '</svg>Response Details</h4>';
        html += '<div class="space-y-2 text-sm">';
        html += `<div><span class="font-medium text-green-800">Status:</span> <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${data.response_details.status_code === 200 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">${data.response_details.status_code || 'N/A'}</span></div>`;
        html += `<div><span class="font-medium text-green-800">Content-Type:</span> <code class="text-green-700">${data.response_details.content_type || 'N/A'}</code></div>`;
        html += `<div><span class="font-medium text-green-800">Response Time:</span> <code class="text-green-700">${data.response_details.response_time || 'N/A'}</code></div>`;
        if (data.response_details.response_body) {
            html += '<div><span class="font-medium text-green-800">Response Body:</span></div>';
            html += '<div class="bg-green-100 p-2 rounded text-xs font-mono text-green-800 overflow-x-auto">';
            html += JSON.stringify(data.response_details.response_body, null, 2);
            html += '</div>';
        }
        html += '</div></div>';
    }
    
    // Test Details section
    if (data.transaction_id || data.response_status || data.has_form !== undefined || data.has_3ds !== undefined || data.error_code) {
        html += '<div class="bg-gray-50 rounded-xl p-4 mb-4">';
        html += '<h4 class="text-sm font-semibold text-gray-900 mb-3">Test Details</h4>';
        html += '<div class="space-y-3">';
        
        if (data.transaction_id) {
            html += `<div class="flex justify-between items-center">
                <span class="text-sm font-medium text-gray-700">Transaction ID:</span>
                <code class="text-sm bg-gray-200 px-2 py-1 rounded text-gray-800">${data.transaction_id}</code>
            </div>`;
        }
        
        if (data.response_status) {
            const statusClass = data.response_status === 200 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
            html += `<div class="flex justify-between items-center">
                <span class="text-sm font-medium text-gray-700">Response Status:</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClass}">${data.response_status}</span>
            </div>`;
        }
        
        if (data.has_form !== undefined) {
            const formClass = data.has_form ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
            html += `<div class="flex justify-between items-center">
                <span class="text-sm font-medium text-gray-700">Has Form:</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${formClass}">${data.has_form ? 'Yes' : 'No'}</span>
            </div>`;
        }
        
        if (data.has_3ds !== undefined) {
            const threeDSClass = data.has_3ds ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
            html += `<div class="flex justify-between items-center">
                <span class="text-sm font-medium text-gray-700">Has 3D Secure:</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${threeDSClass}">${data.has_3ds ? 'Yes' : 'No'}</span>
            </div>`;
        }
        
        if (data.error_code) {
            html += `<div class="flex justify-between items-center">
                <span class="text-sm font-medium text-gray-700">Error Code:</span>
                <code class="text-sm bg-red-100 px-2 py-1 rounded text-red-800">${data.error_code}</code>
            </div>`;
        }
        
        html += '</div></div>';
    }
    
    // Additional data section if available
    if (data.data && Object.keys(data.data).length > 0) {
        html += '<div class="bg-gray-50 rounded-xl p-4">';
        html += '<h4 class="text-sm font-semibold text-gray-900 mb-3">Additional Data</h4>';
        html += '<div class="bg-gray-900 text-green-400 p-3 rounded-lg font-mono text-xs overflow-x-auto">';
        html += JSON.stringify(data.data, null, 2);
        html += '</div></div>';
    }
    
    body.innerHTML = html;
    showResultModal();
}

// Initialize form event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Add form input event listeners
    const cardNumber = document.getElementById('cardNumber');
    const cardExpiry = document.getElementById('cardExpiry');
    const cardCvv = document.getElementById('cardCvv');
    
    if (cardNumber) {
        cardNumber.addEventListener('input', formatCardNumber);
        cardNumber.addEventListener('blur', formatCardNumber);
    }
    
    if (cardExpiry) {
        cardExpiry.addEventListener('input', formatExpiryDate);
        cardExpiry.addEventListener('blur', formatExpiryDate);
    }
    
    if (cardCvv) {
        cardCvv.addEventListener('input', formatCvv);
    }
    
    // Initial formatting
    if (cardNumber) formatCardNumber();
    if (cardExpiry) formatExpiryDate();
});

// Auto-refresh stats every 30 seconds
setInterval(() => {
    fetch('{{ route("admin.cardzone.debug.get-stats") }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('debugLogSize').textContent = (data.debug_log_size / 1024).toFixed(2) + ' KB';
            document.getElementById('transactionLogSize').textContent = (data.transaction_log_size / 1024).toFixed(2) + ' KB';
            document.getElementById('totalTransactions').textContent = data.total_transactions ? data.total_transactions.toLocaleString() : '0';
            document.getElementById('lastUpdated').textContent = new Date().toLocaleTimeString();
        })
        .catch(error => console.log('Stats update failed:', error));
}, 30000);


</script>
@endpush 