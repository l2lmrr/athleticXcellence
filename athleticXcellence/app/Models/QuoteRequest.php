<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'organization',
        'email',
        'phone',
        'apparel_types',
        'quantity',
        'deadline',
        'design_files_path',
        'additional_notes',
        'status'
    ];

    protected $casts = [
        'apparel_types' => 'array',
        'deadline' => 'date',
        'status' => 'string'
    ];
}