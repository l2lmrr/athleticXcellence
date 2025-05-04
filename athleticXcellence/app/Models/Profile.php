<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'shipping_address',
        'billing_address',
        'country',
        'city',
        'state',
        'postal_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}