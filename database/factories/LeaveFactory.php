<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\leave>
 */
class LeaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'description' => $this->faker->sentence(),
            'leave_date' => $this->faker->dateTimeBetween('today', '+1 month')->format('Y-m-d'),
            'is_approved' => $this->faker->boolean(50), // 50% chance of being approved
        ];
    }
}
