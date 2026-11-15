<?php

namespace App\Modules\Crm\Models;

use App\Modules\Core\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerMetric extends Model
{
    protected $fillable = [
        'customer_id',
        'recency_days',
        'frequency_count',
        'monetary_total_idr',
        'r_score',
        'f_score',
        'm_score',
        'segment',
        'rhythm_days',
        'predicted_next_purchase',
        'last_calculated_at',
    ];

    protected $casts = [
        'recency_days' => 'integer',
        'frequency_count' => 'integer',
        'monetary_total_idr' => 'integer',
        'r_score' => 'integer',
        'f_score' => 'integer',
        'm_score' => 'integer',
        'rhythm_days' => 'integer',
        'predicted_next_purchase' => 'date',
        'last_calculated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

