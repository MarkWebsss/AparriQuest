@extends('layouts.Users.app')

@section('content')
<style>
    .product-column {
        padding: 15px;
        margin-bottom: 20px;
    }

    /* Custom card container */
    .custom-card {
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: box-shadow .15s ease-in-out;
    }

    /* Custom hover effect for card */
    .custom-card:hover {
        box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    }

    /* Image styling */
    .custom-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    /* Card body styling */
    .custom-card-body {
        padding: 15px;
    }

    /* Card title */
    .custom-card-body h5 {
        margin-bottom: 10px;
        font-size: 1.25rem;
        color: #007bff;
    }

    /* Card text for price and status */
    .custom-card-body p {
        margin-bottom: 10px;
        font-size: 1rem;
        color: #6c757d;
    }

    /* Button style */
    .custom-card-body .btn {
        margin-top: 10px;
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .custom-card-body .btn:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>

<div class="row">
    <div class="col-lg-12 text-center mt-3">
        <h3>Search Results for "{{ request()->input('query') }}"</h3>
    </div>
</div>

<!-- Back to Products Button -->
<div class="row">
    <div class="col-lg-12 text-center mt-3">
        <a href="{{ route('users.products.index') }}" class="btn btn-secondary">Back to Products</a>
    </div>
</div>

<!-- Display message if no products are found -->
@if($products->isEmpty())
    <div class="row">
        <div class="col-lg-12 text-center mt-3">
            <p>No products found for "{{ request()->input('query') }}". Please try a different search.</p>
        </div>
    </div>
@else
    <div class="row px-5">
        @foreach ($products as $product)
            <div class="product-column col-md-3">
                <div class="custom-card">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="custom-card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Price: {{ $product->price }}</p>
                        <p class="card-text">Status: {{ $product->status }}</p>
                        <p class="card-text">Shop: {{ $product->user->name }}</p>
                        <a href="{{ route('users.products.productview', $product->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
