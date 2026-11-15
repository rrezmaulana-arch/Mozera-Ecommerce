<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'ulid',
        'order_number',
        'channel_id',
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'shipping_city',
        'shipping_province',
        'shipping_courier',
        'shipping_service',
        'subtotal_idr',
        'discount_idr',
        'shipping_cost_idr',
        'grand_total_idr',
        'status',
        'notes',
        'paid_at',
        'cancelled_at',
    ];

    protected $casts = [
        'subtotal_idr' => 'integer',
        'discount_idr' => 'integer',
        'shipping_cost_idr' => 'integer',
        'grand_total_idr' => 'integer',
        'paid_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($order) {
            if (empty($order->ulid)) {
                $order->ulid = (string) Str::ulid();
            }
        });
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}

