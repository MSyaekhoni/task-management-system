<x-layout>
    <x-slot:title>
        Task | Create
    </x-slot:title>
    <div>
        <x-header-task>
            <x-slot:header>
                <span class="text-xl font-bold text-left dark:text-gray-50">
                    Edit Task {{ $task->title }}
                </span>
            </x-slot:header>
        </x-header-task>

        <div class="relative shadow py-4 sm:rounded-lg dark:shadow-gray-800 bg-white dark:bg-gray-800">
            <form class="max-w-full mx-6" action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap justify-between">
                    <div class="relative w-full md:max-w-lg space-y-5">
                        {{-- Title --}}
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title', $task->title)" required autocomplete="off" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        {{-- Category --}}
                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <x-text-input id="category" name="category" type="text" class="mt-1 block w-full"
                                :value="old('category', $task->category)" required autocomplete="off" />
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>
                        {{-- Description --}}
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4"
                                class="block p-2.5 mt-1 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-200 focus:ring-[#3e35d4] focus:border-[#3e35d4] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-50 dark:focus:ring-[#3e35d4] dark:focus:border-[#3e35d4]"
                                placeholder="Describe your task..."
                                required>{{ old('description', $task->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                    </div>
                    <div class="relative w-full md:max-w-lg space-y-5">
                        {{-- Due Date --}}
                        <div>
                            <x-input-label for="due_date" :value="__('Due Date')" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="due_date" name="due_date"
                                    value="{{ old('due_date', Carbon\Carbon::parse($task->due_date)->format('d/m/Y')) }}"
                                    datepicker datepicker-format="dd-mm-yyyy" datepicker-autohide datepicker-buttons
                                    datepicker-autoselect-today type="text"
                                    class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-[#3e35d4] focus:border-[#3e35d4] block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-50 dark:focus:ring-[#3e35d4] dark:focus:border-[#3e35d4]"
                                    placeholder="Select date" autocomplete="off" required>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                        </div>
                        {{-- Priority --}}
                        <div>
                            <x-input-label for="priority" :value="__('Priority')" />
                            <select id="priority" name="priority" required
                                class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-[#3e35d4] focus:border-[#3e35d4] block w-full p-2.5 mt-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-50 dark:focus:ring-[#3e35d4] dark:focus:border-[#3e35d4]">
                                <option value="" disabled {{ old('priority')==null ? 'selected' : '' }}>Choose a
                                    priority</option>
                                <option value="Low" {{ old('priority', $task->priority)=='Low' ? 'selected' : '' }}>Low
                                </option>
                                <option value="Medium" {{ old('priority', $task->priority)=='Medium' ? 'selected' : ''
                                    }}>Medium</option>
                                <option value="High" {{ old('priority', $task->priority)=='High' ? 'selected' : ''
                                    }}>High</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('priority')" />
                        </div>
                        {{-- Status --}}
                        <div>
                            <x-input-label for="status_id" :value="__('Status')" />
                            <select id="status_id" name="status_id" required
                                class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-[#3e35d4] focus:border-[#3e35d4] block w-full p-2.5 mt-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-50 dark:focus:ring-[#3e35d4] dark:focus:border-[#3e35d4]">
                                <option value="" disabled {{ old('status_id')==null ? 'selected' : '' }}>Choose a status
                                </option>
                                @foreach ( $statuses as $status)
                                <option value="{{ $status->id }}" {{ old('status_id', $task->status->id)==$status->id ?
                                    'selected' : ''
                                    }}>{{ $status->name }}
                                </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-14">
                    <x-secondary-link-button href="{{ route('tasks.index') }}">
                        {{ __('Back') }}
                    </x-secondary-link-button>

                    <x-primary-button>
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layout>