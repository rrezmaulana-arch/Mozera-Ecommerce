<?php

namespace App\Modules\Crm\Models;

use App\Modules\Core\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'consent_type',
        'is_granted',
        'version',
        'ip_address',
        'user_agent',
        'updated_at',
    ];

    protected $casts = [
        'is_granted' => 'boolean',
        'updated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

