<?php

namespace App\Modules\Store\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $fillable = [
        'return_request_id',
        'sku_id',
        'quantity',
        'disposition',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function returnRequest()
    {
        return $this->belongsTo(ReturnRequest::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }
}

