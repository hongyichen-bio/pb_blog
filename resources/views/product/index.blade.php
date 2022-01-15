@extends('layouts.app')


@section('content')
    <h1>Products</h1>
    <div><a href="{{ route('products.create') }}">Create</a></div>


    @foreach($products as $item)
    <div>
        <a href="{{ route('products.show', ['product' => $item['id'] ])  }}">
            <img width="300" src="{{$item['img']}}" alt="">
        </a>
        <a href="{{ route('products.edit',['product' => $item['id'] ]) }}">Edit</a>
     
        <form method="post" action="{{ route('products.destroy', ['product' => $item['id'] ])  }}">
            @csrf
            @method('delete')
            <button type="submit">delete</button>

        </form>   <hr>
    </div>
    @endforeach
@endsection

