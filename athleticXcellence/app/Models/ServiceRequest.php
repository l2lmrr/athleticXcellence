<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'project_type',
        'project_details',
        'budget',
        'status'
    ];

    protected $casts = [
        'project_type' => 'string',
        'budget' => 'string',
        'status' => 'string'
    ];
}