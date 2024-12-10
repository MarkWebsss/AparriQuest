<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information, email address, and profile photo.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email Field -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Upload Photo Field -->
        <div>
            <x-input-label for="photo" :value="__('Profile Photo')" />

            <!-- Display existing profile photo if available -->
            @if ($user->profile_photo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="rounded-full h-20 w-20 object-cover">
                </div>
            @endif

            <!-- File input for photo upload -->
            <input type="file" name="photo" id="photo" class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none" onchange="previewImage(event)">
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />

            <!-- Preview the uploaded image -->
            <div class="mt-4">
                <x-input-label :value="__('Photo Preview')" />
                <img id="preview" src="{{ asset('default-image-path') }}" class="rounded-full h-20 w-20 object-cover" alt="Preview Image">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById("preview");

        reader.onload = function() {
            if (reader.readyState === 2) {
                imageField.src = reader.result;
            }
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

