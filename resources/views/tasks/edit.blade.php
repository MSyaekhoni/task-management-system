<x-layout>
    <x-slot:title>
        Task | Edit
    </x-slot:title>

    <x-header-task>
        <x-slot:header>
            <span class="text-xl font-bold text-left dark:text-gray-50">
                Task: {{ $task->title }}
            </span>
        </x-slot:header>
    </x-header-task>

    <div class="relative shadow sm:rounded-lg dark:shadow-gray-800 bg-white dark:bg-gray-800">
        <form class="max-w-full p-4 sm:p-8" action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative w-full space-y-5">
                    {{-- Title --}}
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                            :value="old('title', $task->title)" required autocomplete="off" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                    {{-- Category --}}
                    <div>
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name="category_id" required>
                            <option value="" disabled {{ old('category_id')==null ? 'selected' : '' }}></option>
                            @foreach ( $categories as $category)
                            <option value=" {{ $category->name }}" {{ old('category_id', $task->
                                category->id)==$category->id ?
                                'selected' : ''
                                }}>{{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
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
                <div class="relative w-full space-y-5">
                    {{-- Due Date --}}
                    <div>
                        <x-input-label for="due_date" :value="__('Due Date')" />
                        <input type="datetime-local" id="due_date" name="due_date"
                            class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-[#3e35d4] focus:border-[#3e35d4] block w-full p-2.5 mt-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-50 dark:focus:ring-[#3e35d4] dark:focus:border-[#3e35d4]"
                            value="{{ old('due_date', isset($task) ? Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : '') }}"
                            required>

                        {{-- <div class="relative mt-1">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
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
                        </div> --}}
                        <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                    </div>
                    {{-- Priority --}}
                    <div>
                        <x-input-label for="priority_id" :value="__('Priority')" />
                        <select id="priority_id" name="priority_id" required
                            class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-[#3e35d4] focus:border-[#3e35d4] block w-full p-2.5 mt-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-50 dark:focus:ring-[#3e35d4] dark:focus:border-[#3e35d4]">
                            <option value="" disabled {{ old('priority_id')==null ? 'selected' : '' }}>Choose a
                                priority</option>
                            @foreach ( $priorities as $priority)
                            <option value="{{ $priority->id }}" {{ old('priority_id', $task->
                                priority->id)==$priority->id ?
                                'selected' : ''
                                }}>{{ $priority->name }}
                            </option>
                            @endforeach
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
        <x-slot:styles>
            <style>
                .select2-container--default .select2-selection--single {
                    background-color: #f9fafb;
                    border: 1px solid #e5e7eb;
                    border-radius: 8px;
                    height: 42px;
                    display: flex;
                    align-items: center;
                    margin-top: 4px;
                    padding: 10px 0 10px 0;
                    font-size: 14px;
                    line-height: 20px;
                    color: #111827;
                }

                /* Focus style */
                .select2-container--default .select2-selection--single:focus {
                    border-color: #3e35d4;
                    outline: none;
                    box-shadow: 0 0 0 1px rgb(62 53 212);
                }

                /* Warna teks dropdown */
                .select2-dropdown {
                    background-color: #ffffff;
                    border: 1px solid #e5e7eb;
                    border-radius: 8px;
                }

                /* Hover pada dropdown */
                .select2-container--default .select2-results__option--highlighted {
                    background-color: #3e35d4;
                    color: #ffffff;
                }

                .select2-container--default .select2-selection--single .select2-selection__rendered {
                    color: #495057;
                    padding-left: 12px;
                }

                .select2-selection__clear {
                    font-size: 20px;
                    margin-left: 10px;
                    color: #3e35d4;
                }

                .select2-selection__clear:hover {
                    color: darkblue;
                    /* Warna saat hover */
                }

                .select2-selection__arrow {
                    position: absolute;
                    top: 50%;
                    right: 10px;
                    transform: translateY(50%);
                    width: 20px;
                    height: 20px;
                }

                .select2-selection__arrow b {
                    border-color: #888 transparent transparent transparent;
                    border-style: solid;
                    border-width: 6px 5px 0 5px;
                    display: block;
                    height: 0;
                    margin-left: 5px;
                    margin-top: -2px;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 0;
                }

                /* Dark mode */
                .dark .select2-container--default .select2-selection--single {
                    background-color: #374151;
                    border: 1px solid #4b5563;
                    color: #f9fafb;
                }

                .dark .select2-dropdown {
                    background-color: #1f2937;
                    border: 1px solid #4b5563;
                }

                .dark .select2-container--default .select2-results__option {
                    color: #f9fafb;
                }

                .dark .select2-container--default .select2-results__option--highlighted {
                    background-color: #3e35d4;
                }

                .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
                    color: #f9fafb;
                }
            </style>
        </x-slot:styles>
        <x-slot:scripts>
            <script>
                $(document).ready(function() {
                    $('#category_id').select2({
                        tags: true, // Memungkinkan input kategori baru
                        theme: "default",
                        width: "100%",
                        placeholder: "Add or Select Category",
                        allowClear: true
                    });
                });
            </script>
        </x-slot:scripts>
    </div>
</x-layout>