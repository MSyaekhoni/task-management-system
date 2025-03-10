<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\StatusTask;
use Illuminate\Support\Str;
use App\Models\CategoryTask;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\PriorityTask;
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
                ->orWhereHas('creator', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm);
                })
                ->orWhere('description', 'like', $searchTerm)
                ->orWhereHas('category', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm);
                })
                ->orWhereHas('priority', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm);
                })
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
                    $query->where('status_id', '!=', 3)
                        ->where('due_date', '<', now());
                    break;
            }
        }

        // filter priority & status pada tabel tasks
        $filtersPriority = $request->get('filter_priority', []);
        $filtersStatus = $request->get('filter_status', []);

        // Konversi ke Integer
        $filtersPriority = array_map('intval', $filtersPriority);
        $filtersStatus = array_map('intval', $filtersStatus);

        // Jika ada filter Prioirity, tambahkan kondisi whereIn
        if (!empty($filtersPriority)) {
            $query->whereIn('priority_id', $filtersPriority);
        }

        // Jika ada filter Status, tambahkan kondisi whereIn
        if (!empty($filtersStatus)) {
            $query->whereIn('status_id', $filtersStatus);
        }

        $priorities = PriorityTask::all();
        $statuses = StatusTask::all();
        $tasks = $query->latest()->paginate(5)->withQueryString();

        return view('tasks.index', compact('tasks', 'priorities', 'statuses'));
    }

    public function create()
    {
        $categories = CategoryTask::all();
        $priorities = PriorityTask::all();
        $statuses = StatusTask::all();

        return view('tasks.create', compact('statuses', 'categories', 'priorities'));
    }

    public function store(TaskRequest $request)
    {
        // Cari atau buat kategori baru
        $category = CategoryTask::firstOrCreate(['name' => $request->category_id]);

        Task::create(array_merge(
            $request->validated(),
            [
                'creator_id' => Auth::id(),
                'category_id' => $category->id
            ]
        ));

        return redirect()->route('tasks.index')->with('success', 'New task added successfully.');
    }

    public function show(Task $task)
    {
        // $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        // $task = Task::findOrFail($id);
        $categories = CategoryTask::all();
        $priorities = PriorityTask::all();
        $statuses = StatusTask::all();

        return view('tasks.edit', compact('task', 'categories', 'priorities', 'statuses'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        // Normalisasi nama kategori untuk pencarian yang lebih fleksibel
        $normalizedCategoryName = Str::lower(trim($request->category_id));

        // Coba cari kategori yang mirip
        $category = CategoryTask::whereRaw('LOWER(name) LIKE ?', ["%{$normalizedCategoryName}%"])->first();

        // Jika tidak ditemukan, buat kategori baru
        if (!$category) {
            $category = CategoryTask::create(['name' => ucfirst($normalizedCategoryName)]);
        }
        $task->update(array_merge(
            $request->validated(),
            [
                'creator_id' => Auth::id(),
                'category_id' => $category->id
            ]
        ));

        return redirect()->route('tasks.index')->with('success', "$task->title Task updated successfully.");
    }

    public function destroy(Request $request, Task $task)
    {
        // Tangkap halaman saat ini
        $currentPage = $request->query('page', 1);

        // $task = Task::findOrFail($id);
        $task->delete();

        // Hitung ulang task setelah dihapus
        $totalTask = Task::count();
        $taskPerPage = 5;

        // Hitung halaman terakhir yang tersedia
        $lastPage = ceil($totalTask / $taskPerPage);

        // Redirect ke Halaman yang valid (jika halaman terakhir kosong kembali ke halaman awal)
        $redirectPage = min($currentPage, $lastPage);

        return redirect()->route('tasks.index', ['page' => $redirectPage])->with('success', 'Task deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $currentPage = request('page', 1);

        $request->validate([
            'task_ids' => 'required|array',
            'task_ids.*' => 'exists:tasks,id'
        ]);

        Task::whereIn('id', $request->task_ids)->delete();

        // Cek apakah di currentPage masih ada task
        $remainingTask = Task::paginate(5);

        // Jika sudah tidak ada task dicurrentPage, redirect ke halaman sebelumnya
        if ($remainingTask->isEmpty() && $currentPage > 1) {
            $currentPage--;
        }

        return redirect()->route('tasks.index', ['page' => $currentPage])->with('success', 'Selected tasks deleted successfully');
    }
}
