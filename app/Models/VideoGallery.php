<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $fillable = ['video'];

    /**
     * Get the full URL for the video gallery video
     */
    public function getVideoUrlAttribute(): ?string
    {
        if (!$this->video) {
            return null;
        }

        return asset('storage/' . $this->video);
    }
}
