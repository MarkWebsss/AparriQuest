@extends('layouts.Admin.app')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <style>
        .sidebar {
            width: 250px;
            background-color: #343a40;
            height: 100vh;
            padding-top: 20px;
            text-decoration: none;   
        }

        .sidebar a {
            color: white; /* Text color */
            text-decoration: none; /* Remove underline */
            display: block; /* Make links take the full width */
            padding: 15px; /* Add padding for better click area */
            transition: background-color 0.3s; /* Smooth transition */
        }

        .sidebar a:hover {
            background-color: #495057; /* Change background on hover */
        }
    </style>

    <div class="sidebar">
        <h3 class="text-white text-center">Dashboard</h3>
        <a href="{{ route('business.index') }}">Add Data</a>
        <a href="#">Users</a>
    </div>

    <!-- Main Content Area -->
    <div class="flex-grow-1 py-4" style="background-color: #f8f9fa;">

    <div class="card mb-2 bg-success m-3">
            <div class="card-body text-white">Welcome, {{ Auth::user()->name }}</div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-sm-4">
                                <div class="card mb-4">
                                    <div class="card-header">{{ _('Total Users') }}</div>
                                    <div class="card-body">
                                        <h2>{{ $userCount }}</h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a href="#" class="small text-primary stretched-link">View Details</a>
                                        <div class="small text-muted"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 2 -->
                            <div class="col-sm-4">
                                <div class="card mb-4">
                                    <div class="card-header">{{ _('Total Businesses') }}</div>
                                    <div class="card-body">
                                        <h2>{{ $shopCount }}</h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a href="#" class="small text-primary stretched-link">View Details</a>
                                        <div class="small text-muted"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 3 -->
                            <div class="col-sm-4">
                                <div class="card mb-4">
                                    <div class="card-header">{{ _('Total Admins') }}</div>
                                    <div class="card-body">
                                        <h2>{{ $adminCount }}</h2>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
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
</div>
@endsection
