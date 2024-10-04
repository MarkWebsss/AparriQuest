<x-guest-layout>
    <h1 class="text-center"><b>Register as a Business Owner</b></h1>

    <form id="registrationForm">
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

        <!-- Permit Number Search -->
        <div class="mt-4">
            <x-input-label for="PermitNum" :value="__('Permit Number')" />
            <div class="input-group">
                <x-text-input id="PermitNum" class="form-control block mt-1 w-full" type="text" name="PermitNum" required placeholder="Enter Permit Number" />
                <button id="searchButton" type="button" class="ms-2">
                    {{ __('Search Shop') }}
                </button>
            </div>
            <x-input-error :messages="$errors->get('PermitNum')" class="mt-2" />
        </div>

        <!-- Shop Details Notification -->
        <div id="shopDetails" class="mt-4 alert alert-info" style="display: none;">
            <strong>Shop Found:</strong> <span id="shopName"></span> - <span id="shopAddress"></span>
            <input type="hidden" name="shop_id" id="shopId">
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
    <script>
        $(document).ready(function() {
            $('#searchButton').on('click', function() {
                const permitNumber = $('#PermitNum').val();

                $.ajax({
                    url: '{{ route("search.shop") }}',
                    method: 'POST',
                    data: {
                        permit_number: permitNumber,
                        _token: '{{ csrf_token() }}' // CSRF token for Laravel
                    },
                    success: function(response) {
                        // Update shop details on success
                        $('#shopName').text(response.shop.shopName);
                        $('#shopAddress').text(response.shop.address);
                        $('#shopId').val(response.shop.id);
                        $('#shopDetails').show(); // Show the shop details section
                    },
                    error: function(xhr) {
                        // Handle errors here
                        $('#shopDetails').hide(); // Hide the shop details if there's an error
                        alert('Shop not found or error occurred.'); // Notify the user
                    }
                });
            });
        });
    </script>
</x-guest-layout>
