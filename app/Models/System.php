<?php

namespace App\Models;

use App\Models\Access;
use App\Models\SystemAccss;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class System extends Model
{
    protected $fillable = ['name', 'description'];

    public function accesses(): HasMany
    {
        return $this->hasMany(SystemAccss::class);
    }

    public function access()
    {
        return $this->hasMany(Access::class);
    }
}
