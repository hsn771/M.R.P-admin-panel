<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurLeadership extends Model
{
    protected $fillable = [
        'image',
        'name',
        'post',
        'description',
    ];
}
