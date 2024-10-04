@can('user-access')
    @extends('layouts.Users.app')

        @section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                        <h5>Send a feedback</h5>

                        <!-- this is a sample flashed message -->
                        @if (session('status'))
                            <div class="alert alert-success col-4">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form action="{{route('users.feedback.store')}}" method="post" class="col-4 was-validated">
                            @csrf
                            @method('POST')

                             <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" readonly value="{{Auth::user()->email}}" id="" placeholder="Enter here.." class="form-control" required>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>

                             </div>




                             <div class="form-group">
                                <label for="">Rating</label>
                                
                                <select name="rate" id="" class="form-control" required>
                                    <option value=""> --select-- </option>
                                        <option value="1">Poor</option>
                                        <option value="3">Good</option>
                                        <option value="5">Outstanding</option>
                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                             </div>



                             <div class="form-group">
                                <label for="">Comments</label>
                                <textarea name="comm" id="" class="form-control" required placeholder="Enter here.."></textarea>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                             </div>

                             <div class="form-group mt-2">
                               
                                <input type="submit" value="Submit" class="btn btn-primary">
                             </div>
                        </form>


                   
                </div>
            </div>
        </div>
    </div>


    @endsection
@endcan
