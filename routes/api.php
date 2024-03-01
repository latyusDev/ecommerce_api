<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
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



Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::get('/categoryLatestProducts',
[CategoryController::class,'categoryLatestProducts']);
Route::get('/home',[CategoryController::class,'home']);
Route::apiResource('/category',CategoryController::class);

Route::get('products/random',[ProductController::class,'getRandomProduct']);
Route::post('/checkout',[ProductController::class,'checkout']);
Route::apiResource('/products',ProductController::class);

Route::apiResource('/brands',BrandController::class);

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::post('/logout',[AuthController::class,'logout']);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


