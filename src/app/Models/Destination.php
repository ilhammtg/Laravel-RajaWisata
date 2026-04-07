<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
        'description',
        'location',
        'location_url',
        'map_iframe',
        'category',
        'image_url',
        'gallery', // Added 'gallery'
        'is_active',
        'is_hero',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_hero' => 'boolean',
        'order' => 'integer',
        'gallery' => 'array', // Added 'gallery' cast
    ];

    public function favorites(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function hotels(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'destination_hotel')->withTimestamps();
    }

    public function culinaries(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Culinary::class, 'destination_culinary')->withTimestamps();
    }
}
