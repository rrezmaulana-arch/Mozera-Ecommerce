<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sku extends Model
{
    protected $fillable = [
        'ulid',
        'product_id',
        'sku_code',
        'barcode',
        'name',
        'color',
        'size',
        'price_idr',
        'cost_idr',
        'weight_grams',
        'image_url',
        'is_active',
    ];

    protected $casts = [
        'price_idr' => 'integer',
        'cost_idr' => 'integer',
        'weight_grams' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($sku) {
            if (empty($sku->ulid)) {
                $sku->ulid = (string) Str::ulid();
            }
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

