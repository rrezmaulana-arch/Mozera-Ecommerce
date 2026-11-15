<?php

namespace App\Modules\Wms\Models;

use App\Models\User;
use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stocktake extends Model
{
    protected $fillable = [
        'ulid',
        'code',
        'location_id',
        'status',
        'notes',
        'created_by',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->ulid)) {
                $item->ulid = (string) Str::ulid();
            }
        });
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function lines()
    {
        return $this->hasMany(StocktakeLine::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

