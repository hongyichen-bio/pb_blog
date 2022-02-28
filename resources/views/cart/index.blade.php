@extends('layouts.app')

@section('content')

<h1>Cart</h1>
<form action="{{ route('cart.cookie.update')}}" method="POST">
@csrf
@method('PATCH')
<table border="1">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
            @foreach ($cartItems as $cartItem)
            <tr>
                <td>
                    <p>{{ $cartItem["product"]["name"] }}</p>
                    <div><img src='{{ $cartItem["product"]["imageUrl"] }}' style="width:80px;"></div>
                </td>
                <td>$ {{  $cartItem["product"]["price"] }}</td>
                <td>
                    <input 
                        type="number"
                        name="product_{{$cartItem["product"]["id"]}}" 
                        min="1" 
                        value="{{ $cartItem["quantity"] }}"
                    >
                </td>
                <td>
                    <button 
                        type="button" 
                        class="cartDeleteBtn" 
                        data-id="{{ $cartItem["product"]["id"] }}"
                    >delete</button>
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
<hr/>
<button type="submit">Update</button>
</form>


@endsection

@section('inline_js')
    @parent
    <script>
        initCartDeleteButton("{{ route('cart.cookie.delete') }}")
    </script>
@endsection