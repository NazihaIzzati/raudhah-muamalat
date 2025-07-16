<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment Wizard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Custom styles for active tab button and payment option button */
        /* Using arbitrary values for custom orange color */
        .tab-button.active-tab, .payment-option-button.active-option {
            border-color: #FE8000; /* Main orange */
            color: #FE8000; /* Main orange */
        }
        .tab-button:hover, .payment-option-button:hover {
            border-color: #FF9A33; /* Lighter orange for hover */
            color: #FF9A33; /* Lighter orange for hover */
        }

        /* Style for card input container to resemble a card */
        .card-input-container {
            background: linear-gradient(135deg, #FE8000 0%, #FFB366 100%); /* Orange gradient */
            border-radius: 18px; /* Slightly more rounded */
            padding: 30px; /* More padding */
            color: white;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25); /* Stronger shadow */
            position: relative;
            overflow: hidden;
            transform: translateY(0); /* For subtle animation */
            transition: transform 0.3s ease-out, box-shadow 0.3s ease-out;
        }
        .card-input-container:hover {
            transform: translateY(-5px); /* Lift on hover */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        .card-input-container::before {
            content: '';
            position: absolute;
            top: -60px;
            left: -60px;
            width: 180px;
            height: 180px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: rotate(45deg);
            filter: blur(5px); /* Soften the blur */
        }
        .card-input-container::after {
            content: '';
            position: absolute;
            bottom: -40px;
            right: -40px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            filter: blur(3px); /* Soften the blur */
        }
        .card-input-container label {
            color: rgba(255, 255, 255, 0.9); /* Brighter label color */
            font-weight: 600; /* Bolder labels */
            margin-bottom: 8px; /* More space below labels */
        }
        .card-input-container input {
            background-color: rgba(255, 255, 255, 0.2); /* Slightly more opaque input background */
            border: 1px solid rgba(255, 255, 255, 0.4); /* Stronger border */
            color: white;
            padding: 12px 15px; /* More padding */
            border-radius: 10px; /* More rounded inputs */
            font-size: 1.05rem; /* Slightly larger font */
            transition: background-color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .card-input-container input::placeholder {
            color: rgba(255, 255, 255, 0.7); /* Brighter placeholder */
        }
        .card-input-container input:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.3); /* More opaque on focus */
            border-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3); /* More prominent focus ring */
        }

        /* General button enhancements */
        button.bg-indigo-600 {
            background-color: #FE8000; /* Main orange */
            box-shadow: 0 6px 15px rgba(254, 128, 0, 0.3); /* Orange shadow */
        }
        button.bg-indigo-600:hover {
            background-color: #D96F00; /* Darker orange for hover */
            box-shadow: 0 8px 20px rgba(254, 128, 0, 0.4);
        }
        button.bg-red-600 {
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);
        }
        button.bg-red-600:hover {
            box_shadow: 0 6px 15px rgba(239, 68, 68, 0.3);
        }
    </style>
</head>
<body class="font-inter bg-gray-100 flex justify-center items-center min-h-screen p-4 sm:p-6 md:p-8 box-border">
    <div class="container bg-white p-6 sm:p-8 rounded-2xl shadow-xl w-full max-w-md md:max-w-lg lg:max-w-xl">
        @if(isset($donationData))
            <div class="text-center mb-4">
                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mb-2">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Donation Payment
                </div>
            </div>
        @endif
        <h1 class="text-gray-900 text-2xl sm:text-3xl font-bold text-center mb-6">
            @if(isset($donationData))
                Complete Your Donation
            @else
                Complete Your Purchase
            @endif
        </h1>

        <!-- Step Indicator -->
        <div class="flex justify-center mb-8 space-x-4">
            <div id="step-indicator-1" class="w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold bg-[#FE8000] text-white shadow-md">1</div>
            <div id="step-indicator-2" class="w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold bg-gray-300 text-gray-700 shadow-md">2</div>
            <div id="step-indicator-3" class="w-10 h-10 rounded-full flex items-center justify-center text-lg font-bold bg-gray-300 text-gray-700 shadow-md">3</div>
        </div>

        <!-- Hidden Merchant ID -->
        <input type="hidden" id="merchantId" value="400000000000005">
        
        <!-- Hidden Donation Data -->
        @if(isset($donationData))
            <input type="hidden" id="donationId" value="{{ $donationData['donation_id'] }}">
            <input type="hidden" id="campaignId" value="{{ $donationData['campaign_id'] }}">
            <input type="hidden" id="donorName" value="{{ $donationData['donor_name'] }}">
            <input type="hidden" id="donorEmail" value="{{ $donationData['donor_email'] }}">
            <input type="hidden" id="donorPhone" value="{{ $donationData['donor_phone'] }}">
            <input type="hidden" id="donationMessage" value="{{ $donationData['message'] }}">
            <input type="hidden" id="isAnonymous" value="{{ $donationData['is_anonymous'] }}">
            <input type="hidden" id="donationType" value="{{ $donationData['donation_type'] }}">
        @endif

        <!-- Step 1: Choose Payment Method -->
        <div id="step-1-options" class="wizard-step">
            <div class="section bg-gray-50 p-6 sm:p-8 rounded-xl mb-5 border border-gray-200">
                <h2 class="text-gray-800 text-xl sm:text-2xl font-semibold text-center mb-6">Choose Your Payment Method</h2>
                
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mb-8">
                    <button class="payment-option-button flex flex-col items-center justify-center px-6 py-4 rounded-xl font-semibold border-2 border-gray-300 text-gray-700 hover:border-[#FE8000] hover:text-[#FE8000] transition-all duration-300 active-option shadow-sm hover:shadow-md w-full sm:w-auto flex-1" data-method="card">
                        <i class='bx bxs-credit-card text-3xl mb-2'></i>
                        <span class="text-lg">Card Payment</span>
                    </button>
                    <button class="payment-option-button flex flex-col items-center justify-center px-6 py-4 rounded-xl font-semibold border-2 border-gray-300 text-gray-700 hover:border-[#FE8000] hover:text-[#FE8000] transition-all duration-300 shadow-sm hover:shadow-md w-full sm:w-auto flex-1" data-method="obw">
                        <i class='bx bxs-bank text-3xl mb-2'></i>
                        <span class="text-lg">Online Banking</span>
                    </button>
                    <button class="payment-option-button flex flex-col items-center justify-center px-6 py-4 rounded-xl font-semibold border-2 border-gray-300 text-gray-700 hover:border-[#FE8000] hover:text-[#FE8000] transition-all duration-300 shadow-sm hover:shadow-md w-full sm:w-auto flex-1" data-method="qr">
                        <i class='bx bxs-qr-scan text-3xl mb-2'></i>
                        <span class="text-lg">QR Payment</span>
                    </button>
                </div>

                <button id="nextStep1Button" onclick="nextStep()" class="bg-[#FE8000] text-white py-3 px-6 rounded-lg font-semibold cursor-pointer transition-all duration-300 ease-in-out w-full shadow-lg hover:bg-[#D96F00] hover:scale-105 active:scale-100 mt-6">Next</button>
                <div id="message1" class="message-box hidden bg-blue-100 text-blue-800 p-4 rounded-lg mt-5 border border-blue-300 text-center font-medium"></div>
            </div>
        </div>

        <!-- Step 2: Enter Payment Details -->
        <div id="step-2-details" class="wizard-step hidden">
            <div class="section bg-gray-50 p-6 sm:p-8 rounded-xl mb-5 border border-gray-200">
                <h2 class="text-gray-800 text-xl sm:text-2xl font-semibold text-center mb-6">Enter Payment Details</h2>
                
                <div class="mb-4">
                    <label for="purchaseAmount" class="block mb-1 font-semibold text-gray-700">Amount:</label>
                    <input type="number" id="purchaseAmount" value="{{ isset($donationData) ? $donationData['amount'] : '150.00' }}" step="0.01" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-700 bg-gray-100 cursor-not-allowed">
                </div>
                <div class="mb-4">
                    <label for="purchaseCurrency" class="block mb-1 font-semibold text-gray-700">Currency:</label>
                    <input type="text" id="purchaseCurrency" value="MYR" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-700 bg-gray-100 cursor-not-allowed">
                </div>

                <!-- Card Payment Details Section -->
                <div id="card-details-section" class="payment-details-section active">
                    <div class="card-input-container mb-6">
                        <div class="mb-4">
                            <label for="cardNumber" class="block mb-1">Card Number:</label>
                            <input type="text" id="cardNumber" placeholder="0000 0000 0000 0000" class="w-full">
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="cardExpiry" class="block mb-1">Expiry (MM/YY):</label>
                                <input type="text" id="cardExpiry" placeholder="MM/YY" class="w-full">
                            </div>
                            <div>
                                <label for="cardCVV" class="block mb-1">CVV:</label>
                                <input type="text" id="cardCVV" placeholder="123" class="w-full">
                            </div>
                        </div>
                        <div>
                            <label for="cardHolderName" class="block mb-1">Cardholder Name:</label>
                            <input type="text" id="cardHolderName" placeholder="Name on card" class="w-full">
                        </div>
                    </div>
                </div>

                <!-- Online Banking Details Section -->
                <div id="obw-details-section" class="payment-details-section hidden">
                    <div class="mb-4">
                        <label for="obwBank" class="block mb-1 font-semibold text-gray-700">Select Your Bank:</label>
                        <select id="obwBank" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-[#FE8000] focus:border-[#FE8000]">
                            <option value="">-- Select Bank --</option>
                            @if(count($banks) > 0)
                                @foreach($banks as $bank)
                                    <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                                @endforeach
                            @else
                                <!-- Sample banks for demo purposes -->
                                <option value="MBB">Maybank</option>
                                <option value="CIMB">CIMB Bank</option>
                                <option value="PBB">Public Bank</option>
                                <option value="RHB">RHB Bank</option>
                                <option value="HLB">Hong Leong Bank</option>
                                <option value="AMB">AmBank</option>
                                <option value="UOB">UOB Bank</option>
                                <option value="OCBC">OCBC Bank</option>
                                <option value="HSBC">HSBC Bank</option>
                                <option value="SCB">Standard Chartered Bank</option>
                            @endif
                        </select>
                    </div>
                    <p class="text-gray-600 text-sm mt-2 text-center">You will be redirected to your chosen bank's website to complete the payment.</p>
                </div>

                <!-- QR Payment Details Section -->
                <div id="qr-details-section" class="payment-details-section hidden">
                    <p class="text-gray-600 text-center mb-4">Scan the QR code with your preferred e-wallet or banking app to complete the payment.</p>
                    <div class="flex justify-center items-center h-48 bg-white border border-gray-300 rounded-lg">
                        <img id="qrCodeImage" src="https://placehold.co/150x150/e0f2fe/0c4a6e?text=QR+Code" alt="QR Code Placeholder" class="max-w-full max-h-full p-2">
                    </div>
                    <p class="text-gray-600 text-sm mt-4 text-center">
                        (In a real integration, the QR code image or string would be generated by Cardzone's API.)
                    </p>
                </div>

                <div class="flex justify-between mt-8">
                    <button id="prevStep2Button" onclick="prevStep()" class="bg-gray-300 text-gray-800 py-3 px-6 rounded-lg font-semibold cursor-pointer transition-all duration-300 ease-in-out hover:bg-gray-400 hover:scale-105 active:scale-100 w-2/5 shadow-md">Back</button>
                    <button id="payNowButton" onclick="initiatePaymentBackend()" class="bg-[#FE8000] text-white py-3 px-6 rounded-lg font-semibold cursor-pointer transition-all duration-300 ease-in-out w-2/5 shadow-lg hover:bg-[#D96F00] hover:scale-105 active:scale-100">Pay Now</button>
                </div>
                <div id="message2" class="message-box hidden bg-blue-100 text-blue-800 p-4 rounded-lg mt-5 border border-blue-300 text-center font-medium"></div>
            </div>
        </div>

        <!-- Step 3: Secure Authentication/Processing -->
        <div id="step-3-processing" class="wizard-step hidden">
            <div class="section bg-gray-50 p-6 sm:p-8 rounded-xl mb-5 border border-gray-200">
                <h2 class="text-gray-800 text-xl sm:text-2xl font-semibold text-center mb-6">Secure Authentication</h2>
                <p class="text-gray-600 mb-4 text-center">
                    Your payment will be securely authenticated by your bank. Please follow any instructions that appear below.
                </p>
                <iframe name="cardzone_iframe" id="cardzoneIframe" class="w-full h-80 sm:h-96 border border-gray-300 rounded-lg mt-5"></iframe>
                <button id="cancelButton" onclick="cancelPayment()" class="bg-red-600 text-white py-3 px-6 rounded-lg font-semibold cursor-pointer transition-all duration-300 ease-in-out w-full shadow-lg hover:bg-red-700 hover:scale-105 active:scale-100 mt-6">Cancel Payment</button>
                <div id="message3" class="message-box hidden bg-blue-100 text-blue-800 p-4 rounded-lg mt-5 border border-blue-300 text-center font-medium"></div>
            </div>
        </div>

        <div class="section bg-gray-50 p-6 sm:p-8 rounded-xl mb-5 border border-gray-200">
            <h2 class="text-gray-800 text-xl sm:text-2xl font-semibold text-center mb-6">How Your Payment Works</h2>
            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                <li>You select your preferred payment method on this secure page.</li>
                <li>We securely send your details to your bank for authentication using 3D Secure technology (for cards) or direct bank redirection (for online banking). This helps protect you from fraud.</li>
                <li>Your bank may ask you to verify your identity (e.g., via a one-time password (OTP) sent to your phone, or through your banking app). This step happens in the 'Secure Authentication' area above.</li>
                <li>Once your bank successfully authenticates you, the payment is processed.</li>
                <li>You will then be redirected to a confirmation page on our website.</li>
            </ol>
            <p class="text-gray-600 mt-4 text-sm">
                This process ensures your online transactions are safe and secure.
            </p>
        </div>

        <div class="note bg-amber-50 p-4 border-l-4 border-amber-500 rounded-lg mt-5 text-amber-800 text-sm">
            <strong class="text-amber-700">Demo Mode Active:</strong>
            <p>
                The Cardzone payment gateway is currently in demo mode because the API is not responding. In a production environment, this would connect to the actual Cardzone payment gateway for secure transactions.
            </p>
            <p>
                <strong>For a live integration:</strong> The Key Exchange (`MPIKeyReq`) and MAC generation/verification MUST be handled on your secure backend server (e.g., Laravel). Client-side JavaScript cannot directly make these cross-origin API calls due to browser security policies (CORS).
            </p>
            <p>
                This demo shows the complete payment flow including form validation, transaction creation, and the UI for 3D Secure authentication. In a real application, your backend would perform the `MPIKeyReq` first, then pass the `transactionId` and the generated `MPI_MAC` to this frontend for the `MPIReq` form submission.
            </p>
            <p>
                After 3DS authentication, Cardzone's Server will POST the final transaction result (`MPIRes`) to a "Response URL" on your backend. Your backend then processes this, sends to your Payment Gateway for final authorization, and updates the user.
            </p>
        </div>
    </div>

    <script>
        let currentStep = 1;
        let activePaymentMethod = 'card'; // Default active method

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
            switchPaymentMethod('card'); // Ensure initial card tab is active

            document.querySelectorAll('.payment-option-button').forEach(button => {
                button.addEventListener('click', () => {
                    const method = button.dataset.method;
                    switchPaymentMethod(method);
                });
            });
        });

        function showStep(stepNum) {
            document.querySelectorAll('.wizard-step').forEach(step => {
                step.classList.add('hidden');
            });
            document.getElementById(`step-${stepNum}-options`)?.classList.remove('hidden'); 
            document.getElementById(`step-${stepNum}-details`)?.classList.remove('hidden'); 
            document.getElementById(`step-${stepNum}-processing`)?.classList.remove('hidden'); 

            document.querySelectorAll('[id^="step-indicator-"]').forEach(indicator => {
                indicator.classList.remove('bg-[#FE8000]', 'text-white');
                indicator.classList.add('bg-gray-300', 'text-gray-700');
            });
            const currentIndicator = document.getElementById(`step-indicator-${stepNum}`);
            if (currentIndicator) {
                currentIndicator.classList.remove('bg-gray-300', 'text-gray-700');
                currentIndicator.classList.add('bg-[#FE8000]', 'text-white');
            }
        }

        function nextStep() {
            let isValid = true;
            displayMessage('', 'info'); 

            if (currentStep === 1) {
                currentStep++;
            } else if (currentStep === 2) {
                if (activePaymentMethod === 'card') {
                    const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
                    const cardExpiry = document.getElementById('cardExpiry').value.replace(/\//g, '');
                    const cardCVV = document.getElementById('cardCVV').value;
                    const cardHolderName = document.getElementById('cardHolderName').value;

                    if (!cardNumber || !cardExpiry || !cardCVV || !cardHolderName) {
                        displayMessage('Please fill in all card details.', 'error');
                        isValid = false;
                    } else if (cardNumber.length < 13 || cardNumber.length > 19) {
                        displayMessage('Invalid card number length.', 'error');
                        isValid = false;
                    } else if (!/^(0[1-9]|1[0-2])\/?([0-9]{2})$/.test(cardExpiry)) {
                        displayMessage('Expiry date must be MM/YY format (e.g., 12/25).', 'error');
                        isValid = false;
                    } else {
                        const currentYear = new Date().getFullYear() % 100;
                        const currentMonth = new Date().getMonth() + 1;
                        const expiryMonth = parseInt(cardExpiry.substring(0, 2), 10);
                        const expiryYear = parseInt(cardExpiry.substring(2, 4), 10);

                        if (expiryYear < currentYear || (expiryYear === currentYear && expiryMonth < currentMonth)) {
                            displayMessage('Expiry date cannot be in the past.', 'error');
                            isValid = false;
                        }
                    }
                    if (!/^\d{3,4}$/.test(cardCVV)) {
                        displayMessage('CVV must be 3 or 4 digits.', 'error');
                        isValid = false;
                    }
                } else if (activePaymentMethod === 'obw') {
                    const selectedBank = document.getElementById('obwBank').value;
                    if (!selectedBank) {
                        displayMessage('Please select a bank for Online Banking.', 'error');
                        isValid = false;
                    }
                }
                
                if (isValid) {
                    // Call backend to initiate payment
                    initiatePaymentBackend();
                    currentStep++; // Move to processing step after initiating backend call
                }
            }

            if (isValid) {
                showStep(currentStep);
            }
        }

        function prevStep() {
            displayMessage('', 'info'); 
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
                if (currentStep < 3) {
                    const iframe = document.getElementById('cardzoneIframe');
                    iframe.style.display = 'none';
                    iframe.src = 'about:blank';
                    document.getElementById('cancelButton').style.display = 'none';
                    if (currentStep === 2) {
                         document.getElementById('payNowButton').style.display = 'block';
                    }
                }
            }
        }

        function switchPaymentMethod(method) {
            activePaymentMethod = method;

            document.querySelectorAll('.payment-option-button').forEach(button => {
                if (button.dataset.method === method) {
                    button.classList.add('active-option');
                    button.classList.remove('border-gray-300', 'text-gray-700'); 
                } else {
                    button.classList.remove('active-option');
                    button.classList.add('border-gray-300', 'text-gray-700'); 
                }
            });

            document.querySelectorAll('.payment-details-section').forEach(section => {
                if (section.id === `${method}-details-section`) {
                    section.classList.remove('hidden');
                } else {
                    section.classList.add('hidden');
                }
            });

            const iframe = document.getElementById('cardzoneIframe');
            iframe.style.display = 'none';
            iframe.src = 'about:blank';
            document.getElementById('cancelButton').style.display = 'none';
            displayMessage('', 'info'); 
        }

        // --- Message Display Function ---
        function displayMessage(message, type = 'info') {
            const messageBoxId = `message${currentStep}`;
            const messageBox = document.getElementById(messageBoxId);
            
            if (!messageBox) {
                console.error(`Message box with ID ${messageBoxId} not found.`);
                return;
            }

            messageBox.textContent = message;
            messageBox.className = 'message-box p-4 rounded-lg mt-5 border text-center font-medium'; 
            if (type === 'info') {
                messageBox.classList.add('bg-blue-100', 'text-blue-800', 'border-blue-300');
            } else if (type === 'success') {
                messageBox.classList.add('bg-green-100', 'text-green-800', 'border-green-300');
            } else if (type === 'error') {
                messageBox.classList.add('bg-red-100', 'text-red-800', 'border-red-300');
            }
            messageBox.style.display = 'block';
        }

        // --- Initiate Payment by calling Laravel Backend ---
        async function initiatePaymentBackend() {
            displayMessage('Sending payment details to our secure server...', 'info');

            const merchantId = document.getElementById('merchantId').value;
            const purchaseAmount = parseFloat(document.getElementById('purchaseAmount').value) * 100; 
            const purchaseCurrency = '458'; 

            let payload = {
                payment_method: activePaymentMethod,
                merchant_id: merchantId,
                purchase_amount: purchaseAmount,
                purchase_currency: purchaseCurrency,
            };

            // Add donation data if this is a donation payment
            const donationId = document.getElementById('donationId');
            if (donationId && donationId.value) {
                payload.donation_id = donationId.value;
            }

            if (activePaymentMethod === 'card') {
                payload.card_number = document.getElementById('cardNumber').value.replace(/\s/g, '');
                payload.card_expiry = document.getElementById('cardExpiry').value.replace(/\//g, '');
                payload.card_cvv = document.getElementById('cardCVV').value;
                payload.card_holder_name = document.getElementById('cardHolderName').value;
            } else if (activePaymentMethod === 'obw') {
                payload.obw_bank = document.getElementById('obwBank').value;
            }
            // QR payment doesn't need extra fields from frontend for initiation

            try {
                const response = await fetch('/payment/api/initiate-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Laravel CSRF token
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (result.success) {
                    displayMessage('Received payment initiation details from server. Redirecting for authentication...', 'success');
                    // Dynamically create and submit the form to Cardzone's iframe
                    submitFormToIframe(result.form.action, result.form.fields, result.form.target);
                } else {
                    displayMessage(`Payment initiation failed: ${result.message}`, 'error');
                    // Revert to previous step or show error on current step
                    currentStep = 2; // Stay on details step
                    showStep(currentStep);
                }
            } catch (error) {
                console.error('Error initiating payment with backend:', error);
                displayMessage(`An error occurred: ${error.message}. Please try again.`, 'error');
                currentStep = 2; // Stay on details step
                showStep(currentStep);
            }
        }

        function submitFormToIframe(actionUrl, fields, targetFrame) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = actionUrl;
            form.target = targetFrame;

            for (const key in fields) {
                if (fields.hasOwnProperty(key)) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = fields[key];
                    form.appendChild(input);
                }
            }

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);

            // Show iframe and cancel button
            document.getElementById('cardzoneIframe').style.display = 'block';
            document.getElementById('cancelButton').style.display = 'block';
            document.getElementById('payNowButton').style.display = 'none'; // Hide Pay Now button
        }

        // --- Cancel Payment Function ---
        function cancelPayment() {
            const iframe = document.getElementById('cardzoneIframe');
            iframe.style.display = 'none'; 
            iframe.src = 'about:blank'; 
            document.getElementById('cancelButton').style.display = 'none'; 
            document.getElementById('payNowButton').style.display = 'block'; 
            displayMessage('Payment cancelled by user.', 'info');
            currentStep = 1; 
            showStep(currentStep);
        }

        // --- Utility Functions ---
        function generateUniqueId() {
            return Date.now().toString() + Math.floor(Math.random() * 1000000000000).toString().padStart(12, '0');
        }

        function getFormattedTimestamp() {
            const now = new Date();
            const year = String(now.getFullYear()).padStart(4, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            return `${year}${month}${day}${hours}${minutes}${seconds}`;
        }

        // Optional: Listen for iframe load events (for debugging/status updates)
        document.getElementById('cardzoneIframe').onload = function() {
            console.log('Iframe loaded. This might be a 3DS challenge or a redirection.');
            displayMessage('Secure authentication initiated. Please follow instructions in the iframe.', 'info');
        };

        // Basic input formatting for card number and expiry
        document.getElementById('cardNumber').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); 
            value = value.substring(0, 19); 
            e.target.value = value.replace(/(.{4})/g, '$1 ').trim(); 
        });

        document.getElementById('cardExpiry').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });

    </script>
</body>
</html> 