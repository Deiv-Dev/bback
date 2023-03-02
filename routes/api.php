<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/post-product', 'App\Http\Controllers\ProductsController@createProduct');
    Route::delete('/delete-product/{id}', 'App\Http\Controllers\ProductsController@deleteProduct');
    Route::put('/update-product/{id}', 'App\Http\Controllers\ProductsController@updateProduct');
    Route::post('post-category', 'App\Http\Controllers\ProductCategoriesController@createCategory');
    Route::post('post-image', 'App\Http\Controllers\ProductImagesController@createProductImage');

    Route::delete('delete-image/{id}', 'App\Http\Controllers\ProductImagesController@deleteProductImages');
    Route::delete('delete-all-images/{id}', 'App\Http\Controllers\ProductImagesController@deleteAllProductImages');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');

});

// Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::get('product-images/{id}', 'App\Http\Controllers\ProductImagesController@showProductImages');
Route::get('/all-products-combined', 'App\Http\Controllers\ProductsController@showAllCombinedProductsImages');
Route::get('/all-products', 'App\Http\Controllers\ProductsController@showAllProducts');
Route::get('/product/{id}', 'App\Http\Controllers\ProductsController@showProduct');




