@can('admin-access')
    @extends('layouts.Admin.app')

        @section('content')

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                           
                            <h5>User Feedbacks ({{count($allfeedbacks)}})</h5>

                            <table class="table table-condensed table-hover">
                                <thead>
                                    <th>Email</th>
                                    <th>Rate</th>
                                    <th>Comments</th>
                                    <th>Date Submitted</th>
                                </thead>

                                @foreach($allfeedbacks as $feedback)
                                <tr>
                                    <td>{{$feedback->email}}</td>
                                    <td>{{$feedback->rate}}</td>
                                    <td>{{$feedback->comments}}</td>
                                    <td>{{$feedback->created_at}}</td>
                                </tr>
                                @endforeach
                               
                            </table>

                            {{$allfeedbacks->links()}}
                        
                        </div>
                    </div>
                </div>
            </div>
        @endsection
@endcan