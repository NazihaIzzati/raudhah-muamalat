<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
            'content' => fake()->optional()->paragraphs(3, true),
            'featured_image' => fake()->optional()->imageUrl(640, 480, 'charity'),
            'goal_amount' => fake()->randomFloat(2, 1000, 100000),
            'raised_amount' => fake()->randomFloat(2, 0, 50000),
            'currency' => 'MYR',
            'start_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'end_date' => fake()->optional()->dateTimeBetween('now', '+6 months'),
            'status' => fake()->randomElement(['draft', 'active', 'completed', 'cancelled']),
            'created_by' => \App\Models\User::factory(),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }

    /**
     * Indicate that the campaign is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'start_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'end_date' => fake()->dateTimeBetween('now', '+6 months'),
        ]);
    }

    /**
     * Indicate that the campaign is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'end_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'current_amount' => fake()->randomFloat(2, $attributes['target_amount'] * 0.8, $attributes['target_amount']),
        ]);
    }

    /**
     * Indicate that the campaign is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
