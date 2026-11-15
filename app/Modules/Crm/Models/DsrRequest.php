<?php

namespace App\Modules\Crm\Models;

use App\Models\User;
use App\Modules\Core\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DsrRequest extends Model
{
    protected $fillable = [
        'ulid',
        'customer_id',
        'request_type',
        'status',
        'reason',
        'result_url',
        'processed_by',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->ulid)) {
                $item->ulid = (string) Str::ulid();
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}

