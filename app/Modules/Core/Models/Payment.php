<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $fillable = [
        'ulid',
        'order_id',
        'gateway',
        'transaction_id',
        'payment_method',
        'amount_idr',
        'status',
        'idempotency_key',
        'payload',
        'paid_at',
    ];

    protected $casts = [
        'amount_idr' => 'integer',
        'payload' => 'array',
        'paid_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($payment) {
            if (empty($payment->ulid)) {
                $payment->ulid = (string) Str::ulid();
            }
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

