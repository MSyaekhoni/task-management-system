<x-layout>
    <x-slot:title>
        Task | Show
    </x-slot:title>

    <x-header-task>
        <x-slot:header>
            <span class="text-xl font-bold text-left dark:text-gray-50">
                Task: {{ $task->title }}
            </span>
        </x-slot:header>
    </x-header-task>

    <section class="bg-white dark:bg-gray-800 shadow dark:shadow-gray-800 sm:rounded-lg">
        <div class="p-4 sm:p-8 mx-auto max-w-2xl ml-0">
            <h2 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-gray-50">
                {{$task->title}}
            </h2>
            <p class="mb-4 text-xl font-extrabold leading-none text-gray-900 md:text-2xl dark:text-gray-50">{{
                $task->creator->name }}</p>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-gray-50">Descriptions</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $task->description }}</dd>
            </dl>
            <dl class="flex items-center space-x-6">
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-gray-50">Category</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $task->category->name }}
                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-gray-50">Priority</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $task->priority->name }}
                    </dd>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-gray-50">Status</dt>
                    <div class="flex gap-2 items-baseline">
                        <span class="bg-{{ $task->status->color }}-500 w-3 h-3 rounded-full block"></span>
                        <span class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $task->status->name }}
                        </span>
                    </div>
                </div>
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-gray-50">Due Date</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                        {{ Carbon\Carbon::parse($task->due_date)->format('d M Y | H:i') }}
                    </dd>
                </div>
            </dl>
            <div class="flex items-center space-x-4 mt-4">
                <x-secondary-link-button href="{{ route('tasks.index') }}">
                    {{ __('Back') }}
                </x-secondary-link-button>
                <x-primary-link-button href="{{ route('tasks.edit', $task->id) }}">
                    {{ __('Edit') }}
                </x-primary-link-button>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                    @csrf
                    @method('DELETE')
                    <x-danger-button>
                        {{ __('Delete') }}
                    </x-danger-button>
                </form>
            </div>
        </div>
    </section>
</x-layout>