<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ route('products.update',['product' => $product['id'] ]) }}">
    @csrf
    @method('PATCH')
    <input name="aaa" type="text">
    <button>Send</button>

    </form>
</body>
</html>