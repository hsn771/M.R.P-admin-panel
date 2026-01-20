<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestSubmission extends Model
{
    protected $fillable = [
        'name',
        'subject',
        'address',
        'email',
        'mobile_number',
        'voter_id_card_number',
        'detailed_description',
        'status',
    ];
}
