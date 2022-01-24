<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $products = $this->getProducts();

        $category_name = $request->input('category_name');

        if(!empty($category_name)){
            $products = Product::where('category_name', $category_name)->get();
        }else{
            $products = Product::all();
        }


        return view('product.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        Storage::disk('public')->delete('03.jpg');
        return view('product.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'product_price' => ['required', 'integer', 'min:0'],
            'product_image' => ['nullable', 'image'],
        ]);


        $path = '';
        if($request->has('product_image'))
        {

            $file = $request->file('product_image');
            $fileName = $file->hashName(); // 亂出生成一個檔名
            $extension = $file->extension(); // 副檔名

            $diskName = "public";
            $disk = Storage::disk($diskName);
    
            $path = $file->storeAs(
                'products',  //儲存路徑
                $fileName,
                $diskName // disk name
            );
        }

        // ======== 方式一
        // $insertData = [
        //     'title'     => $request->input('product_name'),
        //     'price'     => $request->input('product_price'),
        //     'filename'  => $path,
        // ];
        // $result = Product::create($insertData);

        
        // ======== 方式二  (這個方式 不管fillable)
        $product = new Product();
        $product->title      = $request->input('product_name');
        $product->price     = $request->input('product_price');
        $product->filename  = $path;
        $save = $product->save();


        return redirect()->route('products.index');
    }

    public function show($id, Request $request)
    {
        // $product = Product::where('id', $id)->first();
        // $product = Product::find($id); // 裡面放 primary key  若找不到會回NULL
        $product = Product::findOrFail($id); // 裡面放 primary key  若找不到會進404

        if (!$product) {
            abort(404);
        }

        return view('product.show', [
            "product" => $product,
        ]);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        return view('product.edit', [
            "product" => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $validatedData = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'product_price' => ['required', 'integer', 'min:0'],
            'product_image' => ['nullable', 'image'],
        ]);

        // 原檔名
        $path = $product->filename;

        if($request->has('product_image')){

            $file = $request->file('product_image');
            $fileName = $file->hashName(); // 亂出生成一個檔名
    
            
            $diskName = "public";
            $disk = Storage::disk($diskName);
    
            //delete file
            if($disk->exists($product->filename)){
                $disk->delete($product->filename);
            }
    
            //save file
            $path = $file->storeAs(
                'products',  //儲存路徑
                $fileName,
                $diskName // disk name
            );
            
        }


        $updateData = [
            'title'         => $request->input('product_name'),
            'price'         => $request->input('product_price'),
            'filename'      => $path,
            'brand_name'    => $request->input('brand_name'),
            'category_name' => $request->input('category_name')
        ];

        // echo '<pre>'; print_r($product->title); // 舊Name
        $result = $product->update($updateData); // 
        // echo '<pre>'; print_r($product->title);  // 新Name
        // DB::table('products')->where('id', $id)->update($updateData);


        return redirect()->route('products.index', ['product' => $id]);

    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if(!$product)
        {
            return redirect()->route('products.index');
        }


        $diskName = "public";
        $disk = Storage::disk($diskName);
        
        //delete file
        if($disk->exists($product->filename)){
            $disk->delete($product->filename);
        }

        $product->delete();
        
        return redirect()->route('products.index');
    }

    private function getProducts($id = false)
    {
        if($id)
        {
            return DB::table('products')->where('id', $id)->first();
        }

        return DB::table('products')->get();
    }
}
