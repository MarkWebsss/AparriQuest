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

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<style>
    .custom-container {
        margin-bottom: 80px; 
    }
    .dis {
        font-weight: 500;
    }

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
        color: white;
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

    .no-underline::after {
        display: none;
    }

    section {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .card {
        opacity: 0; 
        transform: translateY(20px); 
        transition: opacity 0.5s ease-in, transform 0.5s ease-in; 
    }

    .card.visible {
        opacity: 1;
        transform: translateY(0); 
    }

    .container-fluid {
        padding: 0 30px;
    }

    .container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-top: 20px;
}

    .row {
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
    }

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
        height: 250px;
    }

    .custom-card:hover {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .custom-card-body {
        flex-grow: 1;
    }

    .card-title {
        font-weight: 600;
        margin-bottom: 10px;
        color: #343a40;
    }

    .card-text {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 15px;
    }

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

    .text-center p {
        font-size: 1.2rem;
        color: #999;
        margin-top: 20px;
    }

    @media (max-width: 992px) {
        .shop-column {
            flex: 0 0 48%; 
            max-width: 48%;
        }
        .filter-column{
            text-align: center;
            padding-left: 20px;
        }
    }

    @media (max-width: 768px) {
        .shop-column {
            flex: 0 0 100%; 
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
    .container-shop{
        padding: 30px;
    }
</style>

<body class="antialiased bg-success-subtle">
    <nav class="navbar navbar-expand-lg navbar-dark p-3" id="mainNavbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none; background: transparent;">
                <div style="width: 25px; height: 3px; background-color: #fff; border-radius: 5px; margin: 5px auto;"></div>
                <div style="width: 25px; height: 3px; background-color: #fff; border-radius: 5px; margin: 5px auto;"></div>
                <div style="width: 25px; height: 3px; background-color: #fff; border-radius: 5px; margin: 5px auto;"></div>
            </button>
            <div class="logo-container">
                <a href=""><img src="{{ asset('logo/combinelogo.png') }}" alt="" id="logo1" class=""></a>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold" href="{{ route('landing.page') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#products" class="nav-link text-dark fw-bold">Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="#shops" class="nav-link text-dark fw-bold">Shops</a>
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
<style>
    
</style>
<div class="container-shop">
    <div class="row">
        <div class="filter-column col-md-3">
            <h3>Shops</h3>
            <form action="{{ route('search') }}" method="get">
                <input type="text" name="query" class="form-control" placeholder="Search Shops" value="{{ request('query') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div class="col-md-9">
            <div class="row">
                @if($shops->isEmpty())
                    <div class="col-12 no-shops-message">
                        <p>No shops found for "{{ request()->input('query') }}".</p>
                    </div>
                @else
                    @foreach($shops as $shop)
                        <div class="col-md-6">
                            <div class="custom-card m-2">
                                <!-- Text content (on the left side) -->
                                <div class="custom-card-body">
                                    <h2 class="card-title">{{ $shop->businessName }}</h2>
                                    <p class="card-text">Location: {{ $shop->fullAddress }}</p>
                                    <p class="card-text">Views: {{ $shop->view_count }}</p>
                                    <div class="rating">
                                        <p>Shop Rating: 
                                            @if(is_numeric($shop->averageRating))
                                                <span class="stars">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= floor($shop->averageRating))
                                                            ★
                                                        @else
                                                            ☆
                                                        @endif
                                                    @endfor
                                                </span> 
                                                ({{ number_format($shop->averageRating, 1) }} / 5)
                                            @else
                                                No ratings yet
                                            @endif
                                        </p>
                                    </div>
                                    <a href="{{ route('business.index', $shop->id) }}" class="btn btn-view-shop">View Shop</a>
                                </div>

                                <!-- Background image container with logo on the right side -->
                                <div class="background-image" style="background-image: url('{{ asset('storage/' . $shop->shopLogo) }}');"></div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
</html>
