<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/posts', function(){
//     return Post::latest()->get();
// });

// Route::post('/posts', function(Request $request){
//     Post::create([
//         'title'=>$request->title,
//         'content'=>$request->content
//     ]);
//     return response([
//         'msg'=>'post created'
//     ]);
// });

// Route::put('/posts/{id}', function(Request $request, $id){
//    $post =  Post::find($id);
//     return $post->update($request->all()) ;
// });

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);


Route::get('/categoryLatestProducts',
[CategoryController::class,'categoryLatestProducts']);
Route::apiResource('/category',CategoryController::class);
Route::get('products/random',[ProductController::class,'randomProduct']);
Route::apiResource('/products',ProductController::class);
Route::apiResource('/brands',BrandController::class);
Route::get('/home',[CategoryController::class,'home']);

Route::group(['middleware'=>'auth:sanctum'],function(){

    // Route::get('/user',[AuthController::class,'user']);
    
    Route::post('/logout',[AuthController::class,'logout']);
    
    
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});




// Route::apiResource('/products',ProductController::class);
// Route::apiResource('/category',CategoryController::class);
// Route::group(['middleware'=>'auth:sanctum'],function(){

//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     });
//     Route::post('/logout',[AuthController::class,'logout']);

    
// });