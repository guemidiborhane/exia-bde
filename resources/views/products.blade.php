@extends('layouts.app')
 
@section('title', 'Products')
 
@section('content')
 
    <div class="container products">
        <div class="card-deck">
            @foreach ($products as $product)
                <div class="card w-25 mb-4" style="flex-basis: auto">
                    <img src="{{ $product->photo }}" alt="" class="card-img-top mx-auto" style="height: 250px; width: fit-content; max-width: 100%">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">
                            {{ $product->description }}
                        </p> 
                    </div>
                    <div class="card-footer text-center mt-4">
                        {{ $product->price }}$
                        <a href="{{ route('products.addToCart', ['id' => $product->id ]) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> 
                    </div>
                </div>
            @endforeach
        </div><!-- End row -->
 
    </div>
 
@endsection