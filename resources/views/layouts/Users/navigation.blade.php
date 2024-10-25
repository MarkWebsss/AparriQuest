<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <div class="logo-container">
                            <a href="#"><img src="{{ asset('logo/combinelogo.png') }}" alt="" id="logo-container" class=""></a>
                        </div>
                    </a>
                </div>
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
                    background: rgba(255, 255, 255, 0.5); /* Semi-transparent background */
                    backdrop-filter: blur(10px); /* Apply blur effect */
                    transition: padding 0.3s ease, background-color 0.3s ease; 
                    z-index: 1000; 
                    color: black;
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
                
                #searchbtn {
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
                <!-- Navigation Links -->
                <nav class="navbar navbar-expand-lg navbar-dark p-3" id="mainNavbar">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link text-dark fw-bold" href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.feedback.create') }}" class="nav-link text-dark fw-bold">Send Feedback</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.myfeedback') }}" class="nav-link text-dark fw-bold">My Feedbacks</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.products.index') }}" class="nav-link text-dark fw-bold">All Products</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                {{ Auth::user()->name }}
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link>
                            {{ __('My Shop') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                        <x-dropdown-link>
                            Logged in as {{ Auth::user()->roles[0]->name}}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- for mobile view -->
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <!-- Add more navigation links here -->
            <x-responsive-nav-link :href="route('users.feedback.create')">
                {{ __('Send Feedback') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('users.myfeedback')">
                {{ __('My Feedbacks') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('users.products.index')">
                {{ __('All Products') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
