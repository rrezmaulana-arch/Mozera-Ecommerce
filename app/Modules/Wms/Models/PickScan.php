<?php

namespace App\Modules\Wms\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class PickScan extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'pick_pack_id',
        'sku_id',
        'barcode_scanned',
        'scanned_at',
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
    ];

    public function pickPack()
    {
        return $this->belongsTo(PickPack::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}

