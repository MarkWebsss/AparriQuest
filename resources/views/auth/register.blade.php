<x-guest-layout>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <div class="text-center">
        <img src="{{ asset('aparriquest/aparri-quest-logo.jpg') }}" alt="Logo" 
        class="logo rounded-circle mx-auto" width="100" height="100">
</div>
    <style>
        .logo {
                border-radius: 50%;
                border: 2px solid black;
            }
        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-group .input-group-text {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
            display: flex;
            align-items: center;
            padding: 0.5rem;
            pointer-events: none;
        }

        .input-group .form-control {
            padding-left: 2.5rem;
            width: 100%;
        }

        body, .text-center, .form-control, .input-group-text, label, a, span, h1 {
            color: black;
        }
    </style>
    <h1 class="text-center mt-2 ">Register to AparriQuest</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <div class="input-group">
                <div class="input-group-text">
                    <box-icon type='solid' name='user'></box-icon>
                </div>
                <x-text-input id="name" class="form-control block mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <div class="input-group">
                <div class="input-group-text">
                    <box-icon type='solid' name='envelope'></box-icon>
                </div>
                <x-text-input id="email" class="form-control block mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="input-group">
                <div class="input-group-text">
                    <box-icon type='solid' name='lock'></box-icon>
                </div>
                <x-text-input id="password" class="form-control block mt-1" type="password" name="password" required autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class="input-group">
                <div class="input-group-text">
                    <box-icon type='solid' name='lock-open'></box-icon>
                </div>
                <x-text-input id="password_confirmation" class="form-control block mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
