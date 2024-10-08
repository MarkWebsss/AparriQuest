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
                                <th>TIN Number</th>
                                <th>Full Name</th>
                                <th>Business Name</th>
                                <th>Full Address</th>
                                <th>Date of Application</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                                <tr>
                                <td>{{ $result->tinNumber }}</td>  
                                <td>{{ $result->fullName }}</td>  
                                <td>{{ $result->businessName }}</td>  
                                <td>{{ $result->fullAddress }}</td>  
                                <td>{{ $result->dateOfApplication}}</td>
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
