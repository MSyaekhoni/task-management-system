<?php

namespace Database\Seeders;

use App\Models\PriorityTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriorityTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PriorityTask::create([
            'name' => 'Low',
            'slug' => 'low',
            'color' => 'green'
        ]);
        PriorityTask::create([
            'name' => 'Medium',
            'slug' => 'medium',
            'color' => 'yellow'
        ]);
        PriorityTask::create([
            'name' => 'High',
            'slug' => 'high',
            'color' => 'red'
        ]);
    }
}
