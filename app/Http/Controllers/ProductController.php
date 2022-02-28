<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
     

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $c_id = $request->input('c_id');
        if (!empty($c_id)){
            $category = Category::find($c_id);
            $products = $category->products;
        } else {
            $products = Product::all();
        }

        return view('product.index', [
            "products" => $products,
        ]);
    }

    public function show($id, Request $request)
    {
        $product = Product::findOrFail($id);

        return view('product.show', [
            "product" => $product,
        ]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image']
        ]);
        unset($validatedData["image"]);

        if ($request->has('image')){
            $diskName = "public";
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs(
                'products', 
                $name,
                $diskName
            );
            $validatedData["image_url"] = $path;
        }

        // $product = new Product();
        // $product->name = $validatedData['name'];
        // $product->price = $validatedData['price'];
        // $product->image_url = $validatedData['image_url'];
        // $result = $product->save();
        $product = Product::create($validatedData);

        return redirect()->route('products.index');
    }

    

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('product.edit', [
            "product" => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'brand_name' => ['required', 'string'],
            'category_name' => ['required', 'string'],
            'image' => ['nullable', 'image']
        ]);
        unset($validatedData["image"]);


        if ($request->has('image')){
            $diskName = "public";
            $disk = Storage::disk($diskName);
            // delete file
            if ($disk->exists($product->image_url)){
                $disk->delete($product->image_url);
            }
    
            // save file
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs(
                'products', 
                $name,
                $diskName
            );
    
            // save path
            $validatedData["image_url"] = $path;
        }

        $result = $product->update($validatedData);

        return redirect()->route('products.edit', ['product' => $product->id]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (is_null($product)){
            return redirect()->route('products.index');
        }

        $diskName = "public";
        $disk = Storage::disk($diskName);
        if ($disk->exists($product->image_url)){
            $disk->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
