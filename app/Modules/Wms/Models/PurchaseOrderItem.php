<?php

namespace App\Modules\Wms\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $fillable = [
        'purchase_order_id',
        'sku_id',
        'quantity',
        'cost_idr',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'cost_idr' => 'integer',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}

