<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
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
