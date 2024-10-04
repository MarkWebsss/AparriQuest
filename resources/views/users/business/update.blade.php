@can('user-access')
@extends('layouts.Users.app')

@section('content')
<style>
.circle {
    width: 150px; /* Adjust width and height as needed */
    height: 150px;
    border-radius: 100%;
    overflow: hidden;
    position: relative;
    border: 2px solid black;
    display: flex;
    align-items: center;
    justify-content: center;
}

.file-input {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}
.circle label {
    position: relative;
    z-index: 1;
    padding: 5px 10px;
    pointer-events: none;
}

</style>
<div class="m-2 alert bg-info">You are viewing your shop</div>
<div class="py-11">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

            @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
                <div class="row">
                    <div class="col-sm-2 text-center border">
                    <form action="{{ isset($shopDetail) ? route('users.myshop.update', $shopDetail->id) : route('users.myshop.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @if(isset($shopDetail))
                                                @method('PATCH')
                                            @endif
                            <div class="circle m-2">
                                <img id="logo-preview" src="{{ isset($shopDetail) && $shopDetail->logo ? asset('storage/' . $shopDetail->logo) : 'path/to/default-image.jpg' }}" alt="Upload Logo">
                                <input type="file" id="logo" name="logo" class="file-input" accept="image/*">
                            </div>
                                <input type="search" class="form-control" name="0" id="" placeholder="search product"><br>
                                Products Category
                            </div>
                    
                    <div class="col-sm-7 m-3">
                                <h1 class="alert bg-success">Welcome to your shop, {{ auth()->user()->name }}</h1>
                                    <div class="container">
                                   
                                            <div class="form-group">
                                            @if (isset($shopDetail))
                                                <p>Shop Name: {{ $shopDetail->name }}</p>
                                            @else
                                                <p>Shop Name not found.</p>
                                            @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description">{{ isset($shopDetail) ? $shopDetail->description : '' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" name="address" value="{{ isset($shopDetail) ? $shopDetail->address : '' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Additional Info</label>
                                                <input type="image" src="" alt="">
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save Changes') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        <div class="col-sm-2">Introductions, views and feedck rating</div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('logo').addEventListener('change', function(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('logo-preview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
});
</script>

@endsection

    @endcan