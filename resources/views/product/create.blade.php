@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>
            Product name: <input type="text" name="product_name" value="{{ old('product_name') }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product price: <input type="number" min=0 name="product_price" value="{{ old('product_price') }}"/>
        </label>
    </div>
    <br />
    <div class="image_uploader">
        <label>
            Product image: <input type="file" id="product_image" name="product_image" />
        </label>
        <div style="max-width: 300px;">
            <img style="width: 100%;" id="" src="https://www.lifewire.com/thmb/P856-0hi4lmA2xinYWyaEpRIckw=/1920x1326/filters:no_upscale():max_bytes(150000):strip_icc()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg" alt="">
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
        imageUploader('image_uploader');
    </script>
@endsection