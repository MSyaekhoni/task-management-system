<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusTask>
 */
class StatusTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Pending', 'In Progress', 'Completed']),
            'slug' => fake()->unique()->randomElement(['pending', 'in-progress', 'completed']),
        ];
    }
}
