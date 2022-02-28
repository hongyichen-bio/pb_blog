@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('products.update', ['product' => $product->id ]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div>
        <label>
            Product name: <input type="text" name="name" value="{{ old('name') ?? $product->name }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product price: <input type="number" min=0 name="price" value="{{ old('price') ?? $product->price }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product brand name: <input type="text" name="brand_name" value="{{ old('brand_name') ?? $product->brand_name }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product category name: <input type="text" name="category_name" value="{{ old('category_name') ?? $product->category_name }}"/>
        </label>
    </div>
    <br />
    <div class="image_uploader">
        <label>
            Product image: 
                <input 
                    type="file" 
                    name="image" 
                />
        </label><br/>
        <div>
            <img 
                style="max-width: 400px"
                src="{{ asset('storage/'.$product->image_url) }}" 
            />
        </div>
    </div>
    <br />
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
        @if ($errors->products->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->products->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
@endsection

@section('inline_js')
    @parent
    <script>
        imageUploader('image_uploader')
    </script>
@endsection