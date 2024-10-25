@can('owner-access')
@extends('layouts.Owner.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 text-gray-900">
            <div class="container">
                <div class="row mb-4">
                    @if(!$business)
                    <div class="alert alert-warning">
                        <h4 class="text-center">No Shop Claimed</h4>
                        <p class="text-center">You have not claimed a shop yet. Please claim your shop using the TIN number provided during registration.</p>
                        <form action="{{ route('claim-shop') }}" method="POST" class="d-flex justify-content-center">
                            @csrf
                            <input type="text" name="tinNumber" class="form-control w-50" placeholder="Enter TIN Number" required>
                            <button type="submit" class="btn btn-success ml-2">Claim Shop</button>
                        </form>
                        @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </div>
                    @else
                    <div class="col-sm-8">
                        <h1 class="mb-3">Welcome, {{ Auth::user()->name }}</h1>
                    </div>
                </div>

                <!-- Claimed business details -->

                <div class="row">
                    <!-- Views Line Chart -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card shadow">
                            <div class="card-header text-center"><b>Views</b></div>
                            <div class="card-body">
                                <canvas id="myLineChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Ratings Breakdown -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card shadow">
                            <div class="card-header text-center"><b>Customer Ratings Breakdown</b></div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                    <p class="mt-2">No Rating</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Card -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card bg-success text-white shadow">
                            <div class="card-header text-center">Profile</div>
                            <div class="text-center p-3">
                                <img src="{{ asset('logo/logo1.png') }}" alt="Logo" class="logo rounded-circle mb-3" width="100" height="100">
                                <a href="#" class="d-block text-white mb-2">+ Edit Bio</a>
                                <a href="{{ route('profile.edit') }}" class="btn btn-light text-dark w-100 mb-2">Edit Profile</a>
                                <a href="{{ route('products.index') }}" class="btn btn-light text-dark w-100 mb-2">Add Products</a>
                                <a href="#" class="btn btn-light text-dark w-100 mb-2">View Feedbacks</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-light text-dark w-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Views Graph Script -->
<script>
    var ctx = document.getElementById('myLineChart').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Shop Views/Visits',
                data: [100, 200, 150, 200, 150, 50],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<!-- Floating Button Style and JS -->
<style>
    .float-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        transition: all 0.3s;
    }
</style>

<script>
    const floatButton = document.getElementById('floatButton');
    const profileModal = new bootstrap.Modal(document.getElementById('profileModal'));

    floatButton.addEventListener('click', function () {
        profileModal.show();
    });
</script>

@endsection
@endcan
