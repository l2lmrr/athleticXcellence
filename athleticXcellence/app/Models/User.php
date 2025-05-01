<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Make sure this is included
        'banned_at' // Add this if you're using banning functionality
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'banned_at' => 'datetime', // Add this cast
        ];
    }

    // Orders relationship
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // CartItems relationship
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Profile relationship
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Check if user is admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Check if user is banned
    public function isBanned(): bool
    {
        return !is_null($this->banned_at);
    }

    // Role attribute accessor (optional)
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtolower($value),
            set: fn ($value) => strtolower($value)
        );
    }
}