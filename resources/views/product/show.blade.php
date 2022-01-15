@extends('layouts.app')


@section('content')
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

    <h1>Product</h1>
    <img width="300" src="{{$item['img']}}" alt="aa213213a">
    <p id="name">{{ $item['name'] }}</p>
    <p>Price: <div>{{ $item['price'] }}</div></p>
    <div>
        <input id="num" type="number" min="1" value="1">
        <button id="add" type="button">Add to card</button>
    </div>

<script>
    let addToCartBtn = document.getElementById('add');

    addToCartBtn.addEventListener('click',function(){
    let name = document.querySelector('#name').value;
    let num = document.querySelector('#num').value;
        Cookies.set('name',name);
        Cookies.set('num',num);


    })
    


</script>
@endsection


