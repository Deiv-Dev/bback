<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Validator;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function createProduct(Request $request)
    {
        $post = Validator::make($request->all(),[
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:10000',
            'size' => 'required|string|max:100',
            'price' => 'required|integer|max:10000',
            'quantity' => 'required|integer|max:20',
        ]);

        if($post->fails()){
            return response()->json(["error" => "Faild to create product"]);
        }else{
            $creteProduct = Product::create([
                'title' => request('title'),
                'description' => request('description'),
                'size' => request('size'),
                'price' => request('price'),
                'quantity' => request('quantity')
            ]);
           return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully'
           ], 201); 
        }
    }

        public function showAllCombinedProductsImages()
    {
        $allProducts = Product::join('product_images', 'product_images.product_id', '=', 'products.id')->get()->groupBy('product_id');
        return response()->json($allProducts, 201);
    }

    public function showAllProducts()
    {
        $allProducts = Product::all();
        return response()->json($allProducts, 201);
    }

    public function showProduct(Product $id)
    {
        return response()->json($id, 201);
    }

    public function deleteProduct(Product $id)
    {
       $id -> delete();
    }
    
    public function updateProduct(Request $request, $id)
    {
        $record = Product::find($id);

        if ($request->filled('title')) {
            $record->title = $request->input('title');
        }

        if ($request->filled('description')) {
            $record->description = $request->input('description');
        }
     
        if ($request->filled('size')) {
            $record->size = $request->input('size');
        }
     
        if ($request->filled('price')) {
            $record->price = $request->input('price');
        }
     
        if ($request->filled('quantity')) {
            $record->quantity = $request->input('quantity');
        }
     
        $record->save();
       
    }
}
