<!-- resources/views/owner/claim-request.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Claim Your Shop</h2>

    <form action="{{ route('owner.submit.claim') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="businessName">Business Name</label>
            <input type="text" name="businessName" id="businessName" class="form-control @error('businessName') is-invalid @enderror" value="{{ old('businessName') }}" required>
            @error('businessName')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="proof_of_ownership">Proof of Ownership (e.g., document, contract)</label>
            <input type="file" name="proof_of_ownership" id="proof_of_ownership" class="form-control @error('proof_of_ownership') is-invalid @enderror" accept=".jpg,.jpeg,.png,.pdf" required>
            @error('proof_of_ownership')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Claim Request</button>
    </form>
</div>
@endsection
