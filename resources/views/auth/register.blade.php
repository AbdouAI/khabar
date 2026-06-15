<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
                    <x-input-label for="last_name" :value="__('Nom')" />
                    <input class="block mt-1 w-full" type="text" name="last_name" id="last_name" required>
                    @error('last_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mt-4">
                    <x-input-label for="first_name" :value="__('Prenom')" />
                    <input class="block mt-1 w-full" type="text" name="first_name" id="first_name" required>
                    @error('first_name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="mt-4">
                    <x-input-label for="experience" :value="__('Experience')" />
                    <textarea class="block mt-1 w-full" name="experience" id="experience" cols="30" rows="10" required></textarea>
                    @error('experience')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
