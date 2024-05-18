<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::with('brands.products')->get();
    }
    
    
    public function home()
    {   
        $data = Category::with('brands.products')->whereIn('name',
        ['televisions','irons','Phones','laptops'])->get();
        return $data;
    }

    public function categoryLatestProducts()
    {   
        $data = Category::with(['products'=>function($query){
                $query->latest()->get();
        }])->take(5)->get();
        return $data;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return response(['category'=>$category],201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
         $category->update($request->all());
         return response(['message'=>'category is updated successfully'],201);
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response(['message'=>'category is deleted successfully'],201);
    }
}
