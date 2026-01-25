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
        'birth_certificate',
        'nid_file',
        'photo_up',
        'chairman_certificate',
        'husbands_information',
        'considerable_person_sign',
        'bank_check',
        'trade_license',
        'digital_sign',
    ];

    protected $casts = [
        'photo_up' => 'array',
    ];
}
