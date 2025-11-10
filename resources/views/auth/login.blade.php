<x-guest-layout>
    <div class="flex h-screen">
        <div class="w-1/2 h-screen hidden lg:block">
            <img src="https://images.unsplash.com/photo-1724228319129-7cc33c9e8a2a?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2370"
                alt="Placeholder Image" class="object-cover w-full h-full">
        </div>

        <div class="lg:p-36 md:p-52 sm:p-20 p-8 w-full lg:w-1/2 bg-white dark:bg-gray-800 overflow-y-auto">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}" class="">
                @csrf

                <h1 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Login</h1>
                <div class="mb-4" "bg-sky-100">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-4" "bg-sky-100">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mb-4 flex items-center">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="mb-6 text-blue-500">
                    <a class="hover:underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
                <x-primary-button
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full flex items-center justify-center">
                    {{ __('Log in') }}

                </x-primary-button>
                <div class="text-gray-600 dark:text-gray-300 hover:underline mt-6 text-center">
                    <a wire:navigate href="{{ route('register') }}" class="hover:underline">Sign up Here</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
