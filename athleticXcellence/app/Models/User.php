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
        'role', // Make sure this exists in your users table
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'banned_at' => 'datetime', // This works with your separate migration
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Helper Methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isBanned(): bool
    {
        return !is_null($this->banned_at);
    }

    // Role accessor/mutator
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtolower($value),
            set: fn ($value) => strtolower($value)
        );
    }

    public function cartTotal()
{
    return $this->cartItems()->with('product')->get()
        ->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
}
}