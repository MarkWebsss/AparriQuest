@extends('layouts.Admin.app')
@section('page-title', 'View Shop Details / ' . $business->businessName)
@section('content')
    <div class="container mt-2">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Business Information</h4>
                <a href="{{ route('business.index') }}" class="btn btn-light ml-auto">Back to Businesses</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th class="bg-light">Business Name:</th>
                            <td>{{ $business->businessName }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Owner's Full Name:</th>
                            <td>{{ $business->fullName }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Business Number:</th>
                            <td>{{ $business->businessNo }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Owner's Full Address:</th>
                            <td>{{ $business->fullAddress }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Owner's Email:</th>
                            <td>{{ $business->ownerEmail }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Owner's Phone:</th>
                            <td>{{ $business->ownerPhone }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Business Email:</th>
                            <td>{{ $business->businessEmail }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Business Phone:</th>
                            <td>{{ $business->businessPhone }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Claimed By:</th>
                            <td>
                                @if ($business->user)
                                    {{ $business->user->name }} ({{ $business->user->email }})
                                @else
                                    <span class="text-danger">Not Claimed</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
