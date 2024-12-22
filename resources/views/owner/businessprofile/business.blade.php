@can('owner-access')
@extends('layouts.Owner.app')
@section('page-title', 'Edit Business Profile')
@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Edit Business Profile</h2>

            <!-- Display success message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Shop Logo Section -->
                <div class="flex flex-col items-center justify-center p-4 border-r-2 border-gray-300">
                    <div class="relative rounded-full overflow-hidden shadow-lg w-48 h-48 mb-4">
                    <img src="{{ $business->shopLogo ? asset('storage/' . $business->shopLogo) : asset('logo/user.png') }}" 
                        alt="Shop Logo" 
                        class="w-full h-full object-cover">
                    </div>

                    <form action="{{ route('owner.business.update-logo', ['id' => $business->id]) }}" method="POST" enctype="multipart/form-data" class="w-full">
                        @csrf
                        @method('PUT')
                        <label for="shopLogo" class="block text-sm font-medium text-gray-700 mb-1">Change Shop Logo</label>
                        <input type="file" id="shopLogo" name="shopLogo" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        @error('shopLogo')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="mt-3 w-full py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-md hover:bg-indigo-700 transition">
                            Upload Logo
                        </button>
                    </form>
                </div>

                <!-- Business Information Section -->
                <div class="lg:col-span-2">
                    <form action="{{ route('owner.business.update', ['id' => $business->id]) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="businessName" class="block font-medium text-gray-700">
                                Business Name: 
                            <strong>
                            {{ $business->businessName}}
                            </strong>
                            @error('businessName')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                            </label>
                        </div>
                        <input type="text" id="businessName" name="businessName" value="{{ old('businessName', $business->businessName) }}" class="hidden">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700">Owner's First Name</label>
                                <input type="text" id="firstName" name="firstName" value="{{ old('firstName', $business->firstName) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                                @error('firstName')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700">Owner's Last Name</label>
                                <input type="text" id="lastName" name="lastName" value="{{ old('lastName', $business->lastName) }}" class="form-control" required>
                                @error('lastName')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="ownerEmail" class="block text-sm font-medium text-gray-700">Owner's Email</label>
                            <input type="email" id="ownerEmail" name="ownerEmail" value="{{ old('ownerEmail', $business->ownerEmail) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                            @error('ownerEmail')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="businessPhone" class="block text-sm font-medium text-gray-700">Business Phone</label>
                            <input type="text" id="businessPhone" name="businessPhone" value="{{ old('businessPhone', $business->businessPhone) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                            @error('businessPhone')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="businessNo" class="block text-sm font-medium text-gray-700">Business Number</label>
                                <input type="text" id="businessNo" name="businessNo" value="{{ old('businessNo', $business->businessNo) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                                @error('businessNo')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="BusStreetAddress" class="block text-sm font-medium text-gray-700">Street Address</label>
                                <input type="text" id="BusStreetAddress" name="BusStreetAddress" value="{{ old('BusStreetAddress', $business->BusStreetAddress) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                                @error('BusStreetAddress')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="businessCity" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" id="businessCity" name="businessCity" value="{{ old('businessCity', $business->businessCity) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                                @error('businessCity')
                                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 transition">
                                Update Business Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@endcan
