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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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

        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }
        }
        #searchbtn{
            position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 1;
                display: flex;
                align-items: center;
                padding: 0.5rem;
        }

        .input-group {
            position: relative;
            padding-left: 2.5rem;
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
            <form action="{{ route('search') }}" method="get">
                <input type="text" name="query" class="form-control" placeholder="Search Products or Keywords" value="{{ request('query') }}">

                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <!-- Shops Display (Right Column) -->
        <div class="col">
            <div class="row d-flex flex-wrap">
                <!-- Display message if no shops are found -->
                @if($shops->isEmpty())
                    <div class="col-lg-12 text-center mt-3">
                        <p>No shops found named "{{ request()->input('query') }}".</p>
                    </div>
                @else
                    @foreach ($shops as $shop)
                        <div class="shop-column">
                            <div class="custom-card">
                                <div class="custom-card-body">
                                <h2 class="card-title d-flex justify-content-between align-items-center">
                                    {{ $shop->businessName }}
                                    <a href="{{ route('business.index', $shop->id) }}" onclick="showLoginAlert(event)" class="btn btn-primary">
                                        View Shop
                                    </a>
                                </h2>
                                <p class="text-muted">Views: {{ $shop->view_count }}</p>
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
                                    <!-- <h4>Products:</h4>
                                        <div class="d-flex flex-row justify-content-start flex-wrap">
                                            @foreach ($shop->user->products->take(4) as $product)
                                                <div class="product-card text-center me-3">
                                                    <center>
                                                    <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : asset('logo/NOIMAGE.png') }}" 
                                                        alt="{{ $product->name }}" 
                                                        style="object-fit: cover; border-radius: 10px; margin-bottom: 10px;"
                                                        class="w-20 h-20">
                                                        </center>
                                                    <p>{{ $product->name }}</p>
                                                    <p>₱{{ number_format($product->price, 2) }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div> -->
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Login Alert Modal -->
<div class="modal fade" id="loginAlertModal" tabindex="-1" aria-labelledby="loginAlertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="loginAlertModalLabel">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You must <strong>log in </strong>first to view the details of this product.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('login') }}" class="btn btn-success">Go to Login</a>
            </div>
        </div>
    </div>
</div>

<style>
.product-column p {
    margin: 0; 
}

.product-column h5 {
    margin-bottom: 5px;
}
.modal-content {
    border-radius: 8px; 
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
}

.modal-header {
    color: white;
    border-bottom: none; 
}

.modal-title {
    font-weight: 600; 
}

.modal-body {
    font-size: 16px; 
    color: #333; 
}

.modal-footer {
    border-top: none; 
}

.btn-secondary {
    background-color: #6c757d; 
    border: none; 
}

.btn-primary {
    background-color: #007bff;
    border: none;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3; 
}

.btn-close {
    color: white; 
}

@media (max-width: 576px) {
    .modal-dialog {
        margin: 1rem; 
    }
}

</style>

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
<script src="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.js') }}"></script>
<script>
            const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    fadeInCards();
                    observer.unobserve(entry.target); 
                }
            });
        });

        observer.observe(aboutSection); 

        window.addEventListener('load', fadeInCards); 

        function showLoginAlert(event) {
            event.preventDefault(); 
            var loginModal = new bootstrap.Modal(document.getElementById('loginAlertModal'), {
                keyboard: false
            });
            loginModal.show(); 
        }
</script>
</html>