@extends('layouts.app')

@section('content')
    <div class="container">
        <img style="display: block;margin-left: auto;margin-right: auto;" src="{{ $product->photo }}" alt="">
        <h1>{{ $product->name }}</h1>
        {{$product->description}}
        <p style="text-align: center; font-weight: bold; color: #000">
            {{$product->price}} €
        </p>
        <form action="{{ route('cart.store') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <button class="btn btn-warning btn-block text-center" role="button">Add to cart</button> 
        </form>
    </div>
@endsection