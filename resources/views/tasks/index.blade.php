<x-layout>
    <x-slot:title>
        All Task
    </x-slot:title>

    <x-header-task>
        <x-slot:header>
            @if (session('success'))
            <div id="alert-success"
                class="flex items-center p-2 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <span id="page-title" class="text-xl font-bold text-left">
                {{ session('success') ? '' : 'All Tasks' }}
            </span>
            <script>
                setTimeout(() => {
                    let alertBox = document.getElementById('alert-success');
                    if (alertBox) {
                        alertBox.style.display = 'none'; // Sembunyikan alert
                    }
                    // Tampilkan kembali title "All Tasks"
                    document.getElementById('page-title').innerText = "All Tasks";
                }, 3000); // 3 detik
            </script>
        </x-slot:header>
        <a href="/tasks/create" type="button"
            class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
            Add new task
        </a>
    </x-header-task>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Creator
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Priority
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Due Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                        {{ $task->title }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $task->creator->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ Str::limit($task->description, 80) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $task->category }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $task->priority }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $task->status }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="block">
                            {{ Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                        </span>
                        <span class="block">
                            {{ Carbon\Carbon::parse($task->due_date)->format('H:i') }}
                        </span>
                    </td>
                    <td class="px-3 py-4 flex space-x-2">
                        <a href="{{ route('tasks.edit', $task->id) }}">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-primary-700" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                            </svg>
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white hover:text-red-700" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-4 mx-6">
            {{ $tasks->links() }}
        </div>
    </div>
</x-layout>