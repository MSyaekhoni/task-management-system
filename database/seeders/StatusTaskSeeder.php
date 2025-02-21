<?php

namespace Database\Seeders;

use App\Models\StatusTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusTask::create([
            'name' => 'Pending',
            'slug' => 'pending',
            'color' => 'yellow'
        ]);
        StatusTask::create([
            'name' => 'In Progress',
            'slug' => 'in-progress',
            'color' => 'blue'
        ]);
        StatusTask::create([
            'name' => 'Completed',
            'slug' => 'completed',
            'color' => 'green'
        ]);
    }
}
