<?php

namespace App\Modules\Wms\Models;

use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class StockReservation extends Model
{
    protected $fillable = [
        'order_id',
        'sku_id',
        'location_id',
        'quantity',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'expires_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

