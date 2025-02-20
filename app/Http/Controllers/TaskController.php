<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\StatusTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->paginate(5);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $statuses = StatusTask::all();

        return view('tasks.create', compact('statuses'));
    }

    public function store(TaskRequest $request)
    {
        Task::create(array_merge($request->validated(), ['creator_id' => Auth::id()]));

        return redirect()->route('tasks.index')->with('success', 'New task added successfully!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $statuses = StatusTask::all();

        return view('tasks.edit', compact('task', 'statuses'));
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('success', "$task->title Task updated successfully!");
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
