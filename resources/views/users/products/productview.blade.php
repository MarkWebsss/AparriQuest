@extends('layouts.Users.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="custom-card shadow-sm p-4">
                <div class="row">

                    {{-- Left Column: Product Image --}}
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        @if($products->image)
                            <img src="{{ asset('storage/' . $products->image) }}" class="img-fluid rounded" alt="{{ asset('public/logo/NOIMAGE.png') }}" style="max-width: 100%; height: auto;">
                        @else
                            <img src="{{ asset('public/logo/NOIMAGE.png') }}" class="img-fluid rounded" alt="No Image Available" style="max-width: 100%; height: auto;">
                        @endif
                    </div>

                    {{-- Right Column: Product Details --}}
                    <div class="col-md-6">
                        <div class="custom-card-body">
                            {{-- Product Name --}}
                            <h1 class="card-title">{{ $products->name }}</h1>

                            {{-- Product Price --}}
                            <p class="card-text">Price: ₱{{ number_format($products->price, 2) }}</p>

                            {{-- Product Description --}}
                            <p class="card-text">{{ $products->description }}</p>

                            {{-- Product Status --}}
                            @if ($products->status === 'Available')
                                <p class="card-text" style="color: green;">Status: Available</p>
                            @else
                                <p class="card-text" style="color: red;">Status: {{ ucfirst($products->status) }}</p>
                            @endif

                            {{-- Shop Name (Owner) --}}
                            <p class="card-text">Shop: {{ $products->user->name ?? 'Unknown Shop' }}</p>

                            {{-- Buttons --}}
                            <div class="d-flex">
                                <a href="{{ route('users.products.index') }}" class="btn btn-secondary me-2">Back to Products</a>
                                <a href="{{ route('users.map.track', $products->id) }}" class="btn btn-primary">Track</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
