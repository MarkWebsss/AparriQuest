@can('user-access')
    @extends('layouts.Users.app')
        @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="row">
                            <div class="col-sm-2">asda
                                <img src="" alt="">
                            </div>
                                <div class="col-sm-6">
                                    <form action="" class="form-control" method="get">
                                        <div class="col-sm">
                                            <label for="">Shop Name</label>
                                            <input type="text" class="form-control"  name="shopName" id="">
                                        </div>
                                        <div class="col-sm">
                                            <label for="">Owner</label>
                                            <input type="text" class="form-control"  name="shopName" id="">
                                        </div>
                                        <div class="col-sm">
                                            <label for="">Description</label>
                                            <input type="text" class="form-control"  name="shopName" id="">
                                        </div>
                                        <div class="col-sm">
                                            <label for="">Additional Informations</label>
                                            <input type="text" class="form-control"  name="shopName" id="">
                                        </div>
                                        <input type="submit" class="btn btn-primary" value="Save Changes">
                                    </form>
                                </div>
                                <div class="col-sm-2">asd</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcan