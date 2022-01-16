@extends('layouts.app')

@section('content')

<h1>Cart</h1>
<div>

<form action="{{ route('cart.cookie.update') }}" method="POST">
    @csrf
    @method('PATCH')
    <table border="1">
        <thead>
            <tr>
                <th>product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($cartItems as $cartItems)
            <tr>
                <td>
                    <div>{{$cartItems['product']['name']}}</div>
                    <img width="200" src="{{$cartItems['product']['imageUrl']}}" alt="">
                </td>
                <td>${{$cartItems['product']['price']}}</td>
                <td><input name="product_{{$cartItems['product']['id']}}" type="number" min="1" value="{{$cartItems['quantity']}}"></td>
                <td><button type="button" class="cartDeleteBtn" data-id="{{ $cartItems['product']['id']}}">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <hr>
        <button type="submit">Update</button>
    </div>
</form>
    </div>



@endsection

@section('inline_js')
    @parent

    <script>
        initCartDeleteButton('{{ route("cart.cookie.delete") }}');
    </script>


@endsection