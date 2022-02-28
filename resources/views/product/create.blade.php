@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>
            Product name: <input type="text" name="name" value="{{ old('product_name') }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product price: <input type="number" min=0 name="price" value="{{ old('product_price') }}"/>
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
                src="https://via.placeholder.com/400x300" 
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