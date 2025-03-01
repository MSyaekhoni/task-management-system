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
                <x-danger-button id="delete-selected" form="delete-form" style="display: none">
                    Delete Selected
                </x-danger-button>
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
        {{-- Form bulk-delete --}}
        <form id="delete-form" action="{{ route('tasks.bulkDelete') }}" method="POST"
            onsubmit="return confirm('Are you sure to delete this task?');">
            @csrf
            @method('DELETE')

            <input type="hidden" name="page" value="{{ request('page', 1) }}">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="pl-4 pr-2 py-3">
                                <input type="checkbox" id="select-all">
                            </th>
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
                            <th scope="row" class="pl-4 pr-2 py-3">
                                <input type="checkbox" class="task-checkbox" name="task_ids[]" value="{{ $task->id }}">
                            </th>
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                {{ Str::limit($task->title, 35) }}
                            </th>
                            <td class="px-4 py-3">{{ Str::limit($task->creator->name, 35) }}</td>
                            <td class="px-4 py-3">{{ Str::limit($task->description, 35) }}</td>
                            <td class="px-4 py-3">{{ Str::limit($task->category->name, 35) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="bg-{{ $task->priority->color }}-500 rounded-md block w-16 text-center text-white font-medium">
                                    {{ $task->priority->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap flex-wrap items-center space-x-2">
                                <span
                                    class="bg-{{ $task->status->color }}-500 w-3 h-3 rounded-full inline-block"></span>
                                <span class=" inline-block">
                                    {{ $task->status->name }}
                                </span>
                            </td>
                            <td class=" px-6 py-4 whitespace-nowrap flex-nowrap items-center">
                                <span class="block">
                                    {{ Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                </span>
                                <span class="block">
                                    {{ Carbon\Carbon::parse($task->due_date)->format('H:i') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 align-middle text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('tasks.show', $task) }}">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-gray-50 hover:text-primary-700 dark:hover:text-primary-600"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('tasks.edit', $task) }}">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-gray-50 hover:text-green-700 dark:hover:text-green-600"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                    </a>
                                    <button type="button" data-id="{{ $task->slug }}" class="delete-task">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-gray-50 hover:text-red-700 dark:hover:text-red-600"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                    </button>
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
        </form>
        {{-- Form delete single task --}}
        <form id="delete-task-form" method="POST" style="display: none">
            @csrf
            @method('DELETE')
        </form>
        <div class="my-4 mx-4">
            {{ $tasks->links() }}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bulk-Delete
            let selectAll = document.getElementById('select-all');
            let checkboxes = document.querySelectorAll('.task-checkbox');
            let deleteButton = document.getElementById('delete-selected');

            // Cek jika ada checkbox yang di-select
            function toggleDeleteButton() {
                let anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                deleteButton.style.display = anyChecked ? 'block' : 'none';
            }

            // Select or Deselect checkboxes
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleDeleteButton();
            })

            // Check individually and toggle delete button
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', toggleDeleteButton);
            });

            // Delete single task
            document.querySelectorAll(".delete-task").forEach(button => {
                button.addEventListener("click", function() {
                    let taskId = this.getAttribute("data-id");
                    let currentPage = new URLSearchParams(window.location.search).get("page") || 1;

                    if(confirm("Are you sure to delete this task?")) {
                        let form = document.getElementById("delete-task-form");
                        form.action = `/tasks/${taskId}?page=${currentPage}`;
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-layout>