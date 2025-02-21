<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\StatusTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // filter berdasarkan search
        if ($request->has('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('title', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm)
                ->orWhere('category', 'like', $searchTerm)
                ->orWhereHas('status', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm);
                });
        }

        // filter berdasarkan status yang dikirim dari dashboard
        if ($request->has('status')) {
            switch ($request->status) {
                case 'ongoing':
                    $query->whereIn('status_id', [1, 2]);
                    break;
                case 'completed':
                    $query->where('status_id', 3);
                    break;
                case 'overdue':
                    $query->where('status_id', '!=', [3])
                        ->where('due_date', '<', now());
                    break;
            }
        }

        $tasks = $query->latest()->paginate(5)->withQueryString();

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
