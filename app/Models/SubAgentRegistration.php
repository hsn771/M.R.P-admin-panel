<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAgentRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'mobile_no',
        'email',
        'address',
        'district',
        'nid_no',
        'description',
    ];
}
