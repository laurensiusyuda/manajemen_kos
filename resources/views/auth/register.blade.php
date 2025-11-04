<x-guest-layout>
    <div class="flex justify-center items-center h-screen">

        <div class="w-1/2 h-screen hidden lg:block">
            <img src="https://images.unsplash.com/photo-1724228319129-7cc33c9e8a2a?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=2370"
                alt="Placeholder Image" class="object-cover w-full h-full">
        </div>

        <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('register') }}" class="">
                @csrf

                <h1 class="text-2xl font-semibold mb-4 dark:text-white">Register</h1>
                <div class="mb-4" "bg-sky-100">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-4" "bg-sky-100">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-4" "bg-sky-100">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mb-4" "bg-sky-100">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />v
                </div>
                <x-primary-button
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full flex items-center justify-center">
                    {{ __('Register') }}
                </x-primary-button>

                <div class="mt-6 text-white text-center hover:underline">
                    <a href="{{ route('login') }}" class="hover:underline">Already registered ?</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
