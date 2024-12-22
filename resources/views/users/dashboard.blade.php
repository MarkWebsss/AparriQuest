@can('user-access')
@extends('layouts.Users.app')

@section('content')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.css') }}">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://kit.fontawesome.com/039dd3507b.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #welcome {
            background-image: 
                linear-gradient(to top, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0) 50%),
                url('{{ asset('aparriquest/36796202.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
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
        .container-fluid, .container {
            padding-left: 0;
            padding-right: 0;
        }

        .product-section {
            background-color: #9EDF9C;
            padding: 20px 0;
        }

        .product-card {
            border: none;
            border-radius: 8px;
            overflow: hidden; /* Hide overflow to prevent large images from spilling out */
            height: 300px;  /* Fixed height for uniform card size */
            width: 100%;  /* Full width based on the column size */
            display: flex;
            flex-direction: column; /* Ensure content aligns vertically */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            height: 200px; /* Set a fixed height for the image */
            display: flex;
            width: 100%;   /* Full width of the card */
            object-fit: cover; /* Makes sure images fill the area without distortion */
            background-color: #f0f0f0; /* Light grey background for no image cases */
            justify-content: center;
            align-items: center;
        }

        .card-body {
            padding: 10px;
            background-color: #ffffff;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #2b2a4c;
        }

        .card-text {
            font-size: 0.85rem;
            color: #666666;
            margin-bottom: 0.3rem;
        }

        .card-text.text-primary {
            font-size: 1rem;
            font-weight: 600;
            color: #0066cc;
        }
        
        .card-text.text-muted {
            font-size: 0.8rem;
            color: #999999;
        }

        .btn-secondary:hover {
            background-color: #1f1e38;
        }

        .search-container {
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border: none;
            padding: 6px 10px; 
            font-size: 0.9rem;
            height: 36px; 
        }

        #search-button {
            border: none;
            background-color: #28a745;
            color: white;
            padding: 0 12px;
            display: flex;
            align-items: center;
            height: 36px; 
        }

        #search-button:hover {
            background-color: #526E48; 
        }

        @media (max-width: 576px) {
            .form-control {
                padding: 5px 8px;
                font-size: 0.85rem;
            }

            #search-button {
                padding: 0 8px;
            }
            .prod{
                margin: 20px;
                margin-top: 0px;
            }
            .foot{
                margin: 10px;
            }
        }

        footer {
    font-size: 0.9rem;
}

footer a:hover {
    color: #ddd; /* Lighter color on hover */
}

footer .btn {
    font-size: 0.8rem;
}

    </style>

    <div class="container-fluid">
        <section id="welcome" style="height: 100vh;">
            <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center">
            <form action="{{ route('users.search') }}" method="get" class="w-75">
                    <div class="input-group search-container mb-3">
                        <input 
                        type="search" 
                        name="query" 
                        class="form-control p-4" 
                        id="searchInput" 
                        placeholder="Find your shop here" 
                        aria-label="Search Shop" 
                        required 
                        oninvalid="this.setCustomValidity('Oops! Looks like you forgot to enter a search term.')" 
                        oninput="this.setCustomValidity('')">
                        <button type="submit" id="search-button" class="bg-success p-4 rounded-end">
                            <box-icon name='search-alt'></box-icon>
                        </button>
                    </div>
                </form>
                <img src="{{ asset('logo/textlogo.png') }}" alt="Text Logo" class="pb-3 img-fluid">
                <h5 class="pb-3 outlined-text fw-bold">Find your shop anytime, anywhere!</h5>
                <p class="outlined-text fw-bold">Don’t know the locations of different shops in Aparri? Just search for the product that you need!</p>
            </div>
        </section>
        <style> 
            .ft{
                font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            }
            .product-container {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: center; /* Ensures products are centered */
            }
            /* Flexbox for Responsive Layout */
            .product-container {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                justify-content: center; /* Ensures products are centered */
            }

            .product-column {
                flex: 0 0 calc(100% / 5 - 10px); /* 5 products per row */
                max-width: calc(100% / 5 - 10px);
                padding: 10px;
                box-sizing: border-box;
            }

            /* Adjust product image size */
            .product-column img {
                height: 150px;
                width: 100%;
                object-fit: cover;
            }

            /* Responsive Breakpoints */
            @media (max-width: 1200px) {
                .product-column {
                    flex: 0 0 calc(100% / 4 - 10px); /* 4 products per row */
                    max-width: calc(100% / 4 - 10px);
                }
            }

            @media (max-width: 992px) {
                .product-column {
                    flex: 0 0 calc(100% / 3 - 10px); /* 3 products per row */
                    max-width: calc(100% / 3 - 10px);
                }
            }

            @media (max-width: 768px) {
                .product-column {
                    flex: 0 0 calc(50%); /* 2 products per row */
                    max-width: calc(50%);
                }
            }

            @media (max-width: 576px) {
                .product-column {
                    flex: 0 0 calc(50% - 5px); /* 2 products per row (smallest screens) */
                    max-width: calc(50%);
                }
            }
            section{
                padding: 20px;
            }
            .pagination {
            display: flex;
            justify-content: center; 
            align-items: center;
            margin-top: 20px; 
            list-style: none;
            padding: 0;
        }
        .product-card {
            border: none;
            border-radius: 8px;
            overflow: hidden; /* Hide overflow to prevent large images from spilling out */
            height: 300px;  /* Fixed height for uniform card size */
            width: 100%;  /* Full width based on the column size */
            display: flex;
            flex-direction: column; /* Ensure content aligns vertically */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: scale(1.05);  /* Slightly enlarge the card */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Add a shadow effect on hover */
        }

        .product-card .card-body {
            transition: background-color 0.3s ease;
        }

        .product-card:hover .card-body {
            background-color: #f7f7f7; /* Light background color change when hovered */
        }

        .product-card:hover .card-title {
            color: #0066cc;  /* Change the title color on hover */
        }

        .product-card:hover .btn {
            background-color: #1f1e38; /* Darker button color on hover */
            color: #fff;  /* Change button text color to white */
        }

        </style>
        
        <section id="products">
            <div class="container">
                <div class="row">
                    <h3 class="text-center" id="banner">Available Products</h3>
                    <div class="product-container">
                        @if($products->isEmpty())
                            <div class="col-12 text-center">
                                <p>No products added yet.</p>
                            </div>
                        @else
                            @foreach ($products as $product)
                                <div class="product-column">
                                    <div class="card rounded">
                                        <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : asset('logo/NOIMAGE.png') }}" 
                                            class="card-img-top" 
                                            alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">Price: ₱{{ $product->price }}</p>
                                            @if ($product->status === 'Available')
                                                <p class="card-text" style="color: green;">Status: {{ ucfirst($product->status) }}</p>
                                            @else
                                                <p class="card-text" style="color: red;">Status: {{ ucfirst($product->status) }}</p>
                                            @endif

                                            @if(auth()->check())
                                                <a href="{{ route('users.products.productview', $product->id) }}" class="btn btn-primary w-100">View Details</a>
                                            @else
                                                <a href="javascript:void(0);" class="btn btn-primary" onclick="showLoginAlert(event)">View Details</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="pagination-wrapper">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </section>


        <footer class="bg-dark text-white py-4">
            <div class="container">
                <div class="foot row">
                    <div class="col-md-3">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="/about" class="text-white">About Us</a></li>
                            <li><a href="/contact" class="text-white">Contact</a></li>
                            <li><a href="/privacy" class="text-white">Privacy Policy</a></li>
                            <li><a href="/terms" class="text-white">Terms of Service</a></li>
                            <li><a href="/faqs" class="text-white">FAQs</a></li>
                        </ul>
                    </div>
                    
                    <div class="col-md-3">
                        <h5>Contact</h5>
                        <p>
                            123 Main Street, Aparri<br>
                            Phone: (123) 456-7890<br>
                            Email: info@example.com
                        </p>
                    </div>
                    
                    <div class="col-md-3">
                        <h5>Follow Us</h5>
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin"></i></a>
                    </div>
                    
                    <div class="col-md-3">
                        <h4>Send us an email</h4>
                        <p>Any problems? Any Concerns? Send us an email!</p>
                        <form>
                            <input type="email" class="form-control mb-2" placeholder="Your email">
                            <button type="submit" class="btn btn-success btn-sm">Send</button>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <p class="mb-0">&copy; {{ date('Y') }} AparriQuest. All Rights Reserved.</p>
                </div>
            </div>
        </footer>
    </div>
@endsection
@endcan
