<x-layout>
    <x-slot:title>
        All Task
    </x-slot:title>

    <x-header-task>
        <x-slot:header>
            <span class="text-xl font-bold text-left dark:text-gray-50">
                @if(request('status') == 'ongoing') On Going Tasks
                @elseif(request('status') == 'completed') Completed Tasks
                @elseif(request('status') == 'overdue') Overdue Tasks
                @elseif(request()->has('search')) Search results for "{{ request('search') }}"
                @else All Tasks
                @endif
            </span>
        </x-slot:header>

        <x-slot:alert>
            @if (session()->has('success'))
            <x-alert>
                <x-slot:status>
                    {{ session('success') }}
                </x-slot:status>
            </x-alert>
            @endif
        </x-slot:alert>

        <x-primary-link-button href="{{ route('tasks.create') }}">
            {{ __('Add new task') }}
        </x-primary-link-button>

    </x-header-task>
    <div class="relative overflow-x-auto shadow dark:shadow-gray-800 sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-50">
            <thead class="text-xs text-gray-700 dark:text-gray-50 uppercase bg-gray-50 dark:bg-gray-800">
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
                @forelse ($tasks as $task)
                <tr class="bg-white dark:bg-gray-800 border-b border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                        {{ Str::limit($task->title, 55) }}
                    </th>
                    <td class="px-6 py-4">
                        {{ Str::limit($task->creator->name, 55) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ Str::limit($task->description, 55) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ Str::limit($task->category->name, 55) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="bg-{{ $task->priority->color }}-500 rounded-md block w-16 text-center text-white font-medium">
                            {{ $task->priority->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap flex items-center gap-2">
                        <span class="bg-{{ $task->status->color }}-500 w-3 h-3 rounded-full block"></span>
                        <span class="block">
                            {{ $task->status->name }}
                        </span>
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
                        <a href="{{ route('tasks.show', $task->id) }}">
                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-50 hover:text-primary-700"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2"
                                    d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                        <a href="{{ route('tasks.edit', $task->id) }}">
                            <svg class="w-6 h-6 text-gray-800 dark:text-gray-50 hover:text-primary-700"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
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
                                <svg class="w-6 h-6 text-gray-800 dark:text-gray-50 hover:text-red-700"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <p class="font-medium text-base mb-4">Task not found!</p>
                        <x-secondary-link-button href="{{ route('tasks.index') }}">
                            {{ __('Back to All Tasks') }}
                        </x-secondary-link-button>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="my-4 mx-6">
            {{ $tasks->links() }}
        </div>
    </div>
</x-layout>