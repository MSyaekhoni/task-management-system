<?php

namespace Database\Factories;

use App\Models\CategoryTask;
use App\Models\PriorityTask;
use App\Models\Task;
use App\Models\User;
use App\Models\StatusTask;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'title' => $title,
            'slug' => $this->generateUniqueSlug($title),
            'creator_id' => User::factory(),
            'description' => fake()->text(),
            'category_id' => CategoryTask::factory(),
            'priority_id' => PriorityTask::factory(),
            'status_id' => StatusTask::factory(),
            'due_date' => fake()->dateTimeBetween('now', '+1 month')
        ];
    }

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = Task::where('slug', 'LIKE', "{$slug}%")->count();
        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
