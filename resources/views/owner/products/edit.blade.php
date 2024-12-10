@extends('layouts.Owner.app')
@section('page-title', 'Edit Product / ' . $product->name)
@section('content')
<div class="container">

    <div class="card shadow-lg mt-5">
        <div class="card-header bg-primary text-white">
            <h4 class="mt-2">Edit Product: {{ $product->name }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row justify-content-center">
                    <!-- Left Column: Image -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="image">Product Image</label>
                            <div>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="img-fluid mb-2">
                                @else
                                    <p>No image uploaded.</p>
                                @endif
                            </div>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <!-- Right Column: Form -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Available" {{ $product->status == 'Available' ? 'selected' : '' }}>Available</option>
                                <option value="Out of Stock" {{ $product->status == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-success mt-2">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
