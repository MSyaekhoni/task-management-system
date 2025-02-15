<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index', ['tasks' => Task::latest()->paginate(5)]);
    }

    public function create()
    {
        return view('tasks.create', ['creators' => User::get()]);
    }

    public function store(TaskRequest $request)
    {
        Task::create($request->validated());

        return redirect()->route('tasks.index')->with('success', 'New task added successfully!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $creators = User::get();

        return view('tasks.edit', compact('task', 'creators'));
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
