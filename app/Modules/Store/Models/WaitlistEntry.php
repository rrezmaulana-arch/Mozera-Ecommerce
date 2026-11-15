<?php

namespace App\Modules\Store\Models;

use App\Modules\Core\Models\Sku;
use Illuminate\Database\Eloquent\Model;

class WaitlistEntry extends Model
{
    protected $fillable = [
        'drop_id',
        'sku_id',
        'name',
        'email',
        'phone',
        'consent_given',
        'notified_at',
    ];

    protected $casts = [
        'consent_given' => 'boolean',
        'notified_at' => 'datetime',
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

