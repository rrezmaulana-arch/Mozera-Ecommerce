<?php

namespace App\Modules\Store\Models;

use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use Illuminate\Database\Eloquent\Model;

class VoucherRedemption extends Model
{
    protected $fillable = [
        'voucher_id',
        'order_id',
        'customer_id',
        'discount_idr',
    ];

    protected $casts = [
        'discount_idr' => 'integer',
    ];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

