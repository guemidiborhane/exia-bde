@extends('layouts.app')

@section('title', 'Products')

@section('content')

    <form method="get" class="float-right col-md-3 form-inline">
        <input type="text" name="q" class="form-control" value="{{ $query }}">
        <button class="btn btn-link">Search</button>
    </form>
    <div class="container products">
        <a href="{{route('products.create')}}" class="btn btn-link d-block mx-auto">Ajouter</a>
        <div class="card-deck">
            @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 product-card" style="flex-basis: auto">
                    <img src="{{ asset('storage/products/'.$product->photo) }}" alt="" class="card-img-top mx-auto" style="height: 250px; width: fit-content; max-width: 100%">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ route('products.show', compact('product')) }}">
                                {{ $product->name }}
                            </a>
                        </h4>
                        <p class="card-text">
                            {{ $product->description }}
                        </p>
                    </div>
                    <div class="card-footer text-center mt-4">
                        {{ $product->price }}$
                        @auth
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button class="btn btn-warning btn-block text-center" role="button">Add to cart</button>
                        </form>
                        @endauth
                        @auth
                            @if(Auth::user()->hasRole('bde'))
                        <div class="btn-group">
                            <form action="{{ route('products.destroy', $product->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>

                            <a href="{{ route('products.edit', compact('product')) }}" class="btn btn-link">Edit</a>
                        </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div><!-- End row -->

    </div>

@endsection
