<?php

namespace App\Modules\Wms\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class StocktakeLine extends Model
{
    protected $fillable = [
        'stocktake_id',
        'sku_id',
        'expected_qty',
        'counted_qty',
        'difference_qty',
        'notes',
    ];

    protected $casts = [
        'expected_qty' => 'integer',
        'counted_qty' => 'integer',
        'difference_qty' => 'integer',
    ];

    public function stocktake()
    {
        return $this->belongsTo(Stocktake::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}

