@extends('layouts.master')

@section('title', 'Redirecting to Payment Gateway')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-lg w-full text-center">
        <div class="text-blue-600 text-5xl mb-4">🔄</div>
        <h1 class="text-2xl font-bold mb-2">Redirecting to Payment Gateway</h1>
        <p class="mb-4">Please wait while we redirect you to the secure payment gateway...</p>
        
        <div class="bg-blue-100 text-blue-800 rounded p-4 mb-6">
            <div class="text-sm">
                <div><strong>Transaction ID:</strong> {{ $transaction_id }}</div>
                <div><strong>Amount:</strong> RM {{ number_format($amount, 2) }}</div>
                <div><strong>Payment Method:</strong> {{ ucfirst($payment_method) }}</div>
            </div>
        </div>
        
        <div class="flex items-center justify-center space-x-2 mb-6">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
            <span class="text-gray-600">Processing payment...</span>
        </div>
        
        <form id="cardzone-form" method="POST" action="{{ $redirect_url }}" style="display: none;">
            @foreach($form_data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>
        
        <div class="text-sm text-gray-500 mt-4">
            <p>You will be redirected to the Cardzone 3DS authentication page.</p>
            <p>Please complete the authentication to proceed with your payment.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit the form after a short delay
    setTimeout(function() {
        document.getElementById('cardzone-form').submit();
    }, 2000);
    
    // Fallback: submit form if user clicks anywhere
    document.addEventListener('click', function() {
        document.getElementById('cardzone-form').submit();
    });
});
</script>
@endsection 