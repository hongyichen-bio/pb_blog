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

    function show($id, Request $request)
    {

        $items = $this->getProducts();

        $item = $items[$id];


        return view('product.show', [
            'item' => $item
        ]);
    }

    private function getProducts()
    {

        $products = 
        [
            [
                'id'  => 0,
                'img' => asset('images/1.jpg')
            ],
            [
                'id'  => 1,
                'img' => asset('images/2.jpg')
            ],
        ];


        return $products;
    }

}
