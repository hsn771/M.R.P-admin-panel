<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'gender',
        'post',
        'additional_info',
    ];
}
