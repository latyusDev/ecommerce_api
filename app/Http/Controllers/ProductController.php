<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::with('products')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $categoryDetail = $request->safe()->only('category');
        $categoryDetail['user_id'] =  $request->user()->id ;
        $productDetail = $request->safe()->except('category');
        $productDetail['image'] = asset('/storage/'.$request->file('image')
                                    ->store('images','public'));
        $category = Category::firstOrNew($categoryDetail);

        if($category->id){
            $product = $category->products()->create($productDetail);
        }else{
            $category->save();
            $product = $category->products()->create($productDetail);
        }
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {

        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         $product->delete();
         return ['message'=>'product deleted'];
    }
}