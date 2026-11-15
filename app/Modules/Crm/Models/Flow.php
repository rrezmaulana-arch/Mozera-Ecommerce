<?php

namespace App\Modules\Crm\Models;

use App\Models\User;
use App\Modules\Core\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    protected $fillable = [
        'code',
        'name',
        'trigger_event',
        'delay_hours',
        'requires_approval',
        'is_active',
    ];

    protected $casts = [
        'delay_hours' => 'integer',
        'requires_approval' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function runs()
    {
        return $this->hasMany(FlowRun::class);
    }
}

