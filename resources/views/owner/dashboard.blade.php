@can('owner-access')
    @extends('layouts.Owner.app')

        @section('content')
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900">
                    <div class="container">
                    <div class="row">
                        <div class="card mb-2 bg-success">
                            <div class="card-body text-white">Welcome, {{ Auth::user()->name}}</div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="card bg-primary text-white mb-4">
                                dito yung views/visits ng shop mo
                            </div>
                        </div>

                        <div class="col-sm-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                dito naman yung graph ng mga products na nabenta
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card bg-primary text-white mb-4">
                                dito naman siguro yung ratings
                            </div>
                        </div>
                        </div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcan
