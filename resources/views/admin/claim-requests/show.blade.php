@extends('layouts.Admin.app')
@section('page-title', 'Claim Requests')
@section('content')
    <h1>Claim Request Details</h1>

    <div class="card">
        <div class="card-header">
            {{ $claimRequest->business->businessName }}
        </div>
        <div class="card-body">
            <p><strong>Requested By:</strong> {{ $claimRequest->user->name }}</p>
            <p><strong>Email:</strong> {{ $claimRequest->user->email }}</p>
            <p><strong>Status:</strong> {{ $claimRequest->status }}</p>

            <p><strong>Proof of Ownership:</strong> <a href="{{ asset('storage/' . $claimRequest->proof_of_ownership) }}" target="_blank">View Proof</a></p>

            <form action="{{ route('admin.claim-requests.approve', $claimRequest) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success">Approve Claim</button>
            </form>

            <form action="{{ route('admin.claim-requests.reject', $claimRequest) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-danger">Reject Claim</button>
            </form>
        </div>
    </div>
@endsection
