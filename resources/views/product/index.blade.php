@extends('layouts.app')

@section('content')

<h1>Products </h1>
<div>
    <a href="{{ route('products.create') }}">Create</a>
    <hr/>
</div>
@foreach ($products as $product)
<div>
    <div>
        <a href="{{ route('products.show', ['product' => $product->id ]) }}">
            <img width="400" src="<?php echo asset('').'Storage/'.$product->filename ?>">
        </a>
    </div>
    <div>
        <a href="{{ route('products.edit', ['product' => $product->id ]) }}">Edit</a>
        <form method="post" action="{{ route('products.destroy', ['product' => $product->id]) }}">
            @csrf
            @method('delete')
            <button type="submit">delete</button>
        </form>
    </div>
    <hr/>
</div>
@endforeach



@endsection

@section('inline_js')
    @parent
@endsection