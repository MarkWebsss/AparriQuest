@extends('layouts.Users.app')

@section('content')


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <h5>Search Results {{count($searchresults)}}</h5>


                <form action="{{route('users.searchproducts')}}" method="post" class="col-4 m-4">
                    @csrf 
                    @method('GET')
                    
                    <div class="form-group">
                        <input type="text" name="keyword" placeholder="search here..." class="form-control" id="" required>
                        <input type="submit" value="Search now!" class="m-2 btn btn-primary">
                    </div>
                </form>

<table class="table table-bordered table-hover">
    <thead>
        <th>Product Id</th>
        <th>Desc</th>
        <th>Price</th>
        <th>Stock</th>
    </thead>
@foreach($searchresults as $prods)
<tr>
    <td>{{$prods->pdesc}}</td>
    <td>{{$prods->price}}</td>
    <td>{{$prods->stocks}}</td>
</tr>
@endforeach
</table>

</div>
</div>
</div>
</div>


@endsection
