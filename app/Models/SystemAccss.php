<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemAccss extends Model
{
    protected $fillable = ['access_name', 'system_id', 'description'];

    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }
}
