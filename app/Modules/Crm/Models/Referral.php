<?php

namespace App\Modules\Crm\Models;

use App\Modules\Core\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'affiliate_id',
        'order_id',
        'order_total_idr',
        'commission_amount_idr',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'order_total_idr' => 'integer',
        'commission_amount_idr' => 'integer',
        'paid_at' => 'datetime',
    ];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

