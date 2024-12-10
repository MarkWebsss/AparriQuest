@can('user-access')
@extends('layouts.Users.app')

@section('content')
<div class="container mx-auto my-5">
    <a href="{{ route('users.products.index') }}" class="btn btn-back mb-2">< Back to Products</a>  

    @if($business)
        <div class="p-4">
            <div class="business-card-header bg-blue-600 text-white p-4 rounded-t-lg">
                <h1 class="text-2xl font-semibold">{{ $business->businessName }}</h1>
            </div>

            <div class="business-card flex flex-col md:flex-row border border-gray-300 rounded-lg shadow-lg mb-4">
                <!-- Left Column: Shop Logo -->
                <div class="p-6 md:w-1/2">
                <center>
                    <img src="{{ $business->shopLogo ? asset('storage/' . $business->shopLogo) : asset('logo/user.png') }}" 
                        alt="Shop Logo" 
                        class="img-fluid w-50 object-cover rounded-full border border-success border-opacity-75 border-5 shadow-lg">
                </center>
                </div>
                <!-- Right Column: Business Details -->
                <div class="business-details p-6 md:w-2/3">
                    <p class="text-lg">Location: <strong>{{ $business->fullAddress }}</strong></p>
                    <p class="text-lg">Contact: <strong>{{ $business->businessPhone }}</strong></p>
                    <p class="text-lg">Views: <strong>{{ $business->view_count }}</strong></p>

                    @if($business->last_viewed_at)
                        <p class="text-sm text-gray-500 mt-2">Last Viewed: {{ $business->last_viewed_at->diffForHumans() }}</p>
                    @endif

                    @if ($averageRating > 0)
                        <div class="star-rating mt-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star {{ $i <= $averageRating ? 'text-yellow-400' : 'text-gray-400' }}">&#9733;</span>
                            @endfor
                            <p class="mt-2 text-sm">Average Rating: {{ number_format($averageRating, 1) }}</p>
                        </div>
                    @else
                        <p class="mt-2 text-sm text-gray-500">No feedback yet for this shop.</p>
                    @endif

                    <a href="{{ route('users.shop-feedback.index') }}" 
                       class="btn btn-primary mt-4 text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">
                       Feedback
                    </a>
                    <a href="{{ route('users.map.track', $business->id) }}" 
                    class="btn btn-primary mt-4 text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">Track</a>
                </div>
            </div>

        @else
            <p class="warning-message bg-yellow-100 text-yellow-700 p-4 border border-yellow-300 rounded-md">
                No business data available. Please view a business first.
            </p>
        @endif

        <!-- Product Section -->
        <div class="row">
            <h2 class="text-2xl font-bold mt-6">Products</h2>
            @if(isset($products) && $products->isNotEmpty())
                <div class="flex flex-wrap -mx-2 mt-4">
                    @foreach ($products as $product)
                        <div class="product-column p-2 w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
                            <div class="custom-card border border-gray-300 rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                                <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : asset('logo/NOIMAGE.png') }}" 
                                     class="card-img-top img-fluid rounded-t-lg" 
                                     alt="{{ $product->name }}" 
                                     style="max-width: 100%; height: auto;">
                                <div class="custom-card-body p-4 flex flex-col justify-between">
                                    <h5 class="card-title text-xl text-blue-600 font-semibold truncate">{{ $product->name }}</h5>
                                    <p class="card-text text-gray-600">Price: ₱{{ $product->price }}</p>
                                    <p class="card-text text-{{ $product->status === 'Available' ? 'green' : 'red' }}-600">
                                        Status: {{ ucfirst($product->status) }}
                                    </p>
                                    <div class="flex justify-between mt-4">
                                        <a href="{{ route('users.products.productview', $product->id) }}" 
                                           class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No products available for this business.</p>
            @endif
        </div>
    </div>

    <div class="footer bg-gray-100 py-4 mt-8 text-center">
        <p class="text-sm text-gray-600">&copy; {{ date('Y') }} AparriQuest. All rights reserved. | 
            <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a> | 
            <a href="#" class="text-blue-600 hover:underline">Terms & Conditions</a>
        </p>
    </div>
</div>
@endsection
@endcan
