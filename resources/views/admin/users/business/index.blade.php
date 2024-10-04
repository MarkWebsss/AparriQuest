@extends('layouts.Admin.app')

@section('content')
    <div class="d-flex flex-row" style="min-height: 100vh;">
        <!-- Sidebar -->
        <style>
        .sidebar {
            width: 250px;
            background-color: #343a40;
            height: 100vh; /* Full height */
            padding-top: 20px;
            text-decoration: none;   
            overflow-y: auto; /* Allow scrolling if content overflows */
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

        <!-- Table Display -->
        <div class="main-content py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="p-6 text-gray-900">
                        <div class="container">
                            <div class="row mb-4">
                                <div class="col-sm-2 d-flex justify-content-center align-items-center">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalCreate">Add New +</button>
                                </div>
                                <div class="col-sm-6 d-flex justify-content-center align-items-center">
                                    <form action="{{ route('data.import') }}" method="POST" enctype="multipart/form-data" class="form-inline">
                                        @csrf
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="file" required>
                                            <div class="input-group-append">
                                                <button id="import" class="btn btn-success" type="submit">Import Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4 d-flex justify-content-center align-items-center">
                                    <form action="{{ route('business.search') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="search" class="rounded m-2" placeholder="Enter the Permit Number" name="query" required>
                                        <input type="submit" class="btn btn-success" value="Search">
                                    </form>
                                </div>
                            </div>

                            <table class="table table-condensed table-hover mt-4">
                                <thead>
                                    <tr>
                                        <th>TIN Number</th>
                                        <th>Full Name</th>
                                        <th>Business Name</th>
                                        <th>Full Address</th>
                                        <th>Date of Application</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($businesses as $business)
                                        <tr>
                                            <td>{{ $business->tinNumber }}</td>  
                                            <td>{{ $business->fullName }}</td>  
                                            <td>{{ $business->businessName }}</td>  
                                            <td>{{ $business->fullAddress }}</td>  
                                            <td>{{ $business->dateOfApplication}}</td>
                                            <td>
                                                <form action="{{ route('business.destroy', $business->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                                <a href="{{ route('business.show', $business->id) }}" class="btn btn-primary">View</a> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-4">
                                {{ $businesses->links() }} 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.users.modal.create') 
        </div>
    </div>

    <style>
        #alert {
            position: fixed;
            top: 20px; 
            right: 20px; 
            z-index: 9999; 
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.getElementById('alert');
            if (alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 500);
                }, 2000);
            }
        });
    </script>
@endsection
