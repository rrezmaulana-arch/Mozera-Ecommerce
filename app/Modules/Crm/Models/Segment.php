<?php

namespace App\Modules\Crm\Models;

use App\Modules\Core\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $fillable = ['code', 'name', 'description', 'criteria', 'is_active'];
    protected $casts = [
        'criteria' => 'array',
        'is_active' => 'boolean',
    ];

    public function members()
    {
        return $this->belongsToMany(Customer::class, 'segment_members');
    }
}

