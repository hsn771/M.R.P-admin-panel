<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name_eng',
        'name_bn',
        'email',
        'phone',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'logo_footer',
        'logo_header',
        'contact_page_title',
        'contact_page_description',
        'contact_page_subtitle',
        'footer_description',
    ];
}
