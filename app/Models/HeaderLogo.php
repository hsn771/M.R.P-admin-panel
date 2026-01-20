<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderLogo extends Model
{
    protected $fillable = ['name', 'logo_image'];

    /**
     * Get the full URL for the logo image
     */
    public function getLogoImageUrlAttribute(): ?string
    {
        if (!$this->logo_image) {
            return null;
        }

        return asset('storage/' . $this->logo_image);
    }
}
