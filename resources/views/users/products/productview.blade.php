@extends('layouts.Users.app')

@section('content')
@if(session('error'))
        <div class="alert alert-danger m-3" role="alert">
            {{ session('error') }}
        </div>
@endif
<div class="container">
<a href="{{ route('users.products.index') }}" class="btn btn-danger my-3">Back to Products</a>
    <div class="row justify-content-center">
        <div class="col">
            <div class="custom-card shadow-sm p-4 bg-white rounded">
                <div class="row">
                    {{-- Left Column: Product Image --}}
                    <div class="col-lg-6 d-flex justify-content-center align-items-center mb-4 mb-lg-0">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded m-2" alt="{{ $product->name }}" style="max-width: 100%; height: auto;">
                        @else
                            <img src="{{ asset('public/logo/NOIMAGE.png') }}" class="img-fluid rounded" alt="No Image Available" style="max-width: 100%; height: auto;">
                        @endif
                    </div>

                    {{-- Right Column: Product Details --}}
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <div class="custom-card-body">
                            {{-- Product Name --}}
                            <h1 class="card-title mb-3" style="font-size: 2rem; font-weight: bold;">{{ $product->name }}</h1>

                            {{-- Product Price --}}
                            <p class="card-text mb-3" style="font-size: 1.5rem; color: #007bff;">₱{{ number_format($product->price, 2) }}</p>

                            {{-- Product Description --}}
                            <p class="card-text mb-4" style="font-size: 1rem; color: #555;">Description: {{ $product->description }}</p>

                            {{-- Product Status --}}
                            @if ($product->status === 'Available')
                                <p class="card-text mb-4" style="color: green; font-weight: bold;">Status: Available</p>
                            @else
                                <p class="card-text mb-4" style="color: red; font-weight: bold;">Status: {{ ucfirst($product->status) }}</p>
                            @endif

                            <div class="d-flex mt-4">
                                @if(isset($product->user->business))
                                    <a href="{{ route('users.view.shop', $product->user->business->id) }}" class="btn btn-primary me-2">
                                        View Shop
                                    </a>
                                @else
                                    <button class="btn btn-secondary me-2" disabled>
                                        Shop Not Available
                                    </button>
                                @endif

                                {{-- Track Product --}}
                                @if(isset($product->id))
                                    <a href="{{ route('users.map.track', $product->id) }}" class="btn btn-primary">
                                        Track Product
                                    </a>
                                @else
                                    <button class="btn btn-secondary" disabled>
                                        Tracking Not Available
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-card {
        border-radius: 15px;
        transition: box-shadow 0.3s ease;
    }

    .custom-card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        color: #333;
    }

    .card-text {
        line-height: 1.6;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 12px rgba(0, 91, 187, 0.2);
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #565e64;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.2);
    }
</style>
@endsection
