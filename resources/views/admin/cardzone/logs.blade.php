@extends('layouts.admin')

@section('title', 'Cardzone Debug Logs')

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">Cardzone Debug Logs</h3>
                        <p class="text-sm text-[#fe5000] mt-1">Detailed logs and transaction history</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                    <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-xl">
                        <span class="text-[#fe5000] font-semibold">{{ now()->format('M d, Y H:i:s') }}</span>
                    </div>
                    <a href="{{ route('admin.cardzone.debug') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <div class="h-8 w-8 bg-gradient-to-br from-[#fe5000]/10 to-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="h-4 w-4 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-lg font-semibold text-gray-900">Log Filters</h4>
                    <p class="text-sm text-gray-500">Customize log display and view options</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Log Type Selector -->
                <div>
                    <label for="logType" class="block text-sm font-medium text-gray-700 mb-2">Log Type</label>
                    <select id="logType" onchange="changeLogType()" 
                            class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-2 px-3 bg-white transition-all duration-200 appearance-none">
                        <option value="debug" {{ request('type') == 'debug' ? 'selected' : '' }}>Debug Logs</option>
                        <option value="transaction" {{ request('type') == 'transaction' ? 'selected' : '' }}>Transaction Logs</option>
                    </select>
                </div>

                <!-- Line Count Selector -->
                <div>
                    <label for="logLines" class="block text-sm font-medium text-gray-700 mb-2">Number of Lines</label>
                    <select id="logLines" onchange="changeLogLines()" 
                            class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-2 px-3 bg-white transition-all duration-200 appearance-none">
                        <option value="50" {{ request('lines', 100) == 50 ? 'selected' : '' }}>50 lines</option>
                        <option value="100" {{ request('lines', 100) == 100 ? 'selected' : '' }}>100 lines</option>
                        <option value="200" {{ request('lines', 100) == 200 ? 'selected' : '' }}>200 lines</option>
                        <option value="500" {{ request('lines', 100) == 500 ? 'selected' : '' }}>500 lines</option>
                    </select>
                </div>

                <!-- Refresh Button -->
                <div class="flex items-end">
                    <button type="button" onclick="refreshLogs()" 
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-500/90 hover:to-indigo-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh Logs
                    </button>
                </div>
            </div>
        </div>

        <!-- Log Content -->
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-8 w-8 bg-gradient-to-br from-[#fe5000]/10 to-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="h-4 w-4 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-lg font-semibold text-gray-900">
                            {{ ucfirst(request('type', 'debug')) }} Logs
                        </h4>
                        <p class="text-sm text-gray-500">{{ count($logs) }} entries displayed</p>
                    </div>
                </div>
                
                <div class="flex space-x-2">
                    <button type="button" onclick="copyAllLogs()" 
                            class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Copy All
                    </button>
                    <a href="{{ route('admin.cardzone.debug.download', ['type' => request('type', 'debug')]) }}" 
                       class="inline-flex items-center justify-center px-3 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download
                    </a>
                </div>
            </div>

            @if(count($logs) > 0)
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @foreach($logs as $index => $log)
                    <div class="flex items-start space-x-3 p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-gray-100 transition-all duration-200 cursor-pointer" 
                         onclick="showLogDetails(this, {{ $index }})">
                        <div class="flex-shrink-0 mt-1">
                            @if(strpos($log, '[SUCCESS]') !== false)
                                <div class="h-3 w-3 bg-green-400 rounded-full"></div>
                            @elseif(strpos($log, '[ERROR]') !== false)
                                <div class="h-3 w-3 bg-red-400 rounded-full"></div>
                            @elseif(strpos($log, '[WARNING]') !== false)
                                <div class="h-3 w-3 bg-yellow-400 rounded-full"></div>
                            @else
                                <div class="h-3 w-3 bg-blue-400 rounded-full"></div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600 font-mono">{{ substr($log, 1, 23) }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if(strpos($log, '[SUCCESS]') !== false) bg-green-100 text-green-800
                                    @elseif(strpos($log, '[ERROR]') !== false) bg-red-100 text-red-800
                                    @elseif(strpos($log, '[WARNING]') !== false) bg-yellow-100 text-yellow-800
                                    @else bg-blue-100 text-blue-800
                                    @endif">
                                    @if(strpos($log, '[SUCCESS]') !== false) SUCCESS
                                    @elseif(strpos($log, '[ERROR]') !== false) ERROR
                                    @elseif(strpos($log, '[WARNING]') !== false) WARNING
                                    @else INFO
                                    @endif
                                </span>
                            </div>
                            <p class="text-sm text-gray-900 mt-1 truncate">{{ substr($log, strpos($log, ']') + 2) }}</p>
                            
                            @if(request('type') == 'transaction' && preg_match('/TXN:(\d+)/', $log, $matches))
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-200 text-gray-800">
                                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        TXN: {{ $matches[1] }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-shrink-0">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No logs available</h3>
                    <p class="mt-2 text-sm text-gray-500">There are no {{ request('type', 'debug') }} logs to display.</p>
                    <div class="mt-6">
                        <button type="button" onclick="refreshLogs()" 
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Refresh Logs
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Enhanced Log Details Modal -->
<div class="modal fade" id="logDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Log Entry Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="space-y-4">
                    <!-- Log Header -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div id="logStatusIndicator" class="h-3 w-3 rounded-full"></div>
                            <span id="logStatusBadge" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"></span>
                        </div>
                        <div class="text-sm text-gray-500" id="logTimestamp"></div>
                    </div>
                    
                    <!-- Log Content -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Log Content</label>
                        <div class="bg-gray-900 text-green-400 p-4 rounded-lg font-mono text-sm overflow-x-auto" id="logContent"></div>
                    </div>
                    
                    <!-- Parsed Data (if available) -->
                    <div id="parsedDataSection" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Parsed Data</label>
                        <div class="bg-gray-50 p-4 rounded-lg" id="parsedData"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="copyLogDetails()">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Copy Details
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Log data for modal
let logData = @json($logs);

function changeLogType() {
    const logType = document.getElementById('logType').value;
    const currentLines = document.getElementById('logLines').value;
    window.location.href = `{{ route('admin.cardzone.debug.logs') }}?type=${logType}&lines=${currentLines}`;
}

function changeLogLines() {
    const logType = document.getElementById('logType').value;
    const currentLines = document.getElementById('logLines').value;
    window.location.href = `{{ route('admin.cardzone.debug.logs') }}?type=${logType}&lines=${currentLines}`;
}

function refreshLogs() {
    location.reload();
}

function showLogDetails(button, index) {
    const log = logData[index];
    const modal = $('#logDetailsModal');
    
    // Set status indicator
    const statusIndicator = document.getElementById('logStatusIndicator');
    const statusBadge = document.getElementById('logStatusBadge');
    
    if (log.includes('[SUCCESS]')) {
        statusIndicator.className = 'h-3 w-3 bg-green-400 rounded-full';
        statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800';
        statusBadge.textContent = 'SUCCESS';
    } else if (log.includes('[ERROR]')) {
        statusIndicator.className = 'h-3 w-3 bg-red-400 rounded-full';
        statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800';
        statusBadge.textContent = 'ERROR';
    } else if (log.includes('[WARNING]')) {
        statusIndicator.className = 'h-3 w-3 bg-yellow-400 rounded-full';
        statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800';
        statusBadge.textContent = 'WARNING';
    } else {
        statusIndicator.className = 'h-3 w-3 bg-blue-400 rounded-full';
        statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800';
        statusBadge.textContent = 'INFO';
    }
    
    // Set timestamp
    document.getElementById('logTimestamp').textContent = log.substring(1, 23);
    
    // Set log content
    document.getElementById('logContent').textContent = log;
    
    // Try to parse JSON data if present
    const parsedDataSection = document.getElementById('parsedDataSection');
    const parsedData = document.getElementById('parsedData');
    
    try {
        // Look for JSON data in the log
        const jsonMatch = log.match(/\{.*\}/);
        if (jsonMatch) {
            const jsonData = JSON.parse(jsonMatch[0]);
            parsedData.innerHTML = formatJsonData(jsonData);
            parsedDataSection.classList.remove('hidden');
        } else {
            parsedDataSection.classList.add('hidden');
        }
    } catch (e) {
        parsedDataSection.classList.add('hidden');
    }
    
    modal.modal('show');
}

function formatJsonData(data) {
    let html = '<div class="space-y-2">';
    for (const [key, value] of Object.entries(data)) {
        html += `<div class="flex justify-between py-1 border-b border-gray-200">`;
        html += `<span class="font-medium text-gray-700">${key}:</span>`;
        html += `<span class="text-gray-900">${typeof value === 'object' ? JSON.stringify(value) : value}</span>`;
        html += `</div>`;
    }
    html += '</div>';
    return html;
}

function copyLogDetails() {
    const logContent = document.getElementById('logContent').textContent;
    navigator.clipboard.writeText(logContent).then(() => {
        // Show success message
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Copied!';
        setTimeout(() => {
            button.innerHTML = originalText;
        }, 2000);
    });
}

function copyAllLogs() {
    const logText = logData.join('\n');
    navigator.clipboard.writeText(logText).then(() => {
        // Show success message
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Copied!';
        setTimeout(() => {
            button.innerHTML = originalText;
        }, 2000);
    });
}

// Auto-refresh every 30 seconds
setInterval(() => {
    refreshLogs();
}, 30000);
</script>
@endpush 