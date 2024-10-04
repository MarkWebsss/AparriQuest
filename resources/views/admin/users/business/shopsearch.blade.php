@extends('layouts.Admin.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <a href="{{ route('business.index') }}" class="btn btn-success mb-2">Back</a>
                @if (!empty($results))
                    <h2>Search Results:</h2>
                    <table class="table table-condensed table-hover mt-4">
                        <thead>
                            <tr>
                                <th>Permit ID</th>
                                <th>Owner</th>
                                <th>Shop Name</th>
                                <th>Address</th>
                                <th>Permit Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $result->PermitNum }}</td>
                                    <td>{{ $result->ownerName }}</td>
                                    <td>{{ $result->shopName }}</td>
                                    <td>{{ $result->address }}</td>
                                    <td>{{ $result->date }}</td>
                                    <td>
                                        <form action="{{ route('business.destroy', $result->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            <a href="" class="btn btn-primary">View</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No results found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
