<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\SendTaskReminders;

// Jalankan setiap hari jam 08:00 pagi
// Schedule::command(SendTaskReminders::class)->dailyAt('08:00');

Schedule::command(SendTaskReminders::class)->everyMinute();

// Jika ingin menjalankan tiap menit (untuk testing)
// Schedule::command(SendTaskReminders::class)->everyMinute();


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
