@extends('layouts.master')

@section('title', $status === 'success' ? 'Payment Successful' : 'Payment Failed')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-lg w-full text-center">
        @if($status === 'success')
            <div class="text-green-600 text-5xl mb-4">✔️</div>
            <h1 class="text-2xl font-bold mb-2">Thank you for your donation!</h1>
            <p class="mb-4">Your payment was successful.</p>
        @else
            <div class="text-red-600 text-5xl mb-4">❌</div>
            <h1 class="text-2xl font-bold mb-2">Payment Failed</h1>
            <p class="mb-4">Unfortunately, your payment could not be processed.</p>
            @if(!empty($message))
                <div class="bg-red-100 text-red-800 rounded p-3 mb-4">{{ $message }}</div>
            @endif
        @endif
        @if($donation)
            <div class="bg-gray-100 rounded p-4 mt-4 text-left">
                <div><strong>Campaign:</strong> {{ $donation->campaign->title ?? '-' }}</div>
                <div><strong>Amount:</strong> RM {{ number_format($donation->amount, 2) }}</div>
                <div><strong>Donor Name:</strong> {{ $donation->donor_name }}</div>
                <div><strong>Donor Email:</strong> {{ $donation->donor_email }}</div>
                <div><strong>Status:</strong> {{ ucfirst($donation->payment_status) }}</div>
            </div>
        @endif
        <a href="{{ route('home') }}" class="mt-8 inline-block bg-primary-600 text-white px-6 py-3 rounded-lg font-semibold shadow hover:bg-primary-700 transition">Back to Home</a>
    </div>
</div>
@endsection 