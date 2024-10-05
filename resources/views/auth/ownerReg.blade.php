<x-guest-layout>
    <h1 class="text-center"><b>Register as a Business Owner</b></h1>

    <form method="POST" action="{{ route('register.business') }}">
        @csrf

        <!-- Owner Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Owner Name')" />
            <x-text-input id="name" class="form-control block mt-1 w-full" type="text" name="name" required placeholder="Enter your Name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" required placeholder="Enter your Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required placeholder="Enter your Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="form-control block mt-1 w-full" type="password" name="password_confirmation" required placeholder="Confirm your Password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button type="submit">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="text-sm hover:text-indigo-900">
            {{ __('Already have an account?') }}
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</x-guest-layout>
