@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a product</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div>

          <div class="form-group">
              <label for="description">Description:</label>
              <input type="text" class="form-control" name="description"/>
          </div>

          <div class="form-group">
              <label for="photo">Photo:</label>
              <input type="file" class="form-control" name="photo"/>
          </div>
          <div class="form-group">
              <label for="price">Price:</label>
              <input type="float" class="form-control" name="price"/>
          </div>

          <div class="form-group">
              <label for="category">category:</label>
              <select name="category" id="category" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                @endforeach
              </select>
          </div>
          <button type="submit" class="btn btn-primary-outline">Add product</button>
      </form>
  </div>
</div>
</div>
@endsection
