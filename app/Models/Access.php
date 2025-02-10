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
        'request_type',
        'access_type',
        'status',
        'granted_at',
        'granted_by',
        'modified_at',
        'modified_by',
        'revoked_at',
        'revoked_by'
    ];

    protected $casts = [
        'dob' => 'date',
        'granted_at' => 'datetime',
        'modified_at' => 'datetime',
        'revoked_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function grantedBy()
    {
        return $this->belongsTo(User::class, 'granted_by');
    }

    public function modifiedBy()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }

    public function revokedBy()
    {
        return $this->belongsTo(User::class, 'revoked_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeGranted($query)
    {
        return $query->where('status', 'granted');
    }

    public function scopeRevoked($query)
    {
        return $query->where('status', 'revoked');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function system()
    {
        return $this->belongsTo(System::class, 'access_type', 'id');
    }

    // Add this relationship
    public function systemAccesses()
    {
        return $this->belongsToMany(SystemAccss::class, 'access_system_access', 'access_id', 'system_access_id');
    }

    // Add this constant to define valid request types
    public const REQUEST_TYPES = [
        'new' => 'New Access Request',
        'modify' => 'Modify Access',
        'extend' => 'Extend Access',
        'revoke' => 'Revoke Access',
        'temporary' => 'Temporary Access'
    ];

    // Add validation rules as a static property
    public static $rules = [
        'request_type' => 'required|in:new,modify,extend,revoke,temporary'
    ];

    public function comments()
    {
        return $this->hasMany(AccessComment::class)->orderBy('created_at', 'desc');
    }
}
