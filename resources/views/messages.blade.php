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
        <form id="delete-form" action="{{ route('messages.bulkDelete') }}" method="POST"
            onsubmit="return confirm('Are you sure to delete this message?');">
            @csrf
            @method('DELETE')

            <input type="hidden" name="page" value="{{ request('page', 1) }}">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="pl-4 py-3">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th scope="col" class="px-2 py-2">
                                <button type="submit" id="delete-selected" style="display: none"
                                    class="flex justify-center items-center my-auto">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-gray-50 hover:text-red-700 dark:hover:text-red-700"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </button>
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <span>
                                    Utama <small class="bg-red-500 px-1 py-0.5 ml-1 rounded-xl text-white">{{
                                        $totalMessages }} pesan</small>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $message)
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="pl-4 pr-2 py-3 w-5">
                                <input type="checkbox" class="message-checkbox" name="message_ids[]"
                                    value="{{ $message->id }}">
                            </td>
                            <td class="px-2 py-3 w-5">
                                <button type="button" data-id="{{ $message->id }}"
                                    class="delete-message flex justify-center items-center my-auto">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-gray-50 hover:text-red-700 dark:hover:text-red-700"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </button>
                            </td>
                            <td class="px-4 py-3 lg:flex lg:gap-2">
                                <div
                                    class="flex flex-none flex-col lg:justify-center lg:pr-2 lg:border-r dark:lg:border-gray-700">
                                    <span class="flex-none">
                                        Task: <strong>{{ $message->task->title }}</strong>
                                    </span>
                                    <span class="flex-none">
                                        Creator: <strong>{{ $message->creator->name }} </strong>
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="flex-1">{!! $message->message !!}</span>
                                    <span class="flex-none">
                                        <small>{{ \Carbon\Carbon::parse($message->sent_at)->diffForHumans()}}</small>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <span class="dark:text-gray-50">No message 😊</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
        {{-- Form delete single message --}}
        <form id="delete-message-form" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        <div class="my-4 mx-4">
            {{ $messages->links() }}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectAll = document.getElementById('select-all');
            let checkboxes = document.querySelectorAll('.message-checkbox');
            let deleteButton = document.getElementById('delete-selected');

            // Cek jika ada checkbox yang dipilih
            function toggleDeleteButton() {
                let anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                deleteButton.style.display = anyChecked ? 'block' : 'none';
            }

            // Select or Deselect all checkboxes
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleDeleteButton();
            });

            // Check individually and toggle delete button
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', toggleDeleteButton);
            });

            // Delete single message
            document.querySelectorAll(".delete-message").forEach(button => {
                button.addEventListener("click", function () {
                    let messageId = this.getAttribute("data-id");
                    let currentPage = new URLSearchParams(window.location.search).get("page") || 1; // Ambil page dari URL
                    
                    let form = document.getElementById("delete-message-form");
                    form.action = `/messages/${messageId}?page=${currentPage}`; // Tambahkan ?page=xx
                    form.submit();
                });
            });
        });
    </script>
</x-layout>