<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
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
        ['accessory','phone','laptop'])->get();
        return $data;
    }

    public function categoryLatestProducts()
    {   
        $data = Category::with(['products'=>function($query){
                $query->latest()->get();
        }])->take(5)->get();
                // dd($data);
        return $data;
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(StorecategoryRequest $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecategoryRequest $request)
    {
        $category = category::create([
             'name'=>$request->category,
             'user_id'=>$request->user_id
         ]);
    
         return response(['category'=>$category],201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategoryRequest $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        //
    }
}
