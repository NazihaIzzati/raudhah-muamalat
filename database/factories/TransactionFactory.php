<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Donation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_id' => 'PNT' . now()->format('YmdHis') . fake()->regexify('[A-Z0-9]{6}') . sprintf('%06d', fake()->numberBetween(1, 999999)),
            'merchant_id' => fake()->numerify('400000000000###'),
            'amount' => fake()->randomFloat(2, 10, 1000),
            'currency' => 'MYR',
            'payment_method' => fake()->randomElement(['card', 'fpx', 'obw', 'qr']),
            'status' => fake()->randomElement(['pending', 'payment_created', 'completed', 'failed']),
            'card_number_masked' => fake()->regexify('\d{4}\*\*\*\*\*\*\d{4}'),
            'card_expiry' => fake()->regexify('\d{2}/\d{2}'),
            'card_holder_name' => fake()->name(),
            'obw_bank_code' => fake()->randomElement(['MAYBANK', 'CIMB', 'PBB', 'RHB']),
            'qr_code_data' => fake()->url(),
            'auth_value' => fake()->regexify('[A-Z0-9]{6}'),
            'eci' => fake()->randomElement(['05', '02', '00']),
            'cardzone_response_data' => [
                'status' => fake()->randomElement(['success', 'failed', 'pending']),
                'transaction_id' => fake()->regexify('[A-Z0-9]{10}'),
                'amount' => fake()->randomFloat(2, 10, 1000)
            ],
            'paynet_response_data' => [
                'status' => fake()->randomElement(['success', 'failed', 'pending']),
                'transaction_id' => fake()->regexify('[A-Z0-9]{10}'),
                'payment_url' => fake()->url(),
                'amount' => fake()->randomFloat(2, 10, 1000)
            ],
            'donation_id' => Donation::factory(),
        ];
    }

    /**
     * Indicate that the transaction is for FPX payment.
     */
    public function fpx(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_method' => 'fpx',
            'status' => 'payment_created',
            'paynet_response_data' => [
                'status' => 'pending',
                'transaction_id' => $attributes['transaction_id'],
                'payment_url' => fake()->url(),
                'amount' => $attributes['amount']
            ]
        ]);
    }

    /**
     * Indicate that the transaction is for card payment.
     */
    public function card(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_method' => 'card',
            'status' => 'key_exchange_completed',
            'cardzone_response_data' => [
                'status' => 'pending',
                'transaction_id' => $attributes['transaction_id'],
                'amount' => $attributes['amount']
            ]
        ]);
    }

    /**
     * Indicate that the transaction is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the transaction failed.
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
        ]);
    }
}
