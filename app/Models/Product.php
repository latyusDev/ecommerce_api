<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =  [
    'name','image','quantity',
    'description','price'
    ];

    
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
