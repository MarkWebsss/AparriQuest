@extends('layouts.Admin.app')
@section('page-title', 'Claim Requests')
@section('content')

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Claim Requests</h3>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Business Name</th>
                        <th>Requested By</th>
                        <th>Proof of Ownership</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                   
                <tbody>@if($claimRequests->isEmpty())
                    <p class="text-center">No Requests.</p>
                @else
                    @foreach ($claimRequests as $claimRequest)
                        <tr>
                            <td>{{ $claimRequest->business->businessName }}</td>
                            <td>{{ $claimRequest->user->name }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $claimRequest->proof_of_ownership) }}" target="_blank" class="btn btn-outline-primary btn-sm">View Proof</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.claim-requests.show', $claimRequest) }}" class="btn btn-info btn-sm">View</a>
                                <form action="{{ route('admin.claim-requests.approve', $claimRequest) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form action="{{ route('admin.claim-requests.reject', $claimRequest) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
