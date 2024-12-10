@extends('layouts.Owner.app')
@section('page-title', 'Profile')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Profile Information -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <section>
                        <header>
                            <h2 class="text-lg font-semibold text-gray-900">{{ __('Profile Information') }}</h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update your account's profile information, email address, and profile photo.") }}
                            </p>
                        </header>

                        <!-- Verification Form -->
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <!-- Profile Update Form -->
                        <form method="post" action="{{ route('owner.update') }}" enctype="multipart/form-data" class="mt-4 space-y-4">
                            @csrf
                            @method('patch')

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="block p-2 w-full mt-1" :value="old('name', $user->name)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="block p-2 w-full mt-1" :value="old('email', $user->email)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="text-sm mt-2 text-gray-800">
                                        <p>{{ __('Your email address is unverified.') }}
                                            <button form="send-verification" class="underline text-indigo-600 hover:text-indigo-900">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p class="text-green-600 mt-2">{{ __('A new verification link has been sent.') }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Profile Photo Section -->
                            <div class="profile-photo-container">
                            <!-- File Input -->
                                <input 
                                    type="file" 
                                    name="photo" 
                                    id="photo" 
                                    class="file-input block p-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg mt-2" 
                                    onchange="previewImage(event)">
                                <x-input-error class="mt-2" :messages="$errors->get('photo')" />

                                <!-- Image Preview -->
                                <div class="photo-preview mt-4">
                                    <x-input-label :value="__('Photo Preview')" />
                                    <img id="preview" class="object-cover h-32 w-32 rounded-full border border-gray-300 shadow-sm" alt="Preview Image">
                                </div>
                            </div>
                            <!-- Save Button -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                                        {{ __('Saved.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>

                <!-- Update Password -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <section>
                        <header>
                            <h2 class="text-lg font-semibold text-gray-900">{{ __('Update Password') }}</h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('password.update') }}" class="mt-4 space-y-4">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="current_password" :value="__('Current Password')" />
                                <x-text-input id="current_password" name="current_password" type="password" class="block p-2 w-full mt-1" />
                                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" />
                                <x-text-input id="password" name="password" type="password" class="block p-2 w-full mt-1" />
                                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block p-2 w-full mt-1" />
                                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                                        {{ __('Saved.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>

                <!-- Delete Account -->
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <section>
                        <header>
                            <h2 class="text-lg font-semibold text-gray-900">{{ __('Delete Account') }}</h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                            </p>
                        </header>

                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                            {{ __('Delete Account') }}
                        </x-danger-button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4 m-3">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">{{ __('Are you sure you want to delete your account?') }}</h2>
                                <p class="text-sm text-gray-600">{{ __('Please enter your password to confirm deletion.') }}</p>

                                <div>
                                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                                    <x-text-input id="password" name="password" type="password" class="block p-2 w-full mt-1" placeholder="{{ __('Password') }}" />
                                    <x-input-error class="mt-2" :messages="$errors->userDeletion->get('password')" />
                                </div>

                                <div class="flex justify-end gap-4">
                                    <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                                    <x-danger-button>{{ __('Delete Account') }}</x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imageField = document.getElementById("preview");

            reader.onload = function () {
                if (reader.readyState === 2) {
                    imageField.src = reader.result;
                }
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
