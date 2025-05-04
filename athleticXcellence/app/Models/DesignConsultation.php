<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignConsultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'organization',
        'email',
        'phone',
        'products_needed',
        'design_details',
        'quantity',
        'deadline',
        'status'
    ];

    protected $casts = [
        'products_needed' => 'array',
        'deadline' => 'date',
        'status' => 'string'
    ];
}