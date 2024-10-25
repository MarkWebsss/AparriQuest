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
                    <a href="#"><img src="{{ asset('logo/combinelogo.png') }}" alt="" id="logo1" class=""></a>
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

    <!-- Welcome Section -->
    <section id="welcome" style="height: 100vh;">
        <div class="con1 container d-flex flex-column justify-content-center align-items-center vh-100 text-center custom-container">
            <img src="{{ asset('logo/textlogo.png') }}" alt="" class="pb-3 img-fluid">
            <h5 class="pb-3 outlined-text fw-bold">Find your shop anytime, anywhere!</h5>
            <p class="outlined-text fw-bold">Don’t know the locations of different shops in Aparri? Just search the product that you need!</p>

            <!-- Replacing search bar with two buttons -->
            <div class="d-flex flex-column align-items-center mt-4">
                <p class="mb-2 fw-bold" style="font-size: 1.2rem;">Register Here as:</p>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('register') }}" class="btn bg-success mx-3 px-4 py-2">User</a>
                    <a href="{{ route('register.business') }}" class="btn bg-success mx-3 px-4 py-2">Owner</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="bg-success">
        <div class="container">
            <h2 class="text-center mb-4 text-white">About AparriQuest</h2>
            <p class="text-center mb-5 text-white">AparriQuest helps you locate various shops and products in Aparri, making your shopping experience seamless and efficient.</p>
            
            <div class="row justify-content-center">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title bg-primary border rounded-top p-2">Feature 1</h5>
                            <p class="card-text">Description of Feature 1. This feature helps users find the best shops in their vicinity.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title bg-primary border rounded-top p-2">Feature 2</h5>
                            <p class="card-text">Description of Feature 2. This feature offers user reviews and ratings of various shops.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title bg-primary border rounded-top p-2">Feature 3</h5>
                            <p class="card-text">Description of Feature 3. Users can search for specific products and see which shops carry them.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    /* Custom class for 5 products per row */
    .product-column {
        width: 20%;
        padding: 10px;
    }

    .product-column img {
        height: 150px; 
        object-fit: cover; 
    }

    /* Media queries for responsiveness */
    @media (max-width: 1200px) {
        .product-column {
            width: 25%; 
        }
    }

    @media (max-width: 992px) {
        .product-column {
            width: 33.33%; 
        }
    }

    @media (max-width: 768px) {
        .product-column {
            width: 50%; 
        }
    }

    @media (max-width: 576px) {
        .product-column {
            width: 100%; 
        }
    }

    .product-column img {
        height: 200px; 
        width: 100%; 
        object-fit: cover; 
    }

    /* Ensure the section grows with content */
    section {
        padding: 60px 0; 
        overflow: visible; 
    }
</style>

<section id="products">
        <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <h3 class="text-center">Available Products</h3>
            </div>

            <div class="col-lg-5">
                <!-- Search Box -->
                <form action="{{ route('search') }}" method="get" class="d-flex justify-content-center align-items-center">
                    <div class="input-group">
                        <input type="search" name="query" class="form-control" placeholder="Search Products" aria-label="Search Products">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            
            <div class="row">
                @foreach ($products as $product)
                    <div class="product-column col-md-3">
                        <div class="card" style="width: 100%;">
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
            </div>
        </div>
    </section>


<style>
/* Remove margin between <p> elements in product cards */
.product-column p {
    margin: 0; /* Removes margin between <p> tags */
}

/* Add space after product name */
.product-column h5 {
    margin-bottom: 5px;
}
</style>

    <!-- Contact Section -->
    <section id="contact" class="bg-primary">
        <div>
            <h2>Contact Us</h2>
            <p>Have feedback? Feel free to reach out to us at <a href="mailto:support@aparriquest.com">support@aparriquest.com</a>.</p>
        </div>
    </section>

    <!-- Scripts -->
    <script src="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.js') }}"></script>

    <script>
        // Detect scroll and apply 'shrink' class to the navbar
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) { // If scroll is more than 50px
                navbar.classList.add('shrink');
            } else {
                navbar.classList.remove('shrink');
            }
        });

        // Make cards visible when the About section comes into view
        const aboutSection = document.getElementById('about');
        const cards = document.querySelectorAll('.card');

        // Fade-in effect for cards when entering the About section
        function fadeInCards() {
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('visible'); // Add visible class
                }, index * 200); // Stagger the fade-in effect
            });
        }

        // Trigger fade-in when the section is in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    fadeInCards(); // Trigger fade-in when the section is in view
                    observer.unobserve(entry.target); // Unobserve after fade-in
                }
            });
        });

        observer.observe(aboutSection); // Observe the About section

        // Trigger fade-in on page load
        window.addEventListener('load', fadeInCards); // Trigger fade-in on initial load
    </script>
</body>
</html>