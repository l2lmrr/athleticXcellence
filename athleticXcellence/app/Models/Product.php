<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price'];
    
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
