<?php

namespace App\Modules\Wms\Models;

use App\Models\User;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PickPack extends Model
{
    protected $fillable = [
        'ulid',
        'order_id',
        'assigned_to',
        'status',
        'picked_at',
        'packed_at',
        'notes',
    ];

    protected $casts = [
        'picked_at' => 'datetime',
        'packed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->ulid)) {
                $item->ulid = (string) Str::ulid();
            }
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scans()
    {
        return $this->hasMany(PickScan::class);
    }
}

