<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    protected $fillable = ['title', 'date', 'images'];

    protected $casts = [
        'images' => 'array',
        'date' => 'date',
    ];

    /**
     * Get the full URLs for the photo gallery images
     */
    public function getImageUrlsAttribute(): array
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->images);
    }
}
