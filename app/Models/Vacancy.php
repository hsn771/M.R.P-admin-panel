<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'workplace',
        'worktime',
        'experience',
        'description',
        'skills',
        'last_date_of_apply',
    ];

    protected $casts = [
        'skills' => 'array',
        'last_date_of_apply' => 'date',
    ];
}
