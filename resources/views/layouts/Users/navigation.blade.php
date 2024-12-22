<nav x-data="{ open: false }" class="sticky top-0 bg-white bg-opacity-50 backdrop-blur-sm transition-all duration-300 ease-in-out z-50 text-black">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left Section: Logo and Navigation Links -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('logo/combinelogo.png') }}" alt="Logo" class="h-10 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:ml-10 sm:flex text-black">
                    <ul class="flex space-x-6 navbar">
                        <li><a href="{{ route('users.dashboard') }}" class="text-black no-underline px-3 py-2 rounded-md font-medium">
                        Dashboard
                        </a></li>
                        <li><a href="{{ route('users.feedback.create') }}" class="text-black no-underline px-3 py-2 rounded-md font-medium">
                        Send Feedback
                        </a></li>
                        <li><a href="{{ route('users.products.index') }}" class="text-black no-underline px-3 py-2 rounded-md font-medium">
                        Find Products
                        </a></li>
                        <li><a href="{{ route('users.search.shop') }}" class="text-black no-underline px-3 py-2 rounded-md font-medium">
                        Find Shop
                        </a></li>
                    </ul>
                </div>
            </div>

            <!-- Right Section: User Menu -->
            <div class="hidden sm:flex items-center space-x-4">
                <span class="text-black font-medium">
                    {{ Auth::user()->name }}
                </span>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-black hover:text-gray-200 focus:outline-none">
                            <svg class="h-5 w-5 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                    <div class="px-4 py-3">
                <span class="font-medium text-base">{{ Auth::user()->name }}</span>
                <span class="text-sm block">{{ Auth::user()->email }}</span>
            </div>
                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link class="no-underline" :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="-mr-2 flex sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden sticky bg-opacity-50 backdrop-blur-sm">
        <div class="space-y-1 pb-3">
            <a href="{{ route('users.dashboard') }}" class="block text-black no-underline px-3 py-2 rounded-md">
                Dashboard
            </a>
            <a href="{{ route('users.feedback.create') }}" class="block text-black no-underline px-3 py-2 rounded-md">
                Send Feedback
            </a>
            <a href="{{ route('users.products.index') }}" class="block text-black no-underline px-3 py-2 rounded-md">
                Find Product
            </a>
            <a href="{{ route('users.search.shop') }}" class="block text-black no-underline px-3 py-2 rounded-md">
                Find Shop
            </a>
        </div>
        <div class="border-t border-gray-700">
            <div class="px-4 py-3">
                <span class="font-medium text-base">{{ Auth::user()->name }}</span>
                <span class="text-sm block">{{ Auth::user()->email }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                @csrf
                <button class="w-full text-left hover:bg-blue-700 px-3 py-2 rounded-md">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</nav>

<style>
.navbar {
    margin-top: 10px;
}

.navbar a {
    text-decoration: none; 
    position: relative;
    display: inline-block; 
    padding-bottom: 2px; 
}

.navbar a:hover::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px; 
    bottom: 0;
    left: 0;
    background-color: #000; 
    transition: width 0.3s ease, background-color 0.3s ease; 
}

.navbar a::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px; 
    bottom: 0;
    left: 0;
    background-color: #000;
    transition: width 0.3s ease, background-color 0.3s ease;
}
</style>