<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'father_name',
        'mother_name',
        'family_member_num',
        'nid_no',
        'phone',
        'religion',
        'nationality',
        'merital_status',
        'village_permanent',
        'post_name_permanent',
        'thana_upozilla_permanent',
        'block_permanent',
        'district_permanent',
        'post_code_permanent',
        'road_present',
        'post_name_present',
        'thana_upozilla_present',
        'block_present',
        'district_present',
        'post_code_present',
        'sponsor_name',
        'sponsor_phone',
        'digital_sign',
    ];
}
