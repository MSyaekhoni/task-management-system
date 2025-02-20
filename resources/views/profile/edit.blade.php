<x-layout>
    <x-slot:title>
        {{ __('Profile') }}
    </x-slot:title>

    <x-header-task>
        <x-slot:header>
            <span id="page-title" class="text-xl font-bold text-left dark:text-gray-50">
                {{ __('Profile') }}
            </span>
        </x-slot:header>
    </x-header-task>

    <div class="relative space-y-6">
        <div class="p-4 sm:p-8 shadow sm:rounded-lg dark:shadow-gray-800 bg-white dark:bg-gray-800">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 shadow sm:rounded-lg dark:shadow-gray-800 bg-white dark:bg-gray-800">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 shadow sm:rounded-lg dark:shadow-gray-800 bg-white dark:bg-gray-800">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-layout>