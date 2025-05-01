<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_path',
        'category_id',
        'attributes'
    ];

    protected $casts = [
        'attributes' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/'.$this->image_path);
    }

    public function cartItems()
{
    return $this->hasMany(CartItem::class);
}
}