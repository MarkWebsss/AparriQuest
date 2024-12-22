<x-guest-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <link rel="stylesheet" href="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.css') }}">

    <h4 class="text-center mb-6"><b>Register as a Business Owner</b></h4>

    <form method="POST" action="{{ route('register.business') }}">
        @csrf

        <div class="p-4 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Column 1: Owner Details -->
                <div class="mb-4">
                    <h5 class="text-lg font-bold mb-4">Owner Details</h5>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                        <!-- Email -->
                        <div class="mb-3">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control mt-1 w-full" type="email" name="email" required placeholder="Enter your Email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="form-control mt-1 w-full" type="password" name="password" required placeholder="Enter your Password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-3">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="form-control block mt-1 w-full p-2" type="password" name="password_confirmation" required placeholder="Confirm your Password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- First Name -->
                        <div class="mb-3">
                            <x-input-label for="firstName" :value="__('First Name')" />
                            <x-text-input id="firstName" class="form-control mt-1 w-full" type="text" name="firstName" required placeholder="Enter First Name" />
                            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                        </div>

                        <!-- Middle Name -->
                        <div class="mb-3">
                            <x-input-label for="middleName" :value="__('Middle Name')" />
                            <x-text-input id="middleName" class="form-control mt-1 w-full" type="text" name="middleName" placeholder="Enter Middle Initial" />
                            <x-input-error :messages="$errors->get('middleName')" class="mt-2" />
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <x-input-label for="lastName" :value="__('Last Name')" />
                            <x-text-input id="lastName" class="form-control mt-1 w-full" type="text" name="lastName" required placeholder="Enter Last Name" />
                            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                        </div>

                        <!-- House Number -->
                        <div class="mb-3">
                            <x-input-label for="ownerHouseNo" :value="__('House No.')" />
                            <x-text-input id="ownerHouseNo" class="form-control mt-1 w-full" type="text" name="ownerHouseNo" required />
                            <x-input-error :messages="$errors->get('ownerHouseNo')" class="mt-2" />
                        </div>

                        <!-- Street Address -->
                        <div class="mb-3">
                            <x-input-label for="ownerStreetAddress" :value="__('Street Address')" />
                            <select id="ownerStreetAddress" name="ownerStreetAddress" class="form-control mt-1 w-full" required>
                                <option value="" disabled selected>Select Street Address</option>
                                <option value="Alvarado Street">Alvarado Street</option>
                                <option value="Balisi Street">Balisi Street</option>
                                <option value="Ballesteros Street">Ballesteros Street</option>
                                <option value="Bonifacio Street">Bonifacio Street</option>
                                <option value="De Carreon Street">De Carreon Street</option>
                                <option value="De Rivera Street">De Rivera Street</option>
                                <option value="Del Pilar Street">Del Pilar Street</option>
                                <option value="Diego Silang Street">Diego Silang Street</option>
                                <option value="Doneza Street">Doneza Street</option>
                                <option value="E. Jacinto Street">E. Jacinto Street</option>
                                <option value="Enrile Street">Enrile Street</option>
                                <option value="Loriga Gallarza Street">Loriga Gallarza Street</option>
                                <option value="Luna Street">Luna Street</option>
                                <option value="Mabini Street">Mabini Street</option>
                                <option value="Magsaysay Street">Magsaysay Street</option>
                                <option value="Quezon Street">Quezon Street</option>
                                <option value="Quirino Street">Quirino Street</option>
                                <option value="Rizal Street">Rizal Street</option>
                                <option value="Roxas Street">Roxas Street</option>
                                <option value="Magapit-Aparri Road">Magapit-Aparri Road</option>
                            </select>
                            <x-input-error :messages="$errors->get('ownerStreetAddress')" class="mt-2" />
                        </div>

                        <!-- Province/City -->
                        <div class="mb-3">
                            <x-input-label for="ownerCity" :value="__('Province/City')" />
                            <x-text-input id="ownerCity" class="form-control mt-1 w-full" type="text" name="ownerCity" placeholder="Enter Province/City" />
                            <x-input-error :messages="$errors->get('ownerCity')" class="mt-2" />
                        </div>

                        <!-- Owner Email -->
                        <div class="mb-3">
                            <x-input-label for="ownerEmail" :value="__('Owner Email')" />
                            <x-text-input id="ownerEmail" class="form-control mt-1 w-full" type="email" name="ownerEmail" required placeholder="eg. name@gmail.com" />
                            <x-input-error :messages="$errors->get('ownerEmail')" class="mt-2" />
                        </div>

                        <!-- Owner Phone -->
                        <div class="mb-3">
                            <x-input-label for="ownerPhone" :value="__('Owner Phone Number')" />
                            <x-text-input id="ownerPhone" class="form-control mt-1 w-full" type="tel" name="ownerPhone" required placeholder="eg. 09xxxxxxxxx" />
                            <x-input-error :messages="$errors->get('ownerPhone')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Column 2: Business Details -->
                <div class="mb-4">
                    <h5 class="text-lg font-bold mb-4">Business Details</h5>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Business Name -->
                        <div class="mb-3">
                            <x-input-label for="businessName" :value="__('Business Name')" />
                            <x-text-input id="businessName" class="form-control mt-1 w-full" type="text" name="businessName" required placeholder="Enter Business Name" />
                            <x-input-error :messages="$errors->get('businessName')" class="mt-2" />
                        </div>

                        <!-- TIN/Permit Number -->
                        <div class="mb-3">
                            <x-input-label for="tin_number" :value="__('TIN/Permit Number')" />
                            <x-text-input id="tin_number" class="form-control mt-1 w-full" type="text" name="tin_number" required placeholder="Enter Registered Tin/Permit Number" />
                            <x-input-error :messages="$errors->get('tin_number')" class="mt-2" />
                        </div>

                        <!-- Business No -->
                        <div class="mb-3">
                            <x-input-label for="businessNo" :value="__('Business No.')" />
                            <x-text-input id="businessNo" class="form-control mt-1 w-full" type="text" name="businessNo" required />
                            <x-input-error :messages="$errors->get('businessNo')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="BusStreetAddress" :value="__('Street Address')" />
                            <x-text-input id="BusStreetAddress" class="form-control mt-1 w-full" type="text" name="BusStreetAddress" required />
                            <x-input-error :messages="$errors->get('BusStreetAddress')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <x-input-label for="businessCity" :value="__('Barangay')" />
                            <x-text-input id="businessCity" class="form-control mt-1 w-full" type="text" name="businessCity" required />
                            <x-input-error :messages="$errors->get('businessCity')" class="mt-2" />
                        </div>

                        <!-- Business Type -->
                        <div class="mb-3">
                            <x-input-label for="businessType" :value="__('Business Type')" />
                            <x-text-input id="businessType" class="form-control mt-1 w-full" type="text" name="businessType" required />
                            <x-input-error :messages="$errors->get('businessType')" class="mt-2" />
                        </div>

                        <!-- Business Email -->
                        <div class="mb-3">
                            <x-input-label for="businessEmail" :value="__('Business Email')" />
                            <x-text-input id="businessEmail" class="form-control mt-1 w-full" type="email" name="businessEmail" required />
                            <x-input-error :messages="$errors->get('businessEmail')" class="mt-2" />
                        </div>

                        <!-- Business Phone -->
                        <div class="mb-3">
                            <x-input-label for="businessPhone" :value="__('Business Phone Number')" />
                            <x-text-input id="businessPhone" class="form-control mt-1 w-full" type="tel" name="businessPhone" required placeholder="eg. 09xxxxxxxxx" />
                            <x-input-error :messages="$errors->get('businessPhone')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

        <!-- Terms and Agreement -->
        <div class="mt-6">
            <label class="flex items-start">
                <input type="checkbox" name="terms" id="terms" class="form-checkbox mt-1 text-indigo-600" required>
                <span class="ml-2">
                    I agree to the 
                    <button type="button" class="text-indigo-600 underline hover:text-indigo-800" onclick="openModal()">
                        Terms and Conditions
                    </button> 
                    and 
                    <button type="button" class="text-indigo-600 underline hover:text-indigo-800" onclick="openPrivacyPolicy()">
                        Privacy Policy
                    </button>.
                </span>
            </label>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between mt-6">
            <x-primary-button type="submit">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <div class="text-center">
        <a href="{{ route('login') }}" class="text-sm hover:text-indigo-900">
            {{ __('Already have an account?') }}
        </a>
    </div>
                <!-- Modal Structure -->
    <div id="termsModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-lg font-bold mb-4">Terms and Conditions</h2>
            <div class="overflow-y-auto max-h-64 text-justify">
                <p>
                    By registering as a shop owner, you agree to abide by the rules and guidelines set by AparriQuest. You must provide accurate information, comply with local laws, and use the platform responsibly. Failure to adhere to these terms may result in account suspension.
                </p>
                <p class="mt-2">For full details, please contact us.</p>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeModal()" class="text-white bg-success-600 px-4 py-2 rounded">
                    I Agree
                </button>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div id="privacyPolicyModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
            <h2 class="text-lg font-bold mb-4">Privacy Policy</h2>
            <div class="overflow-y-auto max-h-64 text-justify">
                <p>
                    We collect personal information such as names, emails, and business details to provide and improve our services. Your data is protected and will not be shared without your consent, except as required by law.
                </p>
                <p class="mt-2">
                    For more details, please review the full Privacy Policy.
                </p>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="closePrivacyPolicy()" class="text-white bg-success-600 px-4 py-2 rounded">
                    I Agree
                </button>
            </div>
        </div>
    </div>
</div>
    <script>
        function openModal() {
            const modal = document.getElementById('termsModal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('show'), 10);  // Apply transition after a small delay
        }

        function closeModal() {
            const modal = document.getElementById('termsModal');
            modal.classList.remove('show');  // Trigger fade out
            setTimeout(() => modal.classList.add('hidden'), 300);  // Wait for fade-out to finish before hiding completely
        }

        function openPrivacyPolicy() {
            const modal = document.getElementById('privacyPolicyModal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('show'), 10);  // Apply transition after a small delay
        }

        function closePrivacyPolicy() {
            const modal = document.getElementById('privacyPolicyModal');
            modal.classList.remove('show');  // Trigger fade out
            setTimeout(() => modal.classList.add('hidden'), 300);  // Wait for fade-out to finish before hiding completely
        }
    </script>
<style>
    /* Initial state of the modal (hidden) */
#termsModal, #privacyPolicyModal {
    opacity: 0;
    visibility: hidden; /* Make sure it doesn't interact with the layout when hidden */
    transition: opacity 0.3s ease, visibility 0s 0.3s; /* Delay visibility change until after fade out */
}

/* When modal is shown */
#termsModal.show, #privacyPolicyModal.show {
    opacity: 1;
    visibility: visible;
    transition: opacity 0.3s ease, visibility 0s 0s; /* Instant visibility change when fading in */
}

/* Modal Content */
#termsModal .bg-white, #privacyPolicyModal .bg-white {
    transform: translateY(-20px); /* Initially move the modal upwards */
    transition: transform 0.3s ease, opacity 0.3s ease;
}

#termsModal.show .bg-white, #privacyPolicyModal.show .bg-white {
    transform: translateY(0); /* Modal slides in */
    opacity: 1;
}
</style>
        </div>
    </form>
</x-guest-layout> 