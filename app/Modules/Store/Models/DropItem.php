<?php

namespace App\Modules\Store\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class DropItem extends Model
{
    protected $fillable = ['drop_id', 'sku_id', 'drop_quota', 'sold_count'];
    protected $casts = [
        'drop_quota' => 'integer',
        'sold_count' => 'integer',
    ];

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}

