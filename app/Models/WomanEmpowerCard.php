<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WomanEmpowerCard extends Model
{
    protected $fillable = [
        'name',
        'age',
        'husband_father_name',
        'mother_name',
        'address',
        'voter_id',
    ];
}
