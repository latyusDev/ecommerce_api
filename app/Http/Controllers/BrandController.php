<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       return Brand::all();

    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $brand =  Brand::create([
             'user_id'=>$request->user_id,
             'category_id'=>$request->category_id,
             'name'=>$request->name
        ]);
        return $brand;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand =  Brand::find($id);
        return $brand;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand =  Brand::find($id);
        $newBrand = $brand->update($request->all());
        return $newBrand;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand =  Brand::find($id);
        $brand->delete();
        return ['message'=>'brand deleted'];

    }
}
