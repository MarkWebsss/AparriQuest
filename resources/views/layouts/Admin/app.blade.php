<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Boxicons -->
 <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 d-flex flex-column flex-md-row">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-white border-end d-none d-md-block">
        <div class="sidebar-header p-4 d-flex justify-content-center align-items-center">
            <a href="{{ route('dashboard') }}" class="logo-container">
                <img src="{{ asset('logo/combinelogo.png') }}" alt="Logo" id="logo-container" class="img-fluid" style="max-width: 150px; height: auto;">
            </a>
        </div>

<style>
    /* Default styles for the sidebar buttons */
    .nav-link {
        border-radius: 5px;
        font-weight: 500;
        text-align: center;
        width: 100%; /* Full width buttons */
    }

    /* Hover effect for primary buttons */
    .btn-primary:hover {
        background-color: #2b2a4c; /* Change to a darker shade of blue */
        color: #fff; /* Ensure text is white */
    }

    /* Hover effect for outline secondary buttons */
    .btn-outline-secondary:hover {
        background-color: #6c757d; /* Gray background on hover */
        color: #fff; /* White text on hover */
        border-color: #6c757d; /* Keep the border consistent with the background */
    }

    /* Custom hover effect for outline primary buttons */
    .btn-outline-primary:hover {
        background-color: #2b2a4c;  /* Bootstrap primary blue */
        color: #fff; /* White text on hover */
        border-color: #007bff; /* Change the border to the same color */
    }

    /* General transition for smooth hover effect */
    .nav-link, .btn {
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .nav-link.active {
        background-color: #0056b3; /* Darker blue for active */
        color: white; /* Ensure text is white */
        border-color: #0056b3; /* Same as background for border */
    }

    /* Ensure proper spacing between links */
    .mb-3 {
        margin-bottom: 1rem;
    }

    /* Sidebar responsive adjustments */
    #sidebar {
        width: 250px;
        min-height: 100vh;
    }

    .float-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        transition: all 0.3s;
    }

    .flex-1 {
        flex: 1;
    }

    @media (max-width: 767px) {
        #sidebar {
            display: none; /* Hide the sidebar on mobile */
        }
    }
</style>
<ul class="list-unstyled m-4">
    <li class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary p-2 nav-link d-flex align-items-center {{ Request::routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
    </li>
    <li class="mb-3">
        <a href="{{ route('business.index') }}" class="btn btn-outline-primary p-2 nav-link d-flex align-items-center {{ Request::routeIs('business.index') ? 'active' : '' }}">
            <i class="fa-solid fa-building me-2"></i> Manage Businesses
        </a>
    </li>
    <li class="mb-3">
        <a href="{{ route('admin.claim-requests.index') }}" class="btn btn-outline-primary p-2 nav-link d-flex align-items-center {{ Request::routeIs('products.index') ? 'active' : '' }}">
        <i class="fas fa-users me-2"></i> Claim Requests
        </a>
    </li>
    <li class="mb-3">
        <a href="#" class="btn btn-outline-primary p-2 nav-link d-flex align-items-center {{ Request::routeIs('feedback') ? 'active' : '' }}">
            <i class="fas fa-comment-dots me-2"></i> Feedback
        </a>
    </li>
    <li class="mb-3">
        <a href="{{ route('admin.report') }}" class="btn btn-outline-primary p-2 nav-link d-flex align-items-center {{ Request::routeIs('feedback') ? 'active' : '' }}">
            <i class="fas fa-comment-dots me-2"></i> Generate Reports
        </a>
    </li>
    <li class="mb-3">
        <a href="{{ route('admin.edit') }}" class="btn btn-outline-primary p-2 nav-link d-flex align-items-center {{ Request::routeIs('settings') ? 'active' : '' }}">
            <i class="fas fa-cog me-2"></i> Settings
        </a>
    </li>
    <li>
        <form method="POST" action="{{ route('logout') }}" class="px-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100 py-2 d-flex align-items-center">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </li>
</ul>


</nav>

        <!-- Page Content -->
        <div class="flex-1">
            <!-- Hamburger button for mobile -->
            <button class="float-button btn btn-primary d-md-none mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                <i class="fas fa-bars"></i>
            </button>

            @include('layouts.Admin.navigation')

            <main>
                @yield('content')
            </main>
        </div>

        <!-- Offcanvas Sidebar for mobile -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasSidebarLabel">
                <a href="{{ route('dashboard') }}">
                        <div class="logo-container">
                    <a href="#"><img src="{{ asset('logo/combinelogo.png') }}" alt="" id="logo-container" class=""></a>
                    </div>
                    </a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary nav-link px-3 py-2 d-block">Dashboard</a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('admin.edit') }}" class="btn btn-outline-secondary nav-link px-3 py-2 d-block">Profile</a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('business.index') }}" class="btn btn-outline-secondary nav-link px-3 py-2 d-block">Manage Business</a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('admin.claim-requests.index') }}" class="btn btn-outline-secondary nav-link px-3 py-2 d-block">Claim Requests</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="btn btn-outline-secondary nav-link px-3 py-2 d-block">Feedback</a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="btn btn-outline-secondary nav-link px-3 py-2 d-block">Settings</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="px-3">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100 py-2">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- jQuery (Include Before Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Section Scripts -->
    @yield('scripts')

    <!-- Sidebar Style -->
    <style>
    #sidebar {
        position: fixed; /* Fix the sidebar */
        top: 0; /* Pin to the top */
        left: 0; /* Pin to the left */
        width: 250px; /* Sidebar width */
        min-height: 100vh; /* Full height of the viewport */
        z-index: 999; /* Ensure it stays on top */
        background-color: white; /* Background color */
        border-right: 1px solid #e3e6f0; /* Optional border */
    }

        .float-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            transition: all 0.3s;
        }
        .flex-1 {
            margin-left: 250px; /* Offset the content by the sidebar width */
            flex: 1;/* Optional padding */
        }

        @media (max-width: 767px) {
            #sidebar {
                display: none; /* Hide the sidebar on mobile */
            }
            .flex-1 {
                margin-left: 0; /* Remove the offset when sidebar is hidden */
            }
        }
    </style>

</body>
</html>
