<?php

namespace Database\Seeders;

use App\Models\CategoryTask;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\StatusTask;
use Illuminate\Database\Seeder;
use Database\Seeders\StatusTaskSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([StatusTaskSeeder::class]);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password123')
        ]);

        Task::factory(10)->recycle([
            User::factory(3)->create(),
            $admin,
            CategoryTask::factory(4)->create(),
            StatusTask::all(),
        ])->create();
    }
}
