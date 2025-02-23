<div class="relative overflow-hidden bg-white dark:bg-gray-800 shadow dark:shadow-gray-800 sm:rounded-lg mb-4">
    <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
        {{ $header }}
        {{ $alert ?? '' }}
        {{ $slot ?? '' }}
    </div>
</div>