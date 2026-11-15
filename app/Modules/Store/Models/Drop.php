<?php

namespace App\Modules\Store\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Drop extends Model
{
    protected $fillable = [
        'ulid',
        'code',
        'title',
        'description',
        'banner_url',
        'drop_time',
        'end_time',
        'is_active',
    ];

    protected $casts = [
        'drop_time' => 'datetime',
        'end_time' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->ulid)) {
                $item->ulid = (string) Str::ulid();
            }
        });
    }

    public function items()
    {
        return $this->hasMany(DropItem::class);
    }

    public function isLive(): bool
    {
        $now = now();
        return $this->is_active && $this->drop_time <= $now && (!$this->end_time || $this->end_time >= $now);
    }
}

