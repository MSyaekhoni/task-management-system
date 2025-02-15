<x-layout>
    <x-slot:title>
        Task | Create
    </x-slot:title>
    <div>
        <x-header-task>
            <x-slot:header>
                <span id="page-title" class="text-xl font-bold text-left">
                    Edit Task {{ $task->title }}
                </span>
            </x-slot:header>
        </x-header-task>

        <div class="relative shadow-md sm:rounded-lg">
            <form class="max-w-full mx-6" action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap justify-between">
                    <div class="relative w-full md:max-w-lg">
                        <div class="mb-5">
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                autocomplete="off" required />
                            @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="creator_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Creator</label>
                            {{-- <input type="text" id="creator" name="creator"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                autocomplete="off" required /> --}}
                            <select id="creator_id" name="creator_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled {{ old('creator')==null ? 'selected' : '' }}>Choose a creator
                                </option>
                                @foreach ($creators as $creator)
                                <option value="{{ $creator->id }}" {{ old('creator_id', $task->creator_id)==$creator->id
                                    ? 'selected' :
                                    ''}}>{{ $creator->name }}</option>
                                @endforeach
                            </select>
                            @error('creator_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <input type="text" id="category" name="category"
                                value="{{ old('category', $task->category) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                autocomplete="off" required />
                            @error('category')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Describe your task..."
                                required>{{ old('description', $task->description) }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="relative w-full md:max-w-lg">
                        <div class="mb-5">
                            <label for="due_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Due Date</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="due_date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                                    datepicker datepicker-autohide datepicker-buttons datepicker-autoselect-today
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date" autocomplete="off" required>
                            </div>
                            @error('due_date')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="priority"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Priority</label>
                            <select id="priority" name="priority" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled {{ old('priority')==null ? 'selected' : '' }}>Choose a
                                    priority</option>
                                <option value="Low" {{ old('priority', $task->priority)=='Low' ? 'selected' : '' }}>Low
                                </option>
                                <option value="Medium" {{ old('priority', $task->priority)=='Medium' ? 'selected' : ''
                                    }}>Medium</option>
                                <option value="High" {{ old('priority', $task->priority)=='High' ? 'selected' : ''
                                    }}>High</option>
                            </select>
                            @error('priority')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status" name="status" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" disabled {{ old('status')==null ? 'selected' : '' }}>Choose a status
                                </option>
                                <option value="Pending" {{ old('status', $task->status)=='Pending' ? 'selected' : ''
                                    }}>Pending
                                </option>
                                <option value="In Progress" {{ old('status', $task->status)=='In Progress' ? 'selected'
                                    : '' }}>In
                                    Progress</option>
                                <option value="Completed" {{ old('status', $task->status)=='Completed' ? 'selected' : ''
                                    }}>Completed
                                </option>
                            </select>
                            @error('status')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4 mt-14">
                    <a href="/tasks"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-7 py-2 mb-5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Back</a>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 mb-5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>