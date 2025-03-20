<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionHead extends Model
{
    protected $fillable = ['user_id', 'section_type', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
