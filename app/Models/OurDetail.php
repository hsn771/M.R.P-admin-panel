<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurDetail extends Model
{
    protected $fillable = [
        'our_address',
        'our_phone',
        'our_email',
        'logo',
        'title',
        'footer_description',
        'fb_link',
        'twitter_link',
        'insta_link',
        'linkedin_link',
    ];
}
