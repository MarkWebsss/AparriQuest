<!-- Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document"> <!-- Centered modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}" style="">
                    <div class="">
                        <h5 class="">{{ $product->name }}</h5>
                        <p class="">Price: ₱{{ $product->price }}</p>
                        @if ($product->status === 'Available')
                            <p class="card-text" style="color: green;">Status: {{ ucfirst($product->status) }}</p>
                        @else
                            <p class="card-text" style="color: red;">Status: {{ ucfirst($product->status) }}</p>
                        @endif
                        <p class="card-text">Description: {{ $product->description}}</p>
                        <p class="card-text">Shop: {{ $product->user->name }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
