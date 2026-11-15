<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Series extends Model
{
    protected $fillable = [
        'ulid',
        'code',
        'name',
        'description',
        'banner_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($series) {
            if (empty($series->ulid)) {
                $series->ulid = (string) Str::ulid();
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

