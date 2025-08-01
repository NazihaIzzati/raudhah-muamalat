#!/bin/bash

# Paynet Log Monitor Script
# Usage: ./scripts/monitor-paynet-logs.sh [log_type]

LOG_TYPE=${1:-"all"}

echo "🔍 Paynet Log Monitor"
echo "====================="
echo ""

case $LOG_TYPE in
    "main"|"paynet")
        echo "📋 Monitoring: paynet.log (Main Paynet Log)"
        echo "Press Ctrl+C to stop"
        echo ""
        tail -f storage/logs/paynet.log
        ;;
    "transactions"|"txn")
        echo "💳 Monitoring: paynet_transactions.log (Transaction Details)"
        echo "Press Ctrl+C to stop"
        echo ""
        tail -f storage/logs/paynet_transactions.log
        ;;
    "debug")
        echo "🐛 Monitoring: paynet_debug.log (Debug Information)"
        echo "Press Ctrl+C to stop"
        echo ""
        tail -f storage/logs/paynet_debug.log
        ;;
    "all")
        echo "📊 Monitoring: All Paynet Logs"
        echo "Press Ctrl+C to stop"
        echo ""
        tail -f storage/logs/paynet.log storage/logs/paynet_transactions.log storage/logs/paynet_debug.log
        ;;
    *)
        echo "Usage: $0 [log_type]"
        echo ""
        echo "Available log types:"
        echo "  main, paynet     - Main Paynet log (payment requests, callbacks)"
        echo "  transactions, txn - Transaction details (complete payloads)"
        echo "  debug            - Debug information (keys, config, errors)"
        echo "  all              - All Paynet logs (default)"
        echo ""
        echo "Examples:"
        echo "  $0 main          # Monitor main Paynet log"
        echo "  $0 transactions  # Monitor transaction details"
        echo "  $0 debug         # Monitor debug information"
        echo "  $0 all           # Monitor all logs"
        ;;
esac 