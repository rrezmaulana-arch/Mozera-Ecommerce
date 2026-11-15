<?php

namespace App\Modules\Crm\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ActionItem extends Model
{
    protected $fillable = [
        'ulid',
        'category',
        'priority',
        'title',
        'description',
        'action_url',
        'status',
        'resolved_at',
        'resolved_by',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->ulid)) {
                $item->ulid = (string) Str::ulid();
            }
        });
    }

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }
}

