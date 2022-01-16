<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = $this->getCartItems();

        return view('cart.index' , [
            'cartItems' => $cartItems
        ]);
    }

    public function updateCookie(Request $request)
    {
        $cart = $this->getCartFromCookie();
        foreach ($cart as $id => $quantity) {
            $key = "product_$id";
            if($request->has($key)){
                $cart[$id] = $request->input($key);
            }
        }

        $cart = json_encode($cart);
        Cookie::queue(
            Cookie::make('cart', $cart , 60 * 24 * 7, null, null, false, false)
        );

        return redirect()->route('cart.index');

    }

    public function deleteCookie(Request $request)
    {
        if($request->has('id'))
        {
            $productId = $request->input('id');
            $cart = $this->getCartFromCookie();
            if(isset($cart[$productId]))
            {
                unset($cart[$productId]);
                $cartToJson = empty($cart) ? "{}" : json_encode($cart, true);
            }
            Cookie::queue(
                Cookie::make('cart', $cartToJson , 60 * 24 * 7, null, null, false, false)
            );
            return response('success');

        }


        return response('fail');
    }

    private function getCartFromCookie()
    {
        $cart = Cookie::get('cart');
        $cart = (!is_null($cart)) ? json_decode($cart, true) : [];

        return $cart;
    }

    private function getCartItems()
    {
        $cart = $this->getCartFromCookie();
        $productIds = array_keys($cart);

        $cartItems = array_map(function($productId) use ($cart){
            $quantity = $cart[$productId];
            $products = $this->getProduct($productId);
            if($products)
            {
                return [
                    'product'   => $products,
                    'quantity'  => $quantity,
                ];
            }
            else 
            {
                return null;
            }
        },$productIds);

        return $cartItems;
            $products = $this->getProducts();
    }

    private function getProduct($id)
    {
        $products = $this->getProducts();
        foreach ($products as $k => $v) 
        {
            if($id == $v['id']){
                return $v;
            }
        }
        
        return null;
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
