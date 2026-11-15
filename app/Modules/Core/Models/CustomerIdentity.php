<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerIdentity extends Model
{
    protected $fillable = [
        'customer_id',
        'channel_code',
        'external_id',
        'identifier_value',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

