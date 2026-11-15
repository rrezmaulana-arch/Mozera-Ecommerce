<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Shipment extends Model
{
    protected $fillable = [
        'ulid',
        'order_id',
        'courier_name',
        'tracking_number',
        'status',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($shipment) {
            if (empty($shipment->ulid)) {
                $shipment->ulid = (string) Str::ulid();
            }
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

