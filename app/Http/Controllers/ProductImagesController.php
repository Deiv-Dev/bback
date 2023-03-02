<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Validator;

use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    public function createProductImage(Request $request)
    {
        $post = Validator::make($request->all(),[
            'image_url' => 'required|string|max:100',
            'product_id' => 'required|integer|max:100000',
        ]);

        if($post->fails()){
            return response()->json(["error" => "Faild to create image"]);
        }else{
            $createImage = ProductImage::create([
                'image_url' => request('image_url'),
                'product_id' => request('product_id')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Product image created successfully'
            ], 201);
        }
    }

    public function showProductImages($id)
    {
        $productImages = ProductImage::select('*')->where('product_id',$id)->get();
        return response()->json($productImages, 201);
    }

    public function deleteAllProductImages(ProductImage $id)
    {
        $deleteAllImages = ProductImage::selet('*')->where('product_id',$id)->get();
        $deleteAllImages -> delete();
    }

    public function deleteProductImages(ProductImage $id)
    {
       $id -> delete();
    }
}
