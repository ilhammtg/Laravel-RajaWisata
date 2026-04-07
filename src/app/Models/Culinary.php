<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culinary extends Model
{
    protected $fillable = [
        'name',
        'description',
        'details',
        'location',
        'location_url',
        'address',
        'phone',
        'opening_hours',
        'map_iframe',
        'category',
        'rating',
        'price_range',
        'image_url',
        'gallery',
        'is_active',
        'order',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_active' => 'boolean',
        'rating' => 'float',
    ];

    public function favorites(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function destinations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Destination::class, 'destination_culinary')->withTimestamps();
    }
}
