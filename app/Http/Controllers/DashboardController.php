<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ongoingTasks = Task::whereIn('status_id', [1, 2])->count();
        $completedTasks = Task::where('status_id', 3)->count();
        $overdueTasks = Task::where('due_date', '<', now())->where('status_id', '!=', 3)->count();

        return view('dashboard', compact('ongoingTasks', 'completedTasks', 'overdueTasks'));
    }
}
