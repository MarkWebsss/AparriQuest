@can('admin-access')
    @extends('layouts.Admin.app')

        @section('content')

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                           
                            <h5>Users ({{count($allusers)}})</h5>

                            <table class="table table-condensed table-hover">
                                <thead>
                                    <th>Name</th>
                                    <th>Email</th>
                                
                                    <th>Date Created</th>
                                    <th>Option/s</th>
                                </thead>

                                @foreach($allusers as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}
                                    
                                    {{--
                                        this will the role of the user
                                        ({{implode(', ', $user->roles()->get()->pluck('name')->toArray())}})    
                                    --}}
                                        
                                    </td>
                                  
                                    <td>{{date('d/m/Y H:m A', strtotime($user->created_at))}}</td>
                                    <td>
                                        <a href="">View</a>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </table>

                            {{$allusers->links()}}
                        
                        </div>
                    </div>
                </div>
            </div>
        @endsection
@endcan