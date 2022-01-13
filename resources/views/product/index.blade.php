@extends('layouts.app')


@section('content')
    <h1>Products</h1>


    @foreach($products as $item)
    <a href="{{ route('products.show', ['product' => $item['id'] ])  }}">
        <img width="300" src="{{$item['img']}}" alt="">
    </a>
    @endforeach
@endsection

