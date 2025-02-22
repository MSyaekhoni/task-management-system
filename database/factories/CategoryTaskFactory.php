<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CategoryTask;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryTask>
 */
class CategoryTaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence(3);

        return [
            'name' => $name,
            'slug' => $this->generateUniqueSlug($name)
        ];
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = CategoryTask::where('slug', 'LIKE', "{$slug}%")->count();
        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }
}
