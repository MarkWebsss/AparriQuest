@can('user-access')

    @extends('layouts.Users.app')
    @section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                        <h5>My lists of feedbacks</h5>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <th>Rate</th>
                                    <th>Comment/s</th>
                                    <th>Date Submitted</th>    
                                </thead>
                            

                        @foreach($myfeedbacks as $feedback)
                            <tr>
                                <td>{{$feedback->rate}}</td>
                                <td>{{$feedback->comments}}</td>
                                <td>{{$feedback->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                    
                    {{$myfeedbacks->links()}}

                    </div>
                </div>
            </div>
        </div>
    

    @endsection

@endcan