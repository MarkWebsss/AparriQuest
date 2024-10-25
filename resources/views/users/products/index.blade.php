@can('user-access')
@extends('layouts.Users.app')

@section('content')
<style>
.product-column {
    padding: 10px; /* Reduced padding */
    margin-bottom: 20px;
    flex: 0 0 20%; /* Each product takes 20% of the row */
    max-width: 20%; /* Ensures each column is exactly 1/5th of the row */
    box-sizing: border-box; /* Ensures padding is included in width */
}
/* Custom media query to ensure responsiveness */
@media (max-width: 1200px) {
    .product-column {
        flex: 0 0 calc(100% / 4); /* 4 products per row on smaller screens */
        max-width: calc(100% / 4);
    }
}

@media (max-width: 992px) {
    .product-column {
        flex: 0 0 calc(100% / 3); /* 3 products per row on medium screens */
        max-width: calc(100% / 3);
    }
}

@media (max-width: 768px) {
    .product-column {
        flex: 0 0 calc(100% / 2); /* 2 products per row on small screens */
        max-width: calc(100% / 2);
    }
}

@media (max-width: 576px) {
    .product-column {
        flex: 0 0 100%; /* 1 product per row on extra small screens */
        max-width: 100%;
    }
}
.row {
    display: flex;
    flex-wrap: wrap; /* Allow wrapping to avoid overflow */
    justify-content: flex-start; /* Align items to the left */
    margin-left: 0; /* Remove left margin */
    margin-right: 0; /* Remove right margin */
}
/* Custom card container */
.custom-card {
    border: 1px solid #dee2e6;
    border-radius: .25rem;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: box-shadow .15s ease-in-out;
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* Image styling */
.custom-card img {
    width: 100%;
    height: 200px;
    object-fit: cover; /* Keeps image aspect ratio consistent */
}

/* Custom hover effect for card */
.custom-card:hover {
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}

/* Card body styling */
.custom-card-body {
    padding: 15px;
    flex-grow: 1; /* Ensures the card body grows to fill available space */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Ensures the button stays at the bottom */
}

/* Card title */
.custom-card-body h5 {
    font-size: 1.25rem;
    color: #007bff;
    margin-bottom: 10px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; /* Trims long product names */
}

/* Card text for price and status */
.custom-card-body p {
    margin: 0;
    font-size: 1rem;
    color: #6c757d;
}

/* Button style */
.custom-card-body .btn {
    margin-top: 10px;
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
    align-self: flex-start; /* Keeps the button aligned to the left */
}

.custom-card-body .btn:hover {
    background-color: #0056b3;
    border-color: #004085;
}
</style>


<div class="row d-flex text-center mt-3">
    <div class="col-md-6">
        <h2 class="mb-0">Available Products</h2>
    </div>
    <div class="col-lg-5 col-md-6 col-sm-12">
        <!-- Search Box -->
        <form action="{{ route('users.searchproducts') }}" method="get" class="d-flex justify-content-center align-items-center w-100">
            <div class="input-group w-100">
                <input type="text" name="query" class="form-control" placeholder="Search Products or Keywords" aria-label="Search Products or Keywords">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="row px-5 d-flex flex-wrap">
    @foreach ($products as $product)
        <div class="product-column">
            <div class="custom-card">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="custom-card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Price: ₱{{ $product->price }}</p>
                    @if ($product->status === 'Available')
                        <p class="card-text" style="color: green;">Status: {{ ucfirst($product->status) }}</p>
                    @else
                        <p class="card-text" style="color: red;">Status: {{ ucfirst($product->status) }}</p>
                    @endif
                    <p class="card-text">Shop: {{ $product->user->name }}</p>
                    <a href="{{ route('users.products.productview', $product->id) }}" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endcan
@endsection
