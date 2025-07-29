# Transaction Duplicate Constraint Violation Fix

## Issue Description

The card payment flow was returning the error:
```json
{
  "success": false,
  "message": "Payment processing failed. Please try again.",
  "error": "SQLSTATE[23000]: Integrity constraint violation: 19 UNIQUE constraint failed: transactions.transaction_id"
}
```

## Root Cause Analysis

The issue was a **UNIQUE constraint violation** on the `transaction_id` field in the `transactions` table. This occurred because:

1. **Key Exchange** creates a transaction record with `transaction_id = "3670849266"`
2. **Payment Processing** tries to create another transaction record with the same `transaction_id = "3670849266"`
3. **Database** rejects the second insert due to UNIQUE constraint on `transaction_id`

## The Problem

In the `initiatePayment` method, the code was **always creating a new transaction record** even when a transaction with the same `transaction_id` already existed from the key exchange:

```php
// ❌ PROBLEM: Always creates new transaction
$transaction = Transaction::create([
    'transaction_id' => $transactionId, // Same ID as key exchange
    'merchant_id' => $merchantId,
    'amount' => $purchaseAmount / 100,
    'currency' => $purchaseCurrency,
    'payment_method' => $paymentMethod,
    'status' => 'pending',
    // ... other fields
]);
```

## The Solution

### 1. Check for Existing Transaction

```php
// ✅ SOLUTION: Check if transaction already exists
$existingTransaction = Transaction::where('transaction_id', $transactionId)->first();

if ($existingTransaction) {
    // Update existing transaction with payment details
    $transaction = $existingTransaction;
    $transaction->update([
        'merchant_id' => $merchantId,
        'amount' => $purchaseAmount / 100,
        'currency' => $purchaseCurrency,
        'payment_method' => $paymentMethod,
        'card_number_masked' => $paymentMethod === 'card' ? \Illuminate\Support\Str::mask($request->input('card_number'), '*', 6, 4) : null,
        'card_expiry' => $paymentMethod === 'card' ? $request->input('card_expiry') : null,
        'card_holder_name' => $paymentMethod === 'card' ? $request->input('card_holder_name') : null,
        'obw_bank_code' => $paymentMethod === 'obw' ? $request->input('obw_bank') : null,
        'donation_id' => $donationId,
    ]);
    Log::info('Updated existing transaction for payment', [
        'transactionId' => $transactionId,
        'previousStatus' => $existingTransaction->status
    ]);
} else {
    // Create new transaction (for non-card payments or new transactions)
    $transaction = Transaction::create([
        'transaction_id' => $transactionId,
        'merchant_id' => $merchantId,
        'amount' => $purchaseAmount / 100,
        'currency' => $purchaseCurrency,
        'payment_method' => $paymentMethod,
        'status' => 'pending',
        'card_number_masked' => $paymentMethod === 'card' ? \Illuminate\Support\Str::mask($request->input('card_number'), '*', 6, 4) : null,
        'card_expiry' => $paymentMethod === 'card' ? $request->input('card_expiry') : null,
        'card_holder_name' => $paymentMethod === 'card' ? $request->input('card_holder_name') : null,
        'obw_bank_code' => $paymentMethod === 'obw' ? $request->input('obw_bank') : null,
        'donation_id' => $donationId,
    ]);
    Log::info('Created new transaction for payment', [
        'transactionId' => $transactionId
    ]);
}
```

## Complete Flow After Fix

### 1. Key Exchange (Creates Transaction)
```php
// PaymentController::performKeyExchange()
$transaction = Transaction::create([
    'transaction_id' => $transactionId, // e.g., "3670849266"
    'status' => 'key_exchange_pending',
    // ... other fields
]);

// After successful key exchange
$transaction->update(['status' => 'key_exchange_completed']);
```

### 2. Payment Processing (Updates Existing Transaction)
```php
// PaymentController::initiatePayment()
$transactionId = $request->input('transaction_id'); // "3670849266"

// ✅ Check if transaction already exists
$existingTransaction = Transaction::where('transaction_id', $transactionId)->first();

if ($existingTransaction) {
    // ✅ Update existing transaction instead of creating new one
    $transaction = $existingTransaction;
    $transaction->update([
        'merchant_id' => $merchantId,
        'amount' => $purchaseAmount / 100,
        'card_number_masked' => $maskedCardNumber,
        'card_holder_name' => $cardHolderName,
        // ... other payment details
    ]);
}
```

## Testing Results

### Before Fix
- ❌ **UNIQUE constraint violation**: `SQLSTATE[23000]: Integrity constraint violation: 19 UNIQUE constraint failed: transactions.transaction_id`
- ❌ **Payment processing failed**: Transaction creation blocked by database constraint
- ❌ **Duplicate records**: Attempted to create multiple records with same `transaction_id`

### After Fix
- ✅ **No constraint violation**: Transaction updated instead of created
- ✅ **Payment processing succeeds**: Existing transaction updated with payment details
- ✅ **Single record**: Only one transaction record per `transaction_id`
- ✅ **Proper flow**: Key exchange → Update Transaction → Payment Processing

## Verification Commands

```bash
# Test the duplicate constraint fix
php test_transaction_duplicate_fix.php

# Test complete payment flow
php test_complete_card_payment_flow.php

# Test original verification
php test_card_payment_flow_verification.php
```

## Database Schema

The `transactions` table has a UNIQUE constraint on `transaction_id`:

```sql
CREATE TABLE transactions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    transaction_id VARCHAR(50) UNIQUE NOT NULL, -- ✅ UNIQUE constraint
    merchant_id VARCHAR(50) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency VARCHAR(3) NOT NULL,
    payment_method VARCHAR(10) NOT NULL,
    status VARCHAR(50) NOT NULL,
    -- ... other fields
);
```

## Summary

The fix ensures that:

1. **Key Exchange** creates a transaction record with unique `transaction_id`
2. **Payment Processing** finds the existing transaction and updates it
3. **No Duplicates** are created, respecting the UNIQUE constraint
4. **Proper Flow** is maintained: Key Exchange → Update Transaction → Payment Processing

The transaction duplicate constraint violation is now **resolved** ✅

## Related Issues Fixed

This fix also resolves:
- ✅ **Key exchange error**: `"Key exchange must be completed before payment"`
- ✅ **Transaction duplicate constraint**: `UNIQUE constraint failed: transactions.transaction_id`
- ✅ **Payment processing failure**: `"Payment processing failed. Please try again."`

The card payment flow now works correctly end-to-end! 🎉 