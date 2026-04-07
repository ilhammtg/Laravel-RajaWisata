<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
        'description',
        'location',
        'location_url',
        'map_iframe',
        'rating',
        'price',
        'category',
        'image_url',
        'is_active',
        'order',
        'gallery',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'order' => 'integer',
        'gallery' => 'array',
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
        return $this->belongsToMany(Destination::class, 'destination_hotel')->withTimestamps();
    }
}
