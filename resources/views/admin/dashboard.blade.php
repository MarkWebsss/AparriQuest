@extends('layouts.Admin.app')
@section('page-title', 'Dashboard')
@section('content')
    <!-- Main Content Area -->
    <div class="flex-grow-1" style="background-color: #f8f9fa;">

        <!-- Welcome Card -->
        <div class="card mb-4 bg-success m-3 shadow-sm">
            <div class="card-body text-white text-center">
                <h4>Welcome, {{ Auth::user()->name }}!</h4>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row">
                            <!-- Card 1: Total Users -->
                            <div class="col-sm-4">
                                <div class="card mb-4 shadow-sm card-hover">
                                    <div class="card-header bg-primary text-white text-center">
                                        <h5><i class="fas fa-users"></i> Total Users</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <h2 class="font-weight-bold">{{ $userCount }}</h2>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <a href="{{ route('users.index') }}" class="small text-primary stretched-link">View Details</a>
                                        <div class="small text-muted"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: Total Businesses -->
                            <div class="col-sm-4">
                                <div class="card mb-4 shadow-sm card-hover">
                                    <div class="card-header bg-warning text-white text-center">
                                        <h5><i class="fas fa-store"></i> Total Businesses</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <h2 class="font-weight-bold">{{ $shopCount }}</h2>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <a href="{{ route('business.index') }}" class="small text-primary stretched-link">View Details</a>
                                        <div class="small text-muted"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3: Total Admins -->
                            <div class="col-sm-4">
                                <div class="card mb-4 shadow-sm card-hover">
                                    <div class="card-header bg-danger text-white text-center">
                                        <h5><i class="fas fa-user-shield"></i> Total Admins</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <h2 class="font-weight-bold">{{ $adminCount }}</h2>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <a href="#" class="small text-primary stretched-link">View Details</a>
                                        <div class="small text-muted"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Custom CSS for Hover and Styling -->
<style>
    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .card-footer {
        background-color: #f8f9fa;
    }

    .card-body h2 {
        font-size: 2.5rem;
        color: #333;
    }
</style>
@endsection
