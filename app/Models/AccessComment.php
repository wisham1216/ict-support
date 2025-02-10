<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessComment extends Model
{
    protected $fillable = ['access_id', 'user_id', 'comment'];

    public function access(): BelongsTo
    {
        return $this->belongsTo(Access::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
