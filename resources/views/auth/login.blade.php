<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="off" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-50">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 dark:text-gray-50 hover:text-gray-900 dark:hover:text-gray-300 focus:text-gray-900 dark:focus:text-gray-300"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div>

        <div class="mt-4 flex justify-center">
            <x-primary-button class="w-4/5 sm:w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="flex justify-center items-center gap-1 mt-4">
            <span class="text-sm text-gray-600 dark:text-gray-50">Not registered?</span>
            <a class="underline text-sm text-gray-600 dark:text-gray-50 hover:text-gray-900 dark:hover:text-gray-300 focus:text-gray-900 dark:focus:text-gray-300"
                href="{{ route('register') }}">
                {{ __('Create an account') }}
            </a>
        </div>
    </form>
</x-guest-layout>