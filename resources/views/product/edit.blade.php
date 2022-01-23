@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('products.update', ['product' => $product->id ]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div>
        <label>
            Product name: <input type="text" name="product_name" value="{{ $product->title }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product price: <input type="number" min=0 name="product_price" value="{{ $product->price }}"/>
        </label>
    </div>
    <br />
    <div class="image_uploader">
        <label>
            Product image: <input type="file" id="product_image" name="product_image" />
        </label>
        <div style="max-width: 300px;">
            <img style="width: 100%;" id="" src="<?php echo asset('')."Storage/{$product->filename}" ?>" alt="">
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
        imageUploader('image_uploader', '<?php echo asset('')."/Storage/{$product->filename}" ?>');
    </script>
@endsection