<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
        'description',
        'date',
        'time',
        'location',
        'location_url',
        'map_iframe',
        'category',
        'image_url',
        'gallery',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
        'gallery' => 'array',
    ];
}
