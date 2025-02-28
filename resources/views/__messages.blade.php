<x-layout>
    <x-slot:title>
        All Messages
    </x-slot:title>

    <x-header-task>
        <x-slot:header>
            <span class="text-xl font-bold text-left dark:text-gray-50">
                {{ __('Messages') }}
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

    <div class="bg-white dark:bg-gray-800 p-6 relative shadow-md sm:rounded-lg overflow-auto">
        <ul>
            @forelse($messages as $message)
            <li>
                <div class="flex items-center gap-4 border-b-2 dark:border-gray-700 py-2 dark:text-gray-50">
                    <div class="w-12 justify-items-center flex-none border-r-2 dark:border-gray-700">
                        <form
                            action="{{ route('messages.destroy', ['message' => $message, 'page' => request('page')]) }}"
                            method="POST" onsubmit="return confirm('Are you sure to delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <svg class="w-6 h-6 text-gray-800 dark:text-gray-50 hover:text-red-700 dark:hover:text-red-700"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="w-auto flex-1 lg:flex lg:gap-4">
                        <div class="grid grid-flow-row lg:w-72 lg:border-r-2 dark:lg:border-gray-700 lg:flex-none">
                            <span class="hidden lg:inline">
                                Task: <strong>{{ Str::limit($message->task->title, 30) }}</strong>
                            </span>
                            <span class="lg:hidden">
                                Task: <strong>{{ $message->task->title }}</strong>
                            </span>
                            <span class="text-sm">
                                Creator: <strong>{{ $message->creator->name }} </strong>
                            </span>
                        </div>
                        <div class="grid grid-flow-row lg:flex-1">
                            <span>
                                {!! $message->message !!}
                            </span>
                            <small>{{ \Carbon\Carbon::parse($message->sent_at)->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <div class="flex justify-center">
                <span class="flex-none dark:text-gray-50">No message 😊</span>
            </div>
            @endforelse
        </ul>
        <div class="my-4 mx-4">
            {{ $messages->links() }}
        </div>
    </div>
</x-layout>