<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'image',
        'type_name',
        'title',
        'address',
        'time',
        'description',
        'date',
        'reasons',
        'schedule',
        'image_gallery',
    ];

    protected $casts = [
        'date' => 'date',
        'reasons' => 'array',
        'schedule' => 'array',
        'image_gallery' => 'array',
    ];
}
