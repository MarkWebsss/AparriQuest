@extends('layouts.Admin.app')

@section('content')
<a href="{{ route('admin.report.export') }}" class="btn btn-success">Export Report</a>
    <h1>Admin Report</h1>
    
    <h3>Businesses</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Business Name</th>
                <th>Email</th>
                <th>Owner Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($businesses as $business)
                <tr>
                    <td>{{ $business->businessName }}</td>
                    <td>{{ $business->businessEmail }}</td>
                    <td>{{ $business->ownerName }}</td>
                    <td>{{ $business->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Products</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
