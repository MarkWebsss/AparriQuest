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
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
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
            <form action="{{ route('users.search.shop') }}" method="get" class="w-75">
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
        
        <!-- Product Viewing Section -->
        <section class="product-section">
            <div class="container">
                <h2 class="prod text-center mb-4 border rounded-top p-3 border-success border-4">Daily Discover</h2>
                <div class="row g-0">
                    @forelse($products as $product)
                        <div class="col-6 col-lg-2 mb-3 px-2 px-lg-1">
                            <div class="product-card shadow-sm">
                                <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : asset('logo/NOIMAGE.png') }}" class="product-image img-fluid" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text text-primary"><strong>Price: ₱{{ $product->price }}</p></strong>
                                    <p class="card-text text-muted">{{ $product->status }}</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('users.products.productview', $product->id) }}" class="btn btn-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">No product available</p>
                        </div>
                    @endforelse
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
