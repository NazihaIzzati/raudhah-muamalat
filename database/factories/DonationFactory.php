<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Campaign;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'campaign_id' => Campaign::factory(),
            'donor_name' => fake()->name(),
            'donor_email' => fake()->safeEmail(),
            'donor_phone' => fake()->phoneNumber(),
            'amount' => fake()->randomFloat(2, 10, 1000),
            'currency' => 'MYR',
            'payment_method' => fake()->randomElement(['card', 'fpx', 'obw', 'qr']),
            'payment_status' => fake()->randomElement(['pending', 'completed', 'failed']),
            'message' => fake()->optional()->sentence(),
            'is_anonymous' => fake()->boolean(30),
            'transaction_id' => fake()->regexify('[A-Z0-9]{10}'),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }

    /**
     * Indicate that the donation is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'completed',
        ]);
    }

    /**
     * Indicate that the donation is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_status' => 'pending',
        ]);
    }

    /**
     * Indicate that the donation is anonymous.
     */
    public function anonymous(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_anonymous' => true,
        ]);
    }

    /**
     * Indicate that the donation uses FPX payment.
     */
    public function fpx(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_method' => 'fpx',
            'payment_status' => 'pending',
        ]);
    }

    /**
     * Indicate that the donation uses card payment.
     */
    public function card(): static
    {
        return $this->state(fn (array $attributes) => [
            'payment_method' => 'card',
            'payment_status' => 'pending',
        ]);
    }
}
