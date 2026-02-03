<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurMilestone extends Model
{
    protected $fillable = [
        'year',
        'title',
        'description',
    ];
}
