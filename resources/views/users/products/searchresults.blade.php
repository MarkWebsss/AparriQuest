@extends('layouts.Users.app')

@section('content')
<style>
    /* General Page Layout */
.container-fluid {
    padding: 0 30px;
}

.row {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
}

/* Sidebar Filter Section (Left Column) */
.filter-column {
    flex: 0 0 300px;
    padding: 20px;
    margin-right: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.filter-column h3 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    font-weight: bold;
}

.filter-column .form-control {
    margin-bottom: 15px;
}

.filter-column .form-select {
    margin-bottom: 15px;
}

.filter-column .btn {
    width: 100%;
}

.col {
    flex: 1;
}

.shop-column {
    padding: 15px;
    flex: 0 0 100%;
    max-width: 100%;
    box-sizing: border-box;
}

.custom-card {
    border: 1px solid #dee2e6;
    border-radius: .25rem;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    transition: box-shadow .15s ease-in-out;
    padding: 20px;
    height: 100%;
}

.custom-card:hover {
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

/* Card Body */
.custom-card-body {
    flex-grow: 1;
}

/* Card Title */
.card-title {
    font-weight: 600;
    margin-bottom: 10px;
    color: #343a40;
}

/* Card Text */
.card-text {
    font-size: 1rem;
    color: #6c757d;
    margin-bottom: 15px;
}

/* Products List inside each Shop */
ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

ul li {
    font-size: 1rem;
    margin-bottom: 5px;
    color: #495057;
}

ul li span {
    font-weight: 600;
}

/* Button Style */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
    padding: 8px 20px;
    text-align: center;
    border-radius: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

/* Empty State for No Shops */
.text-center p {
    font-size: 1.2rem;
    color: #999;
    margin-top: 20px;
}

/* Responsive Styles */
@media (max-width: 992px) {
    .shop-column {
        flex: 0 0 48%; /* Two columns on medium screens */
        max-width: 48%;
    }
}

@media (max-width: 768px) {
    .shop-column {
        flex: 0 0 100%; /* One column on small screens */
        max-width: 100%;
    }
}

.footer {
    background-color: #f8f9fa;
    padding: 20px;
    margin-top: 30px;
    text-align: center;
}

.footer p {
    font-size: 0.9rem;
    color: #6c757d;
}

.footer a {
    color: #007bff;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}
</style>

<div class="container-fluid mt-5">
    <div class="row">
        <!-- Sidebar filter section (Left column) -->
        <div class="filter-column">
            <h3 class="filter-heading">Shops</h3>
            <form action="{{ route('users.search.shop') }}" method="get">
                <input type="text" name="query" class="form-control" placeholder="Search Products or Keywords" value="{{ request('query') }}">
                <select name="sort" class="form-select">
                    <option value="">Sort By</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <!-- Shops Display (Right Column) -->
        <div class="col">
            <div class="row d-flex flex-wrap">
                <!-- Display message if no shops are found -->
                @if($shops->isEmpty())
                    <div class="col-lg-12 text-center mt-3">
                        <p>No shops found selling "{{ request()->input('query') }}".</p>
                    </div>
                @else
                    @foreach ($shops as $shop)
                    @if($shop->user && $shop->user->business)  
                    <div class="shop-column">
                            <div class="custom-card">
                                <div class="custom-card-body">
                                <h2 class="card-title d-flex justify-content-between align-items-center">
                                    {{ $shop->businessName }}
                                    <a href="{{ route('users.view.shop', $shop->user->business->id) }}" class="btn btn-primary">
                                        View Shop
                                    </a>
                                </h2>
                                    
                                    <p class="card-text">Location: {{ $shop->fullAddress }}</p>
                                    
                                    <h6>Shop Rating: 
                                        @if(is_numeric($shop->averageRating))
                                            {{ number_format($shop->averageRating, 1) }} / 5
                                            <span>
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= floor($shop->averageRating))
                                                        ★
                                                    @else
                                                        ☆
                                                    @endif
                                                @endfor
                                            </span>
                                        @else
                                            {{ $shop->averageRating }}
                                        @endif
                                    </h6>

                                    <!-- Product List displayed in rows using Bootstrap grid system -->
                                    <h4>Products:</h4>
                                        <div class="d-flex flex-row justify-content-start flex-wrap">
                                            @foreach ($shop->user->products->take(4) as $product)
                                                <div class="product-card text-center me-3">
                                                    <center>
                                                    <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : asset('logo/NOIMAGE.png') }}" 
                                                        alt="{{ $product->name }}" 
                                                        style="object-fit: cover; border-radius: 10px; margin-bottom: 10px;"
                                                        class="w-75 h-20">
                                                        </center>
                                                    <p>{{ $product->name }}</p>
                                                    <p>₱{{ number_format($product->price, 2) }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
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

@endsection
