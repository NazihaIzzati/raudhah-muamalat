@extends('layouts.admin')

@section('title', 'Paynet Debug Logs')

@section('content')
<div class="space-y-6 font-sans">
    <!-- Main Content with Enhanced Design -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <!-- Enhanced Header Section -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-gradient-to-br from-[#FE8000] to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#FE8000]">Paynet Debug Logs</h3>
                        <p class="text-sm text-[#FE8000] mt-1">Detailed logs and transaction history</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                    <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-xl">
                        <span class="text-[#FE8000] font-semibold">{{ now()->format('M d, Y H:i:s') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="p-6 border-b">
            <div class="flex flex-col md:flex-row md:items-end md:space-x-4 space-y-4 md:space-y-0">
                <div>
                    <label for="logType" class="block text-sm font-medium text-gray-700 mb-2">Log Type</label>
                    <select id="logType" onchange="changeLogType()" class="block w-full text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FE8000] focus:border-transparent py-2 px-3 bg-white transition-all duration-200">
                        <option value="main" {{ request('type') == 'main' ? 'selected' : '' }}>Main Logs</option>
                        <option value="transactions" {{ request('type') == 'transactions' ? 'selected' : '' }}>Transaction Logs</option>
                        <option value="debug" {{ request('type') == 'debug' ? 'selected' : '' }}>Debug Logs</option>
                    </select>
                </div>
                <div>
                    <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="statusFilter" onchange="changeStatusFilter()" class="block w-full text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FE8000] focus:border-transparent py-2 px-3 bg-white transition-all duration-200">
                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>All Status</option>
                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                        <option value="error" {{ request('status') == 'error' ? 'selected' : '' }}>Error</option>
                        <option value="warning" {{ request('status') == 'warning' ? 'selected' : '' }}>Warning</option>
                        <option value="info" {{ request('status') == 'info' ? 'selected' : '' }}>Info</option>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="button" onclick="refreshLogs()" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#FE8000] to-orange-600 hover:from-[#FE8000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FE8000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh Logs
                    </button>
                    <button type="button" onclick="downloadLogs()" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#FE8000] to-orange-600 hover:from-[#FE8000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FE8000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download
                    </button>
                </div>
            </div>
        </div>

        <!-- Log Content -->
        <div class="p-6 border-gray-200 bg-gray-50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                <!-- Search Bar -->
                <div class="relative flex-1">
                    <input
                        id="logSearch"
                        type="text"
                        class="w-full pl-10 pr-10 py-2 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                        placeholder="Search logs by transaction ID, message, or action…"
                        value="{{ $filter ?? '' }}"
                        onkeydown="if(event.key==='Enter'){changeLogFilter()}"
                        aria-label="Search logs"
                    />
                    <span class="absolute left-3 top-2.5 text-[#FE8000]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    @if(!empty($filter))
                    <button onclick="clearLogFilter()" class="absolute right-3 top-2.5 text-gray-400 hover:text-red-500" aria-label="Clear search">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    @endif
                </div>
            </div>
            <div class="overflow-x-auto rounded-xl shadow border border-gray-200 bg-white">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0 z-10 shadow-sm">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7a2 2 0 002 2z"/></svg>
                                    Date/Time
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">Level</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">Transaction ID</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 tracking-wider">Action/Message</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($logs as $index => $log)
                        @php
                            $datetime = '';
                            $level = '';
                            $transactionId = '';
                            $action = '';
                            $message = '';
                            $data = '';
                            $preview = '';
                            $jsonTransactionId = '';
                            
                            // Parse Laravel log format: [2025-07-30 18:27:46] local.INFO: Message {"data": "value"}
                            if (preg_match('/\[(.*?)\]\s*(\w+)\.(\w+):\s*(.*?)(?:\s*\{.*\})?$/', $log, $m)) {
                                $datetime = $m[1];
                                $level = strtoupper($m[3]);
                                $message = trim($m[4]);
                                
                                // Extract JSON data if present
                                if (preg_match('/\{.*\}$/', $log, $jsonMatch)) {
                                    $data = $jsonMatch[0];
                                    $json = json_decode($data, true);
                                    if (is_array($json) && isset($json['transaction_id'])) {
                                        $jsonTransactionId = $json['transaction_id'];
                                    }
                                }
                            }
                            
                            // Try to extract transaction ID from message
                            if (preg_match('/transaction_id["\']?\s*:\s*["\']?([^"\',\s]+)/', $log, $txnMatch)) {
                                $transactionId = $txnMatch[1];
                            }
                            
                            $displayAction = $message ?: Str::limit(strip_tags($log), 60);
                        @endphp
                        <tr class="group hover:bg-blue-50 transition cursor-pointer even:bg-gray-50" onclick="showLogModal({{ $index }})">
                            <td class="px-4 py-3 text-xs font-mono text-gray-700">
                                <span title="{{ $datetime }}">
                                    <svg class="inline w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7a2 2 0 002 2z"/></svg>
                                    @php
                                        $formattedDatetime = $datetime;
                                        if ($datetime) {
                                            try {
                                                $formattedDatetime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('d/m/Y h:i A');
                                            } catch (Exception $e) {
                                                $formattedDatetime = $datetime;
                                            }
                                        }
                                    @endphp
                                    {{ $formattedDatetime }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold
                                    @if(strtoupper($level)=='SUCCESS' || str_contains(strtolower($message), 'success')) bg-green-100 text-green-700
                                    @elseif(strtoupper($level)=='ERROR' || str_contains(strtolower($message), 'error')) bg-red-100 text-red-700
                                    @elseif(strtoupper($level)=='WARNING' || str_contains(strtolower($message), 'warning')) bg-yellow-100 text-yellow-700
                                    @elseif(str_contains(strtolower($message), 'fpx')) bg-blue-100 text-blue-700
                                    @elseif(str_contains(strtolower($message), 'callback')) bg-purple-100 text-purple-700
                                    @else bg-gray-100 text-gray-700
                                    @endif">
                                    {{ strtoupper($level) ?: 'INFO' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 font-mono text-xs text-gray-600 truncate max-w-[120px]" title="{{ $jsonTransactionId ?: $transactionId }}">
                                {{ Str::limit($jsonTransactionId ?: $transactionId, 12) }}
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-900 font-semibold">{{ $displayAction }}</td>
                            <td class="px-4 py-3 text-right">
                                <i class="bx bx-detail text-gray-400 group-hover:text-blue-500 transition-colors text-lg cursor-pointer" aria-label="View Details" title="View Details"></i>
                            </td>
                        </tr>
                        <script>
                            window._logData = window._logData || [];
                            window._logData[{{ $index }}] = @json($log);
                        </script>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-400 text-sm">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span>No logs available.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tailwind Modal for Log Details -->
<div id="logModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40 flex items-center justify-center font-sans">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 p-8 relative overflow-y-auto max-h-[90vh]">
        <button onclick="closeLogModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 focus:outline-none">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h3 class="text-xl font-bold text-gray-900 mb-6">Log Entry Details</h3>
        <pre id="logModalContent" class="bg-gray-900 text-green-400 p-6 rounded-lg font-mono text-sm overflow-x-auto whitespace-pre-wrap max-h-[60vh]">{
}</pre>
    </div>
</div>
@endsection

@push('scripts')
<script>
const logs = window._logData || [];
function changeLogType() {
    const logType = document.getElementById('logType').value;
    const status = document.getElementById('statusFilter').value;
    const params = new URLSearchParams();
    if (logType) params.set('type', logType);
    if (status) params.set('status', status);
    window.location.href = `{{ route('admin.paynet.logs') }}?${params.toString()}`;
}

function changeStatusFilter() {
    const logType = document.getElementById('logType').value;
    const status = document.getElementById('statusFilter').value;
    const params = new URLSearchParams();
    if (logType) params.set('type', logType);
    if (status) params.set('status', status);
    window.location.href = `{{ route('admin.paynet.logs') }}?${params.toString()}`;
}
function refreshLogs() {
    location.reload();
}
function showLogModal(index) {
    let data = logs[index];
    let pretty = '';
    try {
        // Try to pretty-print as JSON if it contains JSON
        if (data.includes('{') && data.includes('}')) {
            let jsonMatch = data.match(/\{[\s\S]*\}/);
            if (jsonMatch) {
                let obj = JSON.parse(jsonMatch[0]);
                pretty = JSON.stringify(obj, null, 2);
            } else {
                pretty = data;
            }
        } else {
            pretty = data;
        }
    } catch (e) {
        // Fallback: show as plain text
        pretty = data;
    }
    document.getElementById('logModalContent').textContent = pretty;
    document.getElementById('logModal').classList.remove('hidden');
}
function closeLogModal() {
    document.getElementById('logModal').classList.add('hidden');
}
function changeLogFilter() {
    const filter = document.getElementById('logSearch').value;
    const params = new URLSearchParams(window.location.search);
    params.set('filter', filter);
    params.set('page', 1);
    window.location.search = params.toString();
}
function clearLogFilter() {
    const params = new URLSearchParams(window.location.search);
    params.delete('filter');
    params.set('page', 1);
    window.location.search = params.toString();
}

function downloadLogs() {
    const logType = document.getElementById('logType').value;
    window.open(`{{ route('admin.paynet.logs.download') }}?type=${logType}`, '_blank');
}
</script>
@endpush 