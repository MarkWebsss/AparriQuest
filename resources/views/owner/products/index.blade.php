@extends('layouts.Owner.app')
@section('page-title', 'Products')
@section('content')

<!-- Alerts Container -->
<div id="alertContainer" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
    @if ($errors->any())
        <div class="alert alert-danger" id="alertBox">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success" id="alertBox">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" id="alertBox">
            {{ session('error') }}
        </div>
    @endif
</div>

@if (!Auth::user()->business)
    <div class="alert alert-warning alert-dismissible fade show m-5" role="alert" style="border-radius: 8px; position: relative; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <strong>Warning!</strong> You must claim a shop before adding products.
        <a href="{{ route('owner.dashboard') }}" class="btn btn-link font-weight-bold" style="text-decoration: underline; padding-left: 0;">Go Claim Shop</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute; right: 10px; top: 10px;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@else
<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCreate">
        Add New Product
    </button>

    <!-- Product Filter Section -->
    <div class="card m-3">
        <h1 class="text-center card-header">Your Products</h1>

            <!-- Filter Form -->
            <div class="d-flex justify-content-end align-items-center mt-3">
                <form action="{{ route('products.index') }}" method="GET" class="d-flex align-items-center">
                    <div class="form-group mb-0 mr-2" style="min-width: 150px;">
                        <select name="status" class="form-control form-control-sm">
                            <option value="">All Products</option>
                            <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Out of Stock" {{ request('status') == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>

                    <!-- Add Toggle for Archived Products -->
                    <div class="form-group mb-0 mr-2">
                        <label for="showArchived" class="mr-2">Show Archived</label>
                        <input type="checkbox" name="show_archived" id="showArchived" value="1" {{ request('show_archived') == '1' ? 'checked' : '' }} 
                            onchange="this.form.submit()">
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                </form>
            </div>

        @if($products->isEmpty())
            <div class="col-12 text-center">
                <p class="text-muted mt-4">No products added yet.</p>
            </div>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-12 col-md-4 mb-2">
                        <div class="card product-card h-100 shadow-sm {{ $product->status == 'Available' ? 'border-success' : ($product->status == 'Out of Stock' ? 'border-danger' : '') }}">
                            <div class="card-body d-flex flex-row align-items-center">
                            <img src="{{ $product->image && file_exists(public_path('storage/' . $product->image)) ? asset('storage/' . $product->image) : asset('logo/NOIMAGE.png') }}"
                                style="
                                width: 50%;
                                "
                                class="img-fluid"
                                alt="{{ $product->name }}">
                                <div class="ml-3">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text text-primary"><strong>Price: ₱</strong>{{ $product->price }}</p>
                                    <p class="card-text text-muted">{{ $product->status }}</p>
                                    @if($product->archived_at)
                                        <span class="badge badge-secondary">Archived</span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                @if(request('show_archived') == '1' && $product->archived_at)
                                    <form action="{{ route('products.unarchive', $product->id) }}" method="POST" class="m-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-undo "></i> Unarchive
                                        </button>
                                    </form>
                                @endif

                                <form class="mt-3" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    @include('owner.modal.add')
</div>
@endif
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    const defaultImage = "{{ asset('logo/NOIMAGE.png') }}";

    document.getElementById('imagePreview').src = defaultImage;

    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewCard = document.getElementById('imagePreviewCard');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewCard.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = defaultImage;
            imagePreviewCard.style.display = 'block';
        }
    }

    function fadeOutAlerts() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('fade-out');
                setTimeout(() => {
                    alert.remove(); 
                }, 500); 
            }, 3000);
        });
    }

    document.addEventListener('DOMContentLoaded', fadeOutAlerts);
</script>
@endsection

<style>
    .border-success {
        border: 2px solid green; /* Green border for available products */
    }

    .border-danger {
        border: 2px solid red; /* Red border for out of stock products */
    }

    .alert1 {
        opacity: 1; 
        transition: opacity 0.5s ease-in-out; 
        margin-bottom: 10px;
        width: 300px; 
    }

    .fade-out {
        opacity: 0;
    }

    .product-card {
        border-radius: 10px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: auto; 
        overflow: hidden; 
        margin-bottom: 20px; /* Ensures spacing between product cards */
    }

    .product-card:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        width: 100px; 
        height: 100px; 
        object-fit: contain;
        margin-right: 10px; 
    }

    .card-title {
        font-weight: bold;
        font-size: 1rem; 
        margin-bottom: 3px; 
    }

    .card-text {
        font-size: 0.85rem; 
        margin-bottom: 3px;
    }

    .btn-outline-primary, .btn-outline-danger {
        transition: background-color 0.2s, color 0.2s, transform 0.2s;
        padding: 5px 12px; 
        border-radius: 5px; 
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
        transform: translateY(-1px); 
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
        transform: translateY(-1px);
    }

    /* Adjustments for card layout */
    .card {
        margin: 0; /* Remove default margins */
        padding: 15px; /* Add padding to cards */
    }

    /* Styles for mobile view */
    @media (max-width: 576px) {
        .product-image {
            width: 70px; /* Adjust image size for mobile */
            height: 70px;
        }

        .product-card {
            width: 100%;
        }

        .container {
            padding: 10px; /* Add padding to container for mobile */
        }

        .alert {
            width: 100%; /* Full width for alerts on mobile */
            margin-bottom: 15px; /* Add margin for alerts */
        }
    }

    /* Styles for larger screens */
    @media (min-width: 577px) {
        .container {
            padding: 20px; /* Add padding to container for desktop */
        }

        .card {
            margin-bottom: 20px; /* Add margin between cards */
        }

        .alert {
            width: auto; /* Reset width for alerts on larger screens */
            margin-bottom: 20px; /* Add margin for alerts */
        }
    }
</style>

