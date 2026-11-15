<?php

namespace App\Modules\Wms\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Batch extends Model
{
    protected $fillable = ['batch_number', 'supplier_name', 'notes', 'received_at'];
    protected $casts = ['received_at' => 'datetime'];

    public function inbounds()
    {
        return $this->hasMany(Inbound::class);
    }
}

