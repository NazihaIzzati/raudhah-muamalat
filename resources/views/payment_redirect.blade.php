<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Payment Gateway</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .redirect-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            margin-bottom: 20px;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            margin: 10px 0;
        }
        .donor-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            text-align: left;
        }
        .donor-info p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="redirect-container">
        <h2>Processing Payment</h2>
        <div class="spinner"></div>
        <p>Please wait while we redirect you to the secure payment gateway...</p>
        
        @if(isset($donationData))
        <div class="amount">RM {{ number_format($donationData['amount'], 2) }}</div>
        <div class="donor-info">
            <p><strong>Donor:</strong> {{ $donationData['donor_name'] }}</p>
            <p><strong>Email:</strong> {{ $donationData['donor_email'] }}</p>
            @if($donationData['donor_phone'])
                <p><strong>Phone:</strong> {{ $donationData['donor_phone'] }}</p>
            @endif
            @if($donationData['message'])
                <p><strong>Message:</strong> {{ $donationData['message'] }}</p>
            @endif
        </div>
        @endif
        
        <p><small>You will be redirected automatically in a few seconds...</small></p>
    </div>

    @if(isset($form))
    <form id="cardzoneForm" method="POST" action="{{ env('CARDZONE_UAT_MPIREQ_URL', 'https://uat.cardzone.com.my/mpireq') }}" style="display: none;">
        @foreach($form['fields'] as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    <script>
        // Debug: Log form data before submission
        console.log('Form data being submitted:', {
            action: '{{ env("CARDZONE_UAT_MPIREQ_URL", "https://uat.cardzone.com.my/mpireq") }}',
            fields: @json($form['fields'] ?? [])
        });
        
        // Auto-submit the form after a short delay
        setTimeout(function() {
            const form = document.getElementById('cardzoneForm');
            if (form) {
                console.log('Submitting form to Cardzone...');
                form.submit();
            } else {
                console.error('Form not found!');
            }
        }, 2000);
    </script>
    @else
    <script>
        console.error('No form data available for submission');
    </script>
    @endif
</body>
</html> 