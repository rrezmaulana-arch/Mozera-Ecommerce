<?php

namespace App\Modules\Crm\Models;

use App\Models\User;
use App\Modules\Core\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class LoyaltyLedger extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'points',
        'transaction_type',
        'reference_id',
        'notes',
        'created_by',
        'created_at',
    ];

    protected $casts = [
        'points' => 'integer',
        'created_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

