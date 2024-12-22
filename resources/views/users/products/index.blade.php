@can('user-access')
@extends('layouts.Users.app')

@section('content')
<style>
html, body {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.container-fluid {
    padding: 20px;
    flex: 1; 
}

.footer {
    padding: 10px 20px;
    background-color: #f8f9fa;
    text-align: center;
    font-size: 0.9rem;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
}

.row {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
}

.filter-column {
    position: sticky;
    top: 20px; /* The distance from the top of the viewport */
    height: fit-content; /* Ensures it doesn't take up too much space */
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-right: 20px;
    max-width: 300px;
    flex-shrink: 0;
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
    padding: 10px;
    border-radius: 5px;
    width: 100%;
}

.filter-column button {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
    font-size: 1rem;
}

.filter-column button:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.custom-card {
    border: 1px solid #dee2e6;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.custom-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.custom-card-body {
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
    flex-grow: 1;
}

.custom-card-body h5 {
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

.row.d-flex {
    justify-content: space-between; 
    align-items: center; 
}

.text-center {
    text-align: center; 
}

.product-column {
    padding: 10px;
    margin-bottom: 20px;
    flex: 0 0 25%;
    max-width: 25%; 
    box-sizing: border-box;
}

@media (max-width: 1200px) {
    .product-column {
        flex: 0 0 33.33%;
        max-width: 33.33%;
    }
}

@media (max-width: 768px) {
    .filter-column {
        position: fixed;
        top: 0;
        width: 100px; 
        z-index: 999;
        border-radius: 0;
        margin: 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-top: 70px;
    }
    .container-fluid {
        margin-top: 250px; 
    }

    .product-column {
        flex: 0 0 calc(50% - 10px);
        max-width: calc(50% - 10px);
    }

    .filter-column form {
        display: flex;
        flex-direction: column;
    }

    @media (max-width: 576px) {
        .product-column {
            flex: 0 0 50%; 
            max-width: 50%;
        }

        .filter-column {
            position: fixed;
            width: 100%;
            top: 0;
        }

        .container-fluid {
            margin-top: 280px; 
        }
    }
}

</style>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Left column -->
        <div class="filter-column">
            <a href="{{ route('users.products.index') }}" style="text-decoration: none;"><h3 class="filter-heading">Products</h3></a>
            <form action="{{ route('users.search.product') }}" method="get">
                <!-- Search query -->
                <input type="text" name="query" class="form-control" placeholder="Search Products or Keywords" value="{{ request('query') }}">

                <!-- Category filter -->
                <select name="category" class="form-select" value="All Categories">
                    <option value="All Categories">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
<style>
    /* Price Range Slider */
.price-range {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.form-control-range {
    width: 48%;
}

.d-flex {
    display: flex;
    justify-content: space-between;
}

button {
    margin-top: 10px;
}

</style>
    <div class="form-group">
        <label for="price-range">Price Range</label>
        <div class="price-range">
            <input type="range" id="min-price" name="min_price" min="0" max="10000" step="100" value="{{ $minPrice ?? 0 }}" class="form-control-range">
            <input type="range" id="max-price" name="max_price" min="0" max="10000" step="100" value="{{ $maxPrice ?? 10000 }}" class="form-control-range">
        </div>
        <div class="d-flex justify-content-between">
            <span>Min: $<span id="min-value">{{ $minPrice ?? 0 }}</span></span>
            <span>Max: $<span id="max-value">{{ $maxPrice ?? 20000 }}</span></span>
        </div>
    </div>  
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const minPriceSlider = document.getElementById('min-price');
    const maxPriceSlider = document.getElementById('max-price');
    const minValue = document.getElementById('min-value');
    const maxValue = document.getElementById('max-value');

    // Update the values when sliders are moved
    minPriceSlider.addEventListener('input', function () {
        minValue.textContent = minPriceSlider.value;
    });

    maxPriceSlider.addEventListener('input', function () {
        maxValue.textContent = maxPriceSlider.value;
    });
});
</script>

                <!-- Sort options -->
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
                                <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : asset('logo/NOIMAGE.png') }}" class="card-img-top img-fluid" alt="{{ $product->name }}">
                                <div class="custom-card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p>{{ $product->price }}</p>
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
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <!-- Centered Pagination -->
                    <div class="pb-2">
                        {{ $products->links() }}
                    </div>
                </div>
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

@endcan
@endsection
