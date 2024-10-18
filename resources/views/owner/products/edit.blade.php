@extends('layouts.Owner.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="image">Product Image</label>
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" width="100">
                @else
                    <p>No image uploaded.</p>
                @endif
            </div>
            <input type="file" name="image" class="form-control" accept="image/*"> <!-- File input for new image -->
        </div>

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="Available">Available</option>
                <option value="Out of Stock">Out of Stock</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>
@endsection