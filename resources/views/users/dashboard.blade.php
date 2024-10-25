@can('user-access')
    @extends('layouts.Users.app')

    @section('content')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.css') }}">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <style>
        #welcome {
            background-image: linear-gradient(
                to top, 
                rgba(0, 0, 0, 1) 0%, 
                rgba(0, 0, 0, 0) 50%
            ), 
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
            margin: 0;
            padding: 0;
        }

        .custom-container {
            height: 100vh;
        }

        #search-button {
            background: none;
            border: none;
            padding: 0 15px;
        }

        .search-input {
            border-radius: 0 5px 5px 0;
        }
        section {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        #map {
            height: 400px;
            width: 100%;
        }
        
    </style>

    <div class="container-fluid">
        <section id="welcome" style="height: 100vh;">
            <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center">
                <img src="{{ asset('logo/textlogo.png') }}" alt="Text Logo" class="pb-3 img-fluid">
                <h5 class="pb-3 outlined-text fw-bold">Find your shop anytime, anywhere!</h5>
                <p class="outlined-text fw-bold">Don’t know the locations of different shops in Aparri? Just search for the product that you need!</p>

                <form action="{{ route('search') }}" method="get" class="d-flex w-50">
                    <div class="input-group">
                        <button type="submit" id="searchbtn" class="border rounded-start justify-content-center"><box-icon name='search-alt' class="rounded-bottom"></box-icon></button>
                        <input type="search" name="query" class="form-control w-70 border-radius-5" id="searchInput" placeholder="Search Products" aria-label="Search Products">
                    </div>
                </form>
            </div>
        </section>
    </div>
    @endsection
@endcan
