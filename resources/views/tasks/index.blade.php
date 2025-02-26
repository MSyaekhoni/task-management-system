<x-layout>
    <x-slot:title>
        {{ __('All Tasks') }}
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
    </x-header-task>

    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
        <div class="w-full flex p-4 items-center justify-end">
            <div class="flex items-center space-x-3 w-auto">
                <x-primary-link-button href="{{ route('tasks.create') }}">
                    {{ __('Add new task') }}
                </x-primary-link-button>
                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                    class="flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400"
                        viewbox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd" />
                    </svg>
                    Filter
                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
                <div id="filterDropdown" class="hidden z-10 w-auto p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    <ul class="space-y-2" aria-labelledby="filterDropdownButton">
                        <form id="filterForm" action="{{ route('tasks.index') }}" method="GET">
                            <div class="grid grid-col-1 md:grid-cols-2 space-y-2 md:space-y-0 md:space-x-2">
                                <div>
                                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose priority
                                    </h6>
                                    @foreach ($priorities as $priority)
                                    <li class="flex items-center">
                                        <input id="filter_priority_{{ $priority->id }}" name="filter_priority[]"
                                            type="checkbox" value="{{ $priority->id }}"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            {{ in_array($priority->id, request()->get('filter_priority', [])) ?
                                        'checked' : '' }}
                                        onChange="document.getElementById('filterForm').submit();">
                                        <label for="filter_priority_{{ $priority->id }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $priority->name}}
                                        </label>
                                    </li>
                                    @endforeach
                                </div>
                                <div>
                                    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose status
                                    </h6>
                                    @foreach ($statuses as $status)
                                    <li class="flex items-center">
                                        <input id="filter_status_{{ $status->id }}" name="filter_status[]"
                                            type="checkbox" value="{{ $status->id }}"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            {{ in_array($status->id, request()->get('filter_status', [])) ? 'checked' :
                                        '' }}
                                        onChange="document.getElementById('filterForm').submit();">
                                        <label for="filter_status_{{ $status->id }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $status->name}}
                                        </label>
                                    </li>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Title</th>
                        <th scope="col" class="px-4 py-3">Creator</th>
                        <th scope="col" class="px-4 py-3">Description</th>
                        <th scope="col" class="px-4 py-3">Category</th>
                        <th scope="col" class="px-4 py-3">Priority</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Due Date</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                            {{ Str::limit($task->title, 55) }}
                        </th>
                        <td class="px-4 py-3">{{ Str::limit($task->creator->name, 55) }}</td>
                        <td class="px-4 py-3">{{ Str::limit($task->description, 55) }}</td>
                        <td class="px-4 py-3">{{ Str::limit($task->category->name, 55) }}</td>
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
                        <td class="px-4 py-3 flex items-center justify-end">
                            <button id="{{ $task->slug }}-dropdown-button"
                                data-dropdown-toggle="{{ $task->slug }}-dropdown"
                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                            <div id="{{ $task->slug }}-dropdown"
                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="{{ $task->slug }}-dropdown-button">
                                    <li>
                                        <a href="{{ route('tasks.show', $task->id) }}"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="block w-full text-left py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</button>
                                    </form>
                                </div>
                            </div>
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
        </div>
        <div class="my-4 mx-4">
            {{ $tasks->links() }}
        </div>
    </div>
</x-layout>