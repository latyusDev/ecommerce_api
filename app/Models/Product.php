<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =  [
    'name','image','quantity','brand_id',
    'description','price','category_id','user_id'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // public function product()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function brand()
    {
        return $this->belongsTo(Product::class);
    }

    public function wishList()
    {
        return $this->hasMany(Product::class);
    }
}
