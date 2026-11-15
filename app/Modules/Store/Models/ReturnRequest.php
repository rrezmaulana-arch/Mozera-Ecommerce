<?php

namespace App\Modules\Store\Models;

use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ReturnRequest extends Model
{
    protected $fillable = [
        'ulid',
        'order_id',
        'customer_id',
        'status',
        'reason',
        'notes',
        'photo_url',
        'admin_notes',
        'return_tracking_number',
        'received_at',
        'completed_at',
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'completed_at' => 'datetime',
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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(ReturnItem::class);
    }
}

