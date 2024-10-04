@can('user-access')
    @extends('layouts.Users.app')

        @section('content')

        <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                                <div class="">
                                    <h1>Please enter your Registered Permit Number</h1>
                                <form action="{{route('users.search')}}" class="" method="post">
                                    @csrf
                                    <label for="">Permit Number :</label>
                                    <input type="text" class="form-control" id="PermitNum" name="PermitNum" placeholder="Insert your Registered Permit Number :">

                                    <button type="submit" class="btn btn-primary mt-2">Search</button>
                                </form>
                                </div>
                                @if(isset($store))
                                <div class="col-sm">
                                    <div class="container m-2">
                                        <h1>Results for Permit Number: {{ $store->PermitNum }}</h1>
                                        <div>
                                            <strong>Owner Name:</strong> {{ $store->ownerName }}
                                        </div>
                                        <div>
                                            <strong>Shop Name:</strong> {{ $store->shopName }}
                                        </div>
                                        <div>
                                            <strong>Address:</strong> {{ $store->address }}
                                        </div>
                                        <div>
                                            <strong>Description:</strong> {{ $store->descrip }}
                                        </div>
                                        <input type="hidden" name="PermitNum" value="{{ $store->PermitNum }}">

                                        <a href="{{ route('users.requests.create') }}" class="btn btn-success">Verify Now</a>
                                    </div>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
            </div>
         @endsection
@endcan