<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $fillable = [
        'name',
        'nation_id',
        'gender',
        'dob',
        'record_card_number',
        'designation',
        'section',
        'mobile',
        'email',
        'reason',
        'access_type',
        'status'
    ];
}
