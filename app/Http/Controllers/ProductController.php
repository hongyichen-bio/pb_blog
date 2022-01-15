<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        $items = $this->getProducts();

        return view('product.index' ,[
            "products" => $items
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

    public function edit($id)
    {
        $products = $this->getProducts();
        $product = $products[$id];
        return view('product.edit' , [
            'product' => $product,
        ]);
    }

    
    public function update(Request $request, $id)
    {
        
        $products = $this->getProducts();

        $product = $products[$id];

        echo '<pre>'; print_r($product); 
        return redirect()->route('products.edit', ['product' => $product['id']]);

    }

    function show($id, Request $request)
    {

        $items = $this->getProducts();

        $item = $items[$id];


        return view('product.show', [
            'item' => $item
        ]);
    }
    public function destroy($id)
    {
        //
        echo 'destroy';

        return redirect()->route('products.index');
    }

    private function getProducts()
    {

        $products = 
        [
            [
                'id'  => 0,
                'img' => asset('images/1.jpg'),
                'price' => 40,
                'name' => '第一個商品'
            ],
            [
                'id'  => 1,
                'img' => asset('images/2.jpg'),
                'price' => 555,
                'name' => '第二個商品'
            ],
        ];


        return $products;
    }

}
