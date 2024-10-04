@can('admin-access')
@extends('layouts.Admin.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="card mb-2 p-2 bg-primary text-white text-center">Manage Requests</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table for pending requests -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <h3 class="card mb-2 p-3 bg-info text-white">Pending Requests</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Permit Number</th>
                            <th>Shop Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Files</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $req)
                            <tr>
                                <td>{{ $req->businesses?->PermitNum }}</td>
                                <td>{{ $req->businesses?->shopName }}</td>
                                <td>{{ $req->description }}</td>
                                <td>{{ $req->status }}</td>
                                <td><a href="" class="" >View</a></td>
                                <td>
                                    <form action="{{ route('admin.manage-requests.update', $req->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <label for="status-{{ $req->id }}" class="hidden form-label">Status</label>
                                        <select id="status-{{ $req->id }}" name="status" class="form-select mb-2" required>
                                            <option value="confirmed" {{ $req->status === 'Confirmed' ? 'selected' : '' }}>Confirm</option>
                                            <option value="declined" {{ $req->status === 'Declined' ? 'selected' : '' }}>Decline</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <!-- Table for confirmed requests -->
            <div class="col-sm-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="card mb-2 p-3 bg-success text-white">Confirmed Requests</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Permit Number</th>
                                    <th>Shop Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Files</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($confirmedRequests as $req)
                                    @if($req->status === 'confirmed')
                                        <tr>
                                            <td>{{ $req->businesses?->PermitNum }}</td>
                                            <td>{{ $req->businesses?->shopName }}</td>
                                            <td>{{ $req->description }}</td>
                                            <td>{{ $req->status }}</td>
                                            <td><a href="" class="btn btn-info" >View</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{ $confirmedRequests->links() }}
                    </div>
                </div>
            </div>

            <!-- Table for declined requests -->
            <div class="col-sm-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="card mb-2 p-3 bg-danger text-white">Declined Requests</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Permit Number</th>
                                    <th>Shop Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Files</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($declinedRequests as $req)
                                    @if($req->status === 'declined')
                                        <tr>
                                            <td>{{ $req->businesses?->PermitNum }}</td>
                                            <td>{{ $req->businesses?->shopName }}</td>
                                            <td>{{ $req->description }}</td>
                                            <td>{{ $req->status }}</td>
                                            <td><a href="" class="btn btn-primary" >View</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        {{ $declinedRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endcan
