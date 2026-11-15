<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'ulid',
        'series_id',
        'name',
        'slug',
        'category',
        'description',
        'material',
        'care_instructions',
        'length_cm',
        'is_preorder',
        'preorder_lead_days',
        'primary_image',
        'gallery_images',
        'is_active',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_preorder' => 'boolean',
        'is_active' => 'boolean',
        'length_cm' => 'integer',
        'preorder_lead_days' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function ($product) {
            if (empty($product->ulid)) {
                $product->ulid = (string) Str::ulid();
            }
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function getMinPriceAttribute(): int
    {
        return (int) ($this->skus->min('price_idr') ?? 0);
    }

    public function getMaxPriceAttribute(): int
    {
        return (int) ($this->skus->max('price_idr') ?? 0);
    }
}

