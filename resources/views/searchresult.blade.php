<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AparriQuest') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.css') }}">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <style>
    /* Overall Styles */
    .custom-container {
        margin-bottom: 80px;
    }
    .dis {
        font-weight: 500;
    }

    /* Navbar */
    .navbar {
        position: sticky;
        top: 0;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 20px 30px;
        transition: padding 0.3s ease, background-color 0.3s ease;
        z-index: 1000;
        color: black;
    }

    .navbar.shrink {
        padding: 10px 30px;
        backdrop-filter: blur(5px);
    }

    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-left: 20px;
    }

    .logo-container img {
        max-width: 100px;
        height: auto;
    }

    .nav-link {
        margin: 6px;
        position: relative;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -2px;
        height: 2px;
        background-color: #007bff;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .outlined-text {
        color: #2b2a4c;
        text-shadow: 
            -1px -1px 0 white,  
            1px -1px 0 white,
            -1px 1px 0 white,
            1px 1px 0 white;
    }

    .nav-link:hover::after {
        transform: scaleX(1);
    }

    /* Section Styling */
    section {
        padding: 60px 0;
        overflow: visible;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    /* Card Styling */
    .product-column {
        display: flex;
        justify-content: center;
        align-items: stretch;
        padding: 15px;
        width: 100%; /* Take full width of the row */
    }

    .card {
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-bottom: 20px;
        background-color: white;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        text-transform: uppercase;
        transition: background-color 0.3s ease;
        text-align: center;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .product-column img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-column {
            width: 100%;
            margin-bottom: 20px;
        }

        .card-body {
            padding: 15px;
        }

        .btn-primary {
            font-size: 1rem;
        }
    }

    /* Card Grid Layout */
    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px; /* Adds gap between columns */
        justify-content: center;
    }

</style>

</head>
<body class="antialiased bg-success-subtle">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark p-3" id="mainNavbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none; background: transparent;">
                <div style="width: 25px; height: 3px; background-color: #fff; border-radius: 5px; margin: 5px auto;"></div>
                <div style="width: 25px; height: 3px; background-color: #fff; border-radius: 5px; margin: 5px auto;"></div>
                <div style="width: 25px; height: 3px; background-color: #fff; border-radius: 5px; margin: 5px auto;"></div>
            </button>
            <div class="logo-container">
                <a href="#"><img src="{{ asset('logo/combinelogo.png') }}" alt="" id="logo1" class=""></a>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold" href="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link text-dark fw-bold">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link text-dark fw-bold">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-dark fw-bold">Feedbacks</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link px-5 text-dark fw-bold">Log in</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Search Results Section -->
    <section id="search-results">
        <div class="container">
            <h2 class="text-center mb-4">Search Results for "{{ request('query') }}"</h2>
            <div class="row">
                @if($products->isEmpty())
                    <div class="col-12 text-center">
                        <p>No results found for your search. Please try again with different keywords.</p>
                    </div>
                @else
                    @foreach ($products as $product)
                        <div class="product-column col-md-3">
                            <div class="card">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Price: {{ $product->price }}</p>
                                    <p class="card-text">Status: {{ $product->status }}</p>
                                    <a href="#" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</body>

