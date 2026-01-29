<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'mobile_no',
        'apply_for_post',
        'work_experience',
        'educational_qualifications',
        'cover_letter',
        'cv_upload',
    ];
}
