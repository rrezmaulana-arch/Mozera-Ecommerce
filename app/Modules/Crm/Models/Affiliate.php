<?php

namespace App\Modules\Crm\Models;

use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $fillable = [
        'code',
        'customer_id',
        'name',
        'email',
        'bank_name',
        'bank_account_number',
        'bank_account_holder',
        'commission_rate',
        'total_commission_idr',
        'total_paid_idr',
        'is_active',
    ];

    protected $casts = [
        'commission_rate' => 'float',
        'total_commission_idr' => 'integer',
        'total_paid_idr' => 'integer',
        'is_active' => 'boolean',
    ];

    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }
}

