<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = $this->getProducts();

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

        
        $insertData = [
            'title'     => $request->input('product_name'),
            'price'     => $request->input('product_price'),
            'filename'  => $path,
        ];
                
        DB::table('products')->insert($insertData);
        
        // $localPath = public_path("storage/product_images/$path");
        // $url = Storage::disk($diskName)->url($path);
        // $fullURL = asset($url);
        // $storage_path = Storage::disk($diskName)->path($path);
        // storage_path("app/public/$path");

        return redirect()->route('products.index');
    }

    public function show($id, Request $request)
    {
        $product = $this->getProducts($id);

        if (!$product) {
            abort(404);
        }

        return view('product.show', [
            "product" => $product,
        ]);
    }

    public function edit($id)
    {
        $product = $this->getProducts($id);

        if (!$product) {
            abort(404);
        }

        return view('product.edit', [
            "product" => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        
        $product = $this->getProducts($id);

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
            'title'     => $request->input('product_name'),
            'price'     => $request->input('product_price'),
            'filename'  => $path,
        ];

        DB::table('products')->where('id', $id)->update($updateData);


        return redirect()->route('products.index', ['product' => $id]);

    }

    public function destroy($id)
    {
        $product = $this->getProducts($id);
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

        DB::table('products')->where('id',$id)->delete();
        
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
