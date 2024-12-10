@can('user-access')
@extends('layouts.Users.app')

@section('content')
<style>
    html, body {
    height: 100%; /* Ensure the page height covers the viewport */
    margin: 0;
}
.container-fluid {
    padding: 30px;
}

.row {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
}

.filter-column {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-right: 20px;
    width: 250px; 
}

.filter-heading {
    font-size: 1.5rem;
    color: #007bff;
    margin-bottom: 20px;
    text-align: center;
}

.filter-column input,
.filter-column select,
.filter-column button {
    margin-bottom: 15px;
    width: 100%;
}

.filter-column button {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
}

.filter-column button:hover {
    background-color: #0056b3;
    border-color: #004085;
}

@media (max-width: 768px) {
    .filter-column {
        width: 100%;
        margin-top: 0; 
        margin-bottom: 20px;
    }
}

@media (max-width: 576px) {
    .filter-column {
        padding: 10px; 
    }
}

.product-column {
    padding: 10px;
    margin-bottom: 20px;
    flex: 0 0 calc(100% / 4 - 20px);
    max-width: calc(100% / 4 - 20px);
    box-sizing: border-box;
}

@media (max-width: 1200px) {
    .product-column {
        flex: 0 0 calc(100% / 3 - 15px); 
        max-width: calc(100% / 3 - 15px);
    }
}

@media (max-width: 992px) {
    .product-column {
        flex: 0 0 calc(100% / 2 - 10px); 
        max-width: calc(100% / 2 - 10px);
    }
}

@media (max-width: 576px) {
    .product-column {
        flex: 0 0 calc(100% / 2 - 5px); 
        max-width: calc(100% / 2 - 5px);
    }
}

@media (max-width: 400px) {
    .product-column {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

.custom-card {
    border: 1px solid #dee2e6;
    border-radius: .25rem;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.custom-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.custom-card:hover {
    transform: scale(1.05); 
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.custom-card-body {
    padding: 15px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.custom-card-body h5 {
    font-size: 1.25rem;
    color: #007bff;
    margin-bottom: 10px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.custom-card-body p {
    margin: 0;
    font-size: 1rem;
    color: #6c757d;
}

.custom-card-body .card-text.status {
    font-size: 0.7rem;
}

.custom-card-body .shop-name {
    white-space: nowrap; 
    overflow: hidden; 
    text-overflow: ellipsis; 
    font-size: 0.9rem; 
}

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

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Left column -->
        <div class="filter-column">
            <a href="{{ route('users.products.index') }}" style="text-decoration: none;"><h3 class="filter-heading">Products</h3></a>
            <form action="{{ route('users.search.product') }}" method="get">
                <!-- search query form -->
                <input type="text" name="query" class="form-control" placeholder="Search Products or Keywords" value="{{ request('query') }}">

                <!--  price  -->
                <input type="number" name="min_price" class="form-control" placeholder="Min Price" value="{{ request('min_price') }}">
                <input type="number" name="max_price" class="form-control" placeholder="Max Price" value="{{ request('max_price') }}">

                <!-- set status  -->
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Out of Stock" {{ request('status') == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>

                <!--  sorting of the products -->
                <select name="sort" class="form-select">
                    <option value="">Sort By</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
                
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <!-- Right column -->
        <div class="col">
            <div class="row d-flex flex-wrap">
                @if($products->isNotEmpty())
                    <!-- Display ng products -->
                    @foreach ($products as $product)
                        <div class="product-column">
                            <div class="custom-card">
                                <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : asset('logo/NOIMAGE.png') }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="custom-card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Price: ₱{{ $product->price }}</p>
                                    @if ($product->status === 'Available')
                                        <p class="card-text status" style="color: green;">{{ ucfirst($product->status) }}</p>
                                    @else
                                        <p class="card-text status" style="color: red;">{{ ucfirst($product->status) }}</p>
                                    @endif
                                        <p class="card-text shop-name">
                                            Shop: {{ $product->user->business ? $product->user->business->businessName : 'No Business' }}
                                        </p>
                                    <a href="{{ route('users.products.productview', $product->id) }}" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>No products found matching your criteria.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; {{ date('Y') }} AparriQuest. All rights reserved. | 
        <a href="">Privacy Policy</a> | 
        <a href="">Terms & Conditions</a>
    </p>
</div>
<style>
.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #f8f9fa;
    padding: 15px;
    text-align: center;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
}
</style>
@endcan
@endsection
