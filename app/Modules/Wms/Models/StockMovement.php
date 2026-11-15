<?php

namespace App\Modules\Wms\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StockMovement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'ulid',
        'location_id',
        'sku_id',
        'movement_type',
        'quantity',
        'reference_type',
        'reference_id',
        'notes',
        'created_by',
        'created_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'created_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->ulid)) {
                $item->ulid = (string) Str::ulid();
            }
            if (empty($item->created_at)) {
                $item->created_at = now();
            }
        });
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}

