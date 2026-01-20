<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'mobile_no',
        'email',
        'business_name',
        'business_type',
        'time_of_business',
        'address',
        'district',
        'nid_no',
        'description',
    ];
}
