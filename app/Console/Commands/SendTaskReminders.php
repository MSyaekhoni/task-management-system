<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\Message;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class SendTaskReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim pengingat otomatis untuk tugas yang mendekati tenggat waktu';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('due_date', '<=', Carbon::now()->addDay())->get();

        foreach ($tasks as $task) {
            $dueDate = Carbon::parse($task->due_date); // Konversi ke Carbon
            $formattedDate = $dueDate->format('M d, Y | H:i'); // Format tanggal
            $relativeTime = $dueDate->diffForHumans(); // Misalnya: "3 hari lagi"

            $message = "<strong>Reminder:</strong> The Task <strong>'{$task->title}'</strong> is due on <strong>{$formattedDate}</strong> - ({$relativeTime})";

            Message::create([
                'task_id' => $task->id,
                'creator_id' => $task->creator_id,
                'message' => $message,
                'sent_at' => now(),
            ]);

            $this->info("Reminder dikirim untuk task: {$task->title}");
        }
    }
}
