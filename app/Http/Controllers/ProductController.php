<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {   
    }

    function index()
    {
        $products = $this->getProducts();

        return view('product.index', [
            "products" => $products
        ]);
    }

    public function create()
    {

        return view('product.create');
    }

    public function store(Request $request)
    {
        
        // $path = $request->file('product_image')->store('local');

        $path = $request->file('product_image')->storeAs(
            'products',
            '123444',
            'public'
        );

        $localPath = public_path('storage') . $path; // 刪掉檔案會用到的路徑
        $fullURL = asset(Storage::disk('public')->url($path));
        $url = Storage::url($path); // client端
        // 先軟連結  php .\artisan storage:link

        echo '<pre>'; print_r($localPath); //C:\Users\milk3\Desktop\laravel\pb_controller\public\storageproducts/123444
        echo '<pre>'; print_r($fullURL); //http://localhost:8000/storage/products/123444
        echo '<pre>'; print_r($url); ///storage/products/123444
        die();

        return redirect()->route('products.index');
    }

    function show($id, Request $request)
    {
        // order => 訂單
        // product => 商品
        // prefix => 前綴

        // $id = $request->input('id');


        $products = $this->getProducts();

        $index = $id - 1;
        if ( $index < 0 || $index >= count($products)){
            abort(404);
        }

        $product = $products[$index];

        return view('product.show', [
            "product" => $product
        ]);
    }

    public function edit($id)
    {
        $products = $this->getProducts();

        $index = $id - 1;
        if ( $index < 0 || $index >= count($products)){
            abort(404);
        }

        $product = $products[$index];

        return view('product.edit', [
            "product" => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        //
        // $method = $request->method();
        // echo "update $method";

        $products = $this->getProducts();

        $index = $id - 1;
        if ( $index < 0 || $index >= count($products)){
            abort(404);
        }

        $product = $products[$index];

        return redirect()->route('products.edit', ['product' => $product['id']]);

    }

    public function destroy($id)
    {
        return redirect()->route('products.index');
    }

    private function getProducts()
    {
        return [
            [
                "id" => 1,
                "name" => "Orange",
                "price" => 30,
                "imageUrl" => asset('images/orange01.jpg')
            ],
            [
                "id" => 2,
                "name" => "Apple",
                "price" => 20,
                "imageUrl" => asset('images/apple01.jpg')
            ]
        ];
    }
}
