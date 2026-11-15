<?php

namespace App\Modules\Wms\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class InboundItem extends Model
{
    protected $fillable = [
        'inbound_id',
        'sku_id',
        'quantity',
        'cost_idr',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'cost_idr' => 'integer',
    ];

    public function inbound()
    {
        return $this->belongsTo(Inbound::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}

