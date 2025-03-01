<?php

namespace Database\Seeders;

use App\Models\CategoryTask;
use App\Models\PriorityTask;
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
        $this->call([PriorityTaskSeeder::class]);
        $this->call([StatusTaskSeeder::class]);

        $admin = User::create([
            'name' => 'Mantan Intel',
            'email' => 'admin@admin.com',
            'password' => bcrypt('pass1234')
        ]);

        Task::factory(50)->recycle([
            User::factory(6)->create(),
            $admin,
            CategoryTask::factory(4)->create(),
            PriorityTask::all(),
            StatusTask::all(),
        ])->create();
    }
}
