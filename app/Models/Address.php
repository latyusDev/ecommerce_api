<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
    'state',
    'street',
    'local_government',
    'user_id','zip_code',
    'phone_number'
    ];

    public function address()
    {
        return $this->belongsTo(User::class);
    }
}
