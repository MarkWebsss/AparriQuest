<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <!-- Add Vite assets -->


    <div class="text-center">
        <img src="{{ asset('logo/logo1.png') }}" alt="Logo" class="logo mx-auto" width="100" height="100">
    </div>

    <h1 class="text-center"><b>Login to AparriQuest</b></h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <div class="input-group">
                <div class="input-group-text">
                    <box-icon type='solid' name='user'></box-icon>
                </div>
                <x-text-input id="email" class="form-control block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your Email" />
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
                <x-text-input id="password" class="form-control block w-full" type="password" name="password" required autocomplete="current-password" placeholder="Enter your Password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm hover:text-gray-900 ml-4" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="flex items-center justify-between mt-4 text-center p-2">
            <x-primary-button class="w-full flex items-center justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Register Button with Modal Trigger -->
    <div class="text-center mt-4">
            {{ __('Dont have an account?') }} 
            <a href="#" id="registerLink" class="text-sm hover:text-indigo-900">
            <span style="text-decoration: underline; color: blue;">
                {{ __('Register here!') }}
            </span>
        </a>
    </div>

    <!-- Modal HTML for choosing User or Business Owner -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img src="{{ asset('logo/logo1.png') }}" alt="Logo" class="logo mx-auto" width="100" height="100">
            <h2 class="text-center">Register as</h2>
            <p class="text-center">Choose an option to get started:</p>
            
            <div class="text-center user">
                <a href="{{ route('register') }}" class="btn w-full flex items-center justify-center">Register as User</a>
            </div>
            
            <div class="or-divider">
                <span>or</span>
            </div>
            
            <div class="text-center owner">
                <a href="{{ route('register.business') }}" class="btn w-full flex items-center justify-center">Register as Business Owner</a>
            </div>
        </div>
    </div>

    <!-- Modal Styling -->
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
            overflow: auto;
            border-radius: 10px;
        }

        .modal-content {
            background-color: white;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .modal .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 15px;
            right: 25px;
            cursor: pointer;
        }

        .modal .close:hover,
        .modal .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .or-divider {
            position: relative;
            margin: 20px 0;
        }

        .or-divider span {
            background: white;
            padding: 0 10px;
            position: relative;
            z-index: 1;
        }

        .or-divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #ccc;
            z-index: 0;
        }

        .btn {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .btn:hover {
            background-color: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-owner:hover {
            background-color: #007bff;
        }

        .modal p {
            margin: 10px 0;
            color: #555;
        }
    </style>

    <!-- Modal Script -->
    <script>
        var modal = document.getElementById("registerModal");
        var registerLink = document.getElementById("registerLink");
        var closeBtn = document.getElementsByClassName("close")[0];

        registerLink.onclick = function(event) {
            event.preventDefault();
            modal.style.display = "block"; // Show modal
        }

        closeBtn.onclick = function() {
            modal.style.display = "none"; // Hide modal
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none"; // Hide modal if clicked outside
            }
        }
    </script>   
</x-guest-layout>
