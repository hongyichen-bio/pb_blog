<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="">
            Product name: <input type="text" name="product_name" value="">
        </label>
    </div>
    <div>
        <label for="">
            Product price: <input type="number" name="product_price" value="">
        </label>
    </div>
    <div>
        <label for="">
            Product ing: <input type="file" name="product_image" value="">
        </label>
    </div>
    <button type="submit">Submit</button>
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif