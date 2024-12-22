<div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Add New Product') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-4">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input type="file" id="imageInput" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" required placeholder="Enter product name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter product description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category">Select Category:</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Clothing">Clothing</option>
                                    <option value="Home Appliances">Home Appliances</option>
                                    <option value="Furniture">Furniture</option>
                                    <option value="Books">Books</option>
                                    <option value="Beauty and Personal Care">Beauty and Personal Care</option>
                                    <option value="Sports and Outdoors">Sports & Outdoors</option>
                                    <option value="Toys and Games">Toys & Games</option>
                                    <option value="Food and Beverages">Food & Beverages</option>
                                    <option value="Automotive">Automotive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control" step="0.01" required placeholder="Enter price">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Available">Available</option>
                                    <option value="Out of stock">Out of Stock</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Add Product</button>
                        </div>

                        <div class="col-md-6 d-flex justify-content-center align-items-start mt-2">
                            <div class="card" id="imagePreviewCard" style="width: 100%; max-width: 300px;">
                                <img id="imagePreview" src="" alt="Image Preview" class="card-img-top" style="height: 100%; width: 100%; object-fit: contain;">
                                <div class="card-body">
                                    <h5 class="card-title">Image Preview</h5>
                                    <p class="card-text">This is how your product image will look.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            imagePreview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

<style>
    /* Custom styles for modal */
    .modal-header {
        background-color: #007bff;
        color: white;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    /* Image preview styles */
    #imagePreviewCard {
        overflow: hidden; /* Prevent overflow */
        border: 1px solid #dee2e6; /* Optional: Add a border to the card */
        border-radius: 0.25rem; /* Optional: Add rounded corners */
    }

    #imagePreview {
        max-width: 100%; /* Ensure it doesn't exceed the container */
        max-height: 200px; /* Set a max height for the image */
        object-fit: contain; /* Maintain aspect ratio */
        display: block; 
        margin: 0 auto; 
    }

</style>
