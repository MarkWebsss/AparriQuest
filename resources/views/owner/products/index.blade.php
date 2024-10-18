@extends('layouts.Owner.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="mb-4">
        <h2 class="">Add New Product</h2>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" id="imageInput" name="image" class="form-control" accept="image/*" onchange="previewImage(event)"> <!-- File input -->
                    </div>
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="available">Available</option>
                            <option value="out of stock">Out of Stock</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add Product</button>
                </div>

                <div class="col-md-6 d-flex justify-content-center align-items-start">
                    <div class="card" id="imagePreviewCard" style="display: none;">
                        <img id="imagePreview" src="" alt="Image Preview" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Image Preview</h5>
                            <p class="card-text">This is how your product image will look.</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <h1>Your Products</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Price: </strong>{{ $product->price }}</p>
                        <p class="card-text">{{ $product->status }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewCard = document.getElementById('imagePreviewCard');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreviewCard.style.display = 'block'; // Show the card
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '';
            imagePreviewCard.style.display = 'none'; // Hide the card if no file is selected
        }
    }
</script>
@endsection
