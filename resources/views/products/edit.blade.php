@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a product</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="name"> Name:</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}" />
            </div>

            <div class="form-group">
                <label for="description">description:</label>
                <input type="text" class="form-control" name="description" value="{{ $product->description }}" />
            </div>

            <div class="form-group">
                <label for="photo">photo:</label>
                <input type="file" class="form-control" name="photo" value="{{ $product->photo }}" />
            </div>
            <div class="form-group">
                <label for="price">price:</label>
                <input type="text" class="form-control" name="price" value="{{ $product->price }}" />
            </div>
            <div class="form-group">
                <label for="category">category:</label>
                <input type="text" class="form-control" name="category" value="{{ $product->category }}" />
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection