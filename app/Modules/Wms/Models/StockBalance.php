<?php

namespace App\Modules\Wms\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class StockBalance extends Model
{
    protected $fillable = [
        'location_id',
        'sku_id',
        'physical_qty',
        'reserved_qty',
        'available_qty',
    ];

    protected $casts = [
        'physical_qty' => 'integer',
        'reserved_qty' => 'integer',
        'available_qty' => 'integer',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}

