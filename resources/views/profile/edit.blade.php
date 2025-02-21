<x-layout>
    <x-slot:title>
        {{ __('Profile') }}
    </x-slot:title>

    <x-header-task>
        <x-slot:header>
            <span class="text-xl font-bold text-left dark:text-gray-50">
                {{ __('Profile') }}
            </span>
        </x-slot:header>

        <x-slot:alert>
            @if (session('status') === 'profile-updated')
            <x-alert>
                <x-slot:status>
                    {{ __('Profile updated successfully!')}}
                </x-slot:status>
            </x-alert>
            @elseif (session('status') === 'password-updated')
            <x-alert>
                <x-slot:status>
                    {{ __('Password updated successfully!')}}
                </x-slot:status>
            </x-alert>
            @endif
        </x-slot:alert>
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