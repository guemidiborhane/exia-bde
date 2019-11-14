@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="container mt-4">

    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        <?php $total = 0 ?>
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)

                <?php $total += (Float) $details['price'] * $details['quantity'] ?>
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="{{ asset('storage/products/'.$details['photo']) }}" width="" height="60" alt="" class="img-responsive">
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <form action="{{ route('cart.update') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity p-0" name="quantity" />
                            <button class="btn btn-success btn-sm">
                                <i class="fa fa-pen"></i>
                            </button>
                        </form>
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <form action="{{ route('cart.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
        <tr>
            <td><a href="{{ route('products.index') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>Total ${{ $total }}</strong></td>
            <td></td>
        </tr>
        </tfoot>
    </table>

    <a href="{{ route('cart.submit') }}" class="btn btn-link float-right">Purchase</a>
    </div>

@endsection
