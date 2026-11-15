<?php

namespace App\Modules\Crm\Models;

use App\Modules\Core\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'session_id',
        'event_type',
        'metadata',
        'ip_address',
        'created_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

