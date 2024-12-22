@can('user-access')
@extends('layouts.Users.app')

@section('content')

<style>
    /* Main container styling */
    .search-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    h2 {
        color: #555;
        margin-top: 30px;
        border-bottom: 2px solid #007BFF;
        padding-bottom: 5px;
    }

    /* Shop and Product Card Styles */
    .result-card {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease-in-out;
    }

    .result-card:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }

    .result-card h3 {
        margin: 0;
        font-size: 1.2rem;
        color: #007BFF;
    }

    .result-card p {
        margin: 5px 0;
        color: #555;
    }

    /* Link styles */
    .view-details-link {
        display: inline-block;
        background-color: #007BFF;
        color: #fff;
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: background-color 0.3s ease-in-out;
    }

    .view-details-link:hover {
        background-color: #0056b3;
    }

    /* Empty results message */
    .no-results {
        text-align: center;
        color: #888;
        font-style: italic;
    }
</style>

<div class="search-container">
    <h1>Search Results for: <strong>{{ $query }}</strong></h1>

    <!-- Shops Section -->
    <h2>Shops ({{ $shops->count() }})</h2>
    @if($shops->count() > 0)
        @foreach($shops as $shop)
            <div class="result-card">
                <div>
                    <h3>{{ $shop->businessName }}</h3>
                    <p><strong>Address:</strong> {{ $shop->fullAddress }}</p>
                    <p><strong>Email:</strong> {{ $shop->businessEmail }}</p>
                    <p><strong>Phone:</strong> {{ $shop->businessPhone }}</p>
                </div>
                <a href="" class="view-details-link">View Details</a>
            </div>
        @endforeach
    @else
        <p class="no-results">No shops found matching your query.</p>
    @endif

    <!-- Products Section -->
    <h2>Products ({{ $products->count() }})</h2>
    @if($products->count() > 0)
        @foreach($products as $product)
            <div class="result-card">
                <div>
                    <h3>{{ $product->productName }}</h3>
                    <p><strong>Category:</strong> {{ $product->category }}</p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                </div>
                <a href="" class="view-details-link">View Details</a>
            </div>
        @endforeach
    @else
        <p class="no-results">No products found matching your query.</p>
    @endif
</div>

@endsection
@endcan
