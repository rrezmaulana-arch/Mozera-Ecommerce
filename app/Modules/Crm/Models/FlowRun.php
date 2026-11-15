<?php

namespace App\Modules\Crm\Models;

use App\Models\User;
use App\Modules\Core\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class FlowRun extends Model
{
    protected $fillable = [
        'flow_id',
        'customer_id',
        'reference_type',
        'reference_id',
        'status',
        'scheduled_for',
        'approved_by',
        'approved_at',
        'sent_at',
    ];

    protected $casts = [
        'scheduled_for' => 'datetime',
        'approved_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function flow()
    {
        return $this->belongsTo(Flow::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}

