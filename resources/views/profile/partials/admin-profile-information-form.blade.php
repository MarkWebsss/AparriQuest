<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Admin Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your admin profile information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Admin-specific fields here -->
        <div>
            <x-input-label for="admin-name" :value="__('Admin Name')" />
            <x-text-input id="admin-name" name="name" type="text" class="mt-1 block w-full p-2" :value="old('name', $user->name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Include other relevant fields for admin -->

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
