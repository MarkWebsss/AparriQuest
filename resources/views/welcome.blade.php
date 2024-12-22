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

      <!-- Include Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Include Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
    <style>
        #welcome {
            background-image: 
            linear-gradient(to top, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0) 50%),
                url('{{ asset('aparriquest/36796202.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
        }
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
        .search-container {
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
                <div style="width: 25px; height: 3px; background-color: #000; border-radius: 5px; margin: 5px auto;"></div>
                <div style="width: 25px; height: 3px; background-color: #000; border-radius: 5px; margin: 5px auto;"></div>
                <div style="width: 25px; height: 3px; background-color: #000; border-radius: 5px; margin: 5px auto;"></div>
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
                        <a href="#about" class="nav-link text-dark fw-bold">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact-us" class="nav-link text-dark fw-bold">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#products" class="nav-link text-dark fw-bold">Products</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('shop') }}" class="nav-link text-dark fw-bold">Shops</a>
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

<!--Animate on Scroll Script-->
<script>
  AOS.init();
</script>

<section id="welcome" data-aos="fade-up" style="height: 100vh;">
    <div id="welcomeCarousel" class="carousel slide h-100" data-bs-ride="carousel" style="width: 100%;">
        <div class="carousel-inner h-100">
            <!-- First Slide: Logo and Welcome Text -->
            <div class="carousel-item active h-100">
                <div class="d-flex flex-column justify-content-center align-items-center vh-100 text-center">
                    <form action="{{ route('search') }}" method="get" class="w-75 mb-4">
                        <div class="input-group search-container">
                            <input type="search" name="query" class="form-control p-2" placeholder="Search Shop" aria-label="Search Products">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                    <img src="{{ asset('logo/textlogo.png') }}" alt="Logo" class="pb-3 img-fluid">
                    <h5 class="pb-3 outlined-text fw-bold">Find your shop anytime, anywhere!</h5>
                    <p class="outlined-text fw-bold">Don’t know the locations of different shops in Aparri? Just search the product that you need!</p>
                </div>
            </div>
            
            <style>
/* Default styling (applies to all screen sizes) */
.shop-card {
    width: 100%;
}

@media (min-width: 768px) {
    .shop-card {
        width: 48%; 
    }
}

@media (min-width: 992px) {
    .shop-card {
        width: 30%;
    }
}
</style>

<div class="carousel-item h-100">
    <div class="d-flex flex-column justify-content-center align-items-center text-center m-4">
        <h3 class="card-header pb-3 outlined-text fw-bold" style="font-size: 2rem;">Top 3 Most Viewed Shops</h3>
        @if($topShops->isEmpty())
            <p style="font-size: 1.2rem;">No shops have been viewed yet.</p>
        @else
            <div class="row w-100 justify-content-center g-4">
                @foreach($topShops as $index => $shop)
                    <div class="col-12 col-sm-6 col-md-4 shop-card"> <!-- Apply shop-card class -->
                        <div class="card shadow-lg border-light rounded h-100">
                            <div class="card-body text-center">
                                <div>
                                    <img src="{{ $shop->shopLogo ? asset('storage/' . $shop->shopLogo) : asset('logo/user.png') }}" 
                                         alt="{{ $shop->businessName }} Logo" 
                                         class="img-fluid rounded-circle mx-auto d-block" 
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <h5 class="fs-4">
                                    @if($index === 0)
                                        <i class="fas fa-trophy text-warning"></i>
                                    @elseif($index === 1)
                                        <i class="fas fa-trophy text-secondary"></i>
                                    @elseif($index === 2)
                                        <i class="fas fa-trophy text-bronze"></i>
                                    @endif
                                    {{ $shop->businessName }}
                                </h5>
                                <p class="text-muted">Views: {{ $shop->view_count }}</p>
                                @if(auth()->check())
                                    <a href="{{ route('products.productview', $shop->id) }}" class="btn btn-primary">View Details</a>
                                @else
                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="showLoginAlert(event)">View Details</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
        </div>
        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#welcomeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>


<script>
    var carouselElement = document.querySelector('#welcomeCarousel');
    var carousel = new bootstrap.Carousel(carouselElement, {
        interval: 5000,
        ride: 'carousel'
    });
</script>

<section id="about"  class="bg-success">

<div id="map" style="width: 100%; height: 600px;"></div>
            
<script>
  var map = L.map('map').setView([18.35, 121.64], 14);

  // Add OpenStreetMap tiles
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Create a custom market icon
  var marketIcon = L.icon({
    iconUrl: '/logo/marketlogo.png', 
    iconSize: [60, 50], 
    iconAnchor: [20, 40],  
    popupAnchor: [0, -40] 
  });

  fetch('/api/businesses')
    .then(response => response.json())
    .then(data => {
      data.forEach(function(business) {
        if (business.latitude && business.longitude) {
          var marker = L.marker([business.latitude, business.longitude], { icon: marketIcon }).addTo(map);

          var businessDetailsUrl = `/business/${business.id}`;

          marker.bindTooltip(`
            <b>${business.businessName}</b><br>
            ${business.fullAddress}<br>
            ${business.businessEmail}<br>
            ${business.businessPhone}<br>
            <a href="${businessDetailsUrl}" style="color: blue;">View Details</a>
          `, {
            permanent: false, 
            direction: 'top',  
            className: 'custom-tooltip'
          });

          marker.bindPopup(`
            <b>${business.businessName}</b><br>
            ${business.fullAddress}<br>
            ${business.businessEmail}<br>
            ${business.businessPhone}<br>
            <a href="${businessDetailsUrl}">View Details</a>
          `);
        }
      });
    })
    .catch(error => console.error('Error fetching business data:', error));
</script>


<style>
    .leaflet-tooltip.custom-tooltip {
  background-color: #333;
  color: #fff;
  font-size: 12px;
  padding: 5px;
  border-radius: 4px;
  border: 1px solid #fff;
}
</style>

    </section>
    <style>
    .product-container {
        display: flex;
        flex-wrap: wrap;
        border-radius: 15px;
        justify-content: center;
    }

    .product-column {
        flex: 0 0 calc(100% / 5 - 10px);
        max-width: calc(100% / 5 - 10px);
        padding: 10px;
        box-sizing: border-box;
    }

    .product-column img {
        height: 150px;
        width: 100%;
        object-fit: cover;
    }

    @media (max-width: 1200px) {
        .product-column {
            flex: 0 0 calc(100% / 4 - 10px); 
            max-width: calc(100% / 4 - 10px);
        }
    }

    @media (max-width: 992px) {
        .product-column {
            flex: 0 0 calc(100% / 3 - 10px); 
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
                            <div class="card">
                                <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : asset('logo/NOIMAGE.png') }}" 
                                     class="card-img-top" 
                                     alt="{{ $product->name }}">
                                <div class="card-body bg-light">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Price: ₱{{ $product->price }}</p>
                                    <a href="{{ route('products.productview', $product->id) }}" class="btn btn-primary">View Details</a>
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


<style>
.pagination {
    display: flex;
    justify-content: center; 
    align-items: center;
    margin-top: 20px; 
    list-style: none;
    padding: 0;
}

.pagination a, .pagination span {
    display: inline-block;
    text-decoration: none;
    border: 1px solid #007bff;
    border-radius: 5px;
    color: #007bff;
    margin: 0 5px; 
    transition: all 0.3s ease;
    font-size: 14px;
}

.pagination .active span {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.pagination a:hover {
    background-color: #0056b3;
    color: #fff;
    border-color: #0056b3;
}

.pagination .disabled span {
    background-color: #e9ecef;
    color: #6c757d;
    border-color: #e9ecef;
    pointer-events: none;
    cursor: not-allowed;
}
</style>
<section id="shops">
<div class="container my-5">
    <h2 class="text-center">Shops You May Like</h2>

    <div class="row pt-2">
        @foreach ($businesses as $business)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img 
                        src="{{ $business->shopLogo ? asset('storage/' . $business->shopLogo) : asset('logo/user.png') }}" 
                        alt="{{ $business->business_name }}" 
                        class="card-img-top" 
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $business->businessName }}</h5>
                        <p class="card-text">{{ Str::limit($business->description, 100) }}</p>
                        <p class="card-text">
                            Average Rating: 
                            @if($business->averageRating)
                                {{ $business->averageRating }}
                            @else
                                No ratings yet
                            @endif
                        </p> <!-- Display average rating -->
                        <a href="{{ route('business.index', $business->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        
    </div>
</div>
</section>

<section id="contact-us" class="">
    <div class="container">
        <!-- Meet the Team -->
        <div class="row text-center">
            <h3 class="mb-4">Meet Our Team</h3>
            <!-- Team Member 1 -->
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="{{ asset('images/member1.jpg') }}" alt="Member 1" class="card-img-top rounded-circle img-fluid shadow-sm" style="width: 150px; height: 150px; margin: 0 auto;">
                    <div class="card-body">
                        <h5 class="card-title">Member 1</h5>
                        <p class="card-text">Role: Developer</p>
                    </div>
                </div>
            </div>
            <!-- Team Member 2 -->
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="{{ asset('images/member2.jpg') }}" alt="Member 2" class="card-img-top rounded-circle img-fluid shadow-sm" style="width: 150px; height: 150px; margin: 0 auto;">
                    <div class="card-body">
                        <h5 class="card-title">Member 2</h5>
                        <p class="card-text">Role: Designer</p>
                    </div>
                </div>
            </div>
            <!-- Team Member 3 -->
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="{{ asset('images/member3.jpg') }}" alt="Member 3" class="card-img-top rounded-circle img-fluid shadow-sm" style="width: 150px; height: 150px; margin: 0 auto;">
                    <div class="card-body">
                        <h5 class="card-title">Member 3</h5>
                        <p class="card-text">Role: Content Manager</p>
                    </div>
                </div>
            </div>
            <!-- Team Member 4 -->
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="{{ asset('images/member4.jpg') }}" alt="Member 4" class="card-img-top rounded-circle img-fluid shadow-sm" style="width: 150px; height: 150px; margin: 0 auto;">
                    <div class="card-body">
                        <h5 class="card-title">Member 4</h5>
                        <p class="card-text">Role: Project Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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
footer {
        margin-top: 50px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    footer a:hover {
        text-decoration: underline;
        color: #f8c93e; 
    }

    footer p {
        line-height: 1.6;
    }

    footer .list-unstyled li {
        margin-bottom: 8px; 
    }
</style> 

    <!-- Footer Section -->
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4">
                <h5 class="text-uppercase">About AparriQuest</h5>
                <p class="small">
                    AparriQuest is your trusted companion to discover shops and products in Aparri. We aim to make shopping easier, faster, and more convenient for everyone.
                </p>
            </div>

            <!-- Quick Links Section -->
            <div class="col-md-4">
                <h5 class="text-uppercase">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#about" class="text-white text-decoration-none">About</a></li>
                    <li><a href="#contact" class="text-white text-decoration-none">Contact Us</a></li>
                    <li><a href="#products" class="text-white text-decoration-none">Products</a></li>
                </ul>
            </div>

            <!-- Social Media Section -->
            <div class="col-md-4">
                <h5 class="text-uppercase">Follow Us</h5>
                <a href="#" class="text-white me-2">
                    <box-icon name="facebook-circle" type="logo" size="md"></box-icon>
                </a>
                <a href="#" class="text-white me-2">
                    <box-icon name="twitter" type="logo" size="md"></box-icon>
                </a>
                <a href="#" class="text-white me-2">
                    <box-icon name="instagram" type="logo" size="md"></box-icon>
                </a>
                <a href="#" class="text-white me-2">
                    <box-icon name="linkedin-square" type="logo" size="md"></box-icon>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col text-center">
                <p class="mb-0 small">© {{ now()->year }} AparriQuest. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

    <!-- Scripts -->
    <script src="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.js') }}"></script>

    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) { 
                navbar.classList.add('shrink');
            } else {
                navbar.classList.remove('shrink');
            }
        });

        const aboutSection = document.getElementById('about');
        const cards = document.querySelectorAll('.card');

        function fadeInCards() {
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('visible'); 
                }, index * 200);
            });
        }

        
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
</body>
</html>