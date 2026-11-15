<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'sku_id',
        'sku_code',
        'product_name',
        'variant_name',
        'unit_price_idr',
        'cost_idr',
        'quantity',
        'subtotal_idr',
    ];

    protected $casts = [
        'unit_price_idr' => 'integer',
        'cost_idr' => 'integer',
        'quantity' => 'integer',
        'subtotal_idr' => 'integer',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}

