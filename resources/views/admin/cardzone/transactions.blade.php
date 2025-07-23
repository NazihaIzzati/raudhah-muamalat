@extends('layouts.admin')

@section('title', 'Cardzone Debug Transactions')

@section('content')
<div class="space-y-6 font-sans">
    <!-- Enhanced Header Section -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">Cardzone Debug Transactions</h3>
                        <p class="text-sm text-[#fe5000] mt-1">Detailed view and management of Cardzone payment transactions</p>
                    </div>
                </div>
                <a href="{{ route('admin.cardzone.debug') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 p-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_transactions']) }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Successful</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['successful_transactions']) }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Pending</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['pending_transactions']) }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Failed</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['failed_transactions']) }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Amount</p>
                    <p class="text-2xl font-bold text-gray-900">RM {{ number_format($stats['total_amount'], 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Filter/Search Bar -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <!-- Search Bar -->
                <div class="relative flex-1">
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        class="w-full pl-10 pr-10 py-2 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-[#fe5000] focus:border-transparent text-sm"
                        placeholder="Search by transaction ID, amount, status, method...">
                    <span class="absolute left-3 top-2.5 text-[#fe5000]">
                        <!-- Sparkles icon -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4m0 0V3m0 4l2.5-2.5M5 7L2.5 4.5M19 21v-4m0 0v4m0-4l2.5 2.5M19 17l-2.5 2.5"/></svg>
                    </span>
                </div>
                <!-- Quick Filters -->
                <div class="flex flex-wrap gap-2 mt-2 sm:mt-0">
                    @php $statuses = ['All' => 'all', 'Success' => 'authorized', 'Pending' => 'pending', 'Failed' => 'failed'];
                          $methods = ['All' => 'all', 'Card' => 'card', 'OBW' => 'obw', 'QR' => 'qr']; @endphp
                    @foreach($statuses as $label => $val)
                    <button type="button" onclick="applyQuickFilter('status', '{{ $val }}')"
                        class="px-3 py-1 rounded-full text-xs font-semibold border transition
                        {{ request('status', 'all') === $val ? 'bg-[#fe5000] text-white border-[#fe5000]' : 'bg-white text-gray-700 border-gray-300 hover:bg-orange-50' }}">
                        {{ $label }}
                    </button>
                    @endforeach
                    @foreach($methods as $label => $val)
                    <button type="button" onclick="applyQuickFilter('payment_method', '{{ $val }}')"
                        class="px-3 py-1 rounded-full text-xs font-semibold border transition
                        {{ request('payment_method', 'all') === $val ? 'bg-[#fe5000] text-white border-[#fe5000]' : 'bg-white text-gray-700 border-gray-300 hover:bg-orange-50' }}">
                        {{ $label }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 sticky top-0 z-10 shadow-sm">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">Transaction ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">Method</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100 font-sans">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-orange-50 even:bg-gray-50 transition group">
                        <td class="px-6 py-4 whitespace-nowrap font-sans text-xs text-gray-700 truncate max-w-[140px]" title="{{ $transaction->transaction_id }}">
                            {{ Str::limit($transaction->transaction_id, 16) }}
                            <div class="text-xs text-gray-400">ID: {{ $transaction->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">RM {{ number_format($transaction->amount, 2) }}</div>
                            <div class="text-xs text-gray-500">{{ $transaction->currency }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                @if($transaction->payment_method === 'card') bg-blue-100 text-blue-800
                                @elseif($transaction->payment_method === 'obw') bg-green-100 text-green-800
                                @else bg-purple-100 text-purple-800
                                @endif">
                                {{ strtoupper($transaction->payment_method) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                @if($transaction->status === 'authorized' || $transaction->status === 'authenticated') bg-green-100 text-green-800
                                @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($transaction->status === 'failed') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                            {{ $transaction->created_at->format('d/m/Y h:i A') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="viewTransactionDetails('{{ $transaction->id }}')" class="text-orange-600 hover:text-orange-900 inline-flex items-center gap-1" title="View Details">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                                View Details
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-500 flex flex-col items-center gap-2">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No transactions found</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by testing a payment.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $transactions->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Transaction Details Modal -->
<div id="transactionModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden font-sans">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 p-8 relative overflow-y-auto max-h-[90vh]">
        <button onclick="closeTransactionModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 focus:outline-none">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h3 id="transactionModalTitle" class="text-xl font-bold text-gray-900 mb-6">Transaction Details</h3>
        <div id="transactionModalBody" class="space-y-6">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function applyQuickFilter(type, value) {
    const params = new URLSearchParams(window.location.search);
    params.set(type, value);
    params.set('page', 1);
    window.location.search = params.toString();
}
function viewTransactionDetails(transactionId) {
    document.getElementById('transactionModalTitle').textContent = 'Loading...';
    document.getElementById('transactionModalBody').innerHTML = '<div class="text-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-orange-600 mx-auto"></div></div>';
    document.getElementById('transactionModal').classList.remove('hidden');
    fetch(`/admin/cardzone/debug/transactions/${transactionId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('transactionModalTitle').textContent = `Transaction: ${data.transaction_id}`;
            let html = `
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <h4 class="text-sm font-semibold text-gray-900">Basic Information</h4>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Transaction ID:</span>
                                <span class="text-sm font-medium">${data.transaction_id}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Amount:</span>
                                <span class="text-sm font-medium">RM ${parseFloat(data.amount).toFixed(2)}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Currency:</span>
                                <span class="text-sm font-medium">${data.currency}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Payment Method:</span>
                                <span class="text-sm font-medium">${data.payment_method.toUpperCase()}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Status:</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    ${data.status === 'authorized' || data.status === 'authenticated' ? 'bg-green-100 text-green-800' :
                                      data.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                      data.status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'}">
                                    ${data.status.charAt(0).toUpperCase() + data.status.slice(1)}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7a2 2 0 002 2z"/></svg>
                            <h4 class="text-sm font-semibold text-gray-900">Timestamps</h4>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Created:</span>
                                <span class="text-sm font-medium">${new Date(data.created_at).toLocaleString()}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Updated:</span>
                                <span class="text-sm font-medium">${new Date(data.updated_at).toLocaleString()}</span>
                            </div>
                        </div>
                    </div>
                    ${data.eci ? `<div class="flex justify-between">
                        <span class="text-sm text-gray-600">ECI:</span>
                        <span class="text-sm font-medium">${data.eci}</span>
                    </div>` : ''}
                    ${data.cardzone_response_data ? `<div>
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            <h4 class="text-sm font-semibold text-gray-900">Cardzone Response</h4>
                        </div>
                        <div class="bg-gray-900 text-green-400 p-3 rounded-lg font-mono text-xs overflow-x-auto max-h-40 overflow-y-auto">
                            ${JSON.stringify(data.cardzone_response_data, null, 2)}
                        </div>
                    </div>` : ''}
                </div>
            `;
            document.getElementById('transactionModalBody').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('transactionModalTitle').textContent = 'Error';
            document.getElementById('transactionModalBody').innerHTML = `
                <div class="text-center py-8">
                    <div class="text-red-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Failed to load transaction details</p>
                </div>
            `;
        });
}
function closeTransactionModal() {
    document.getElementById('transactionModal').classList.add('hidden');
}
</script>
@endpush 