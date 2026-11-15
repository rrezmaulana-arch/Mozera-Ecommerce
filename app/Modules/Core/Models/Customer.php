<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ulid',
        'name',
        'email',
        'phone',
        'tags',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($customer) {
            if (empty($customer->ulid)) {
                $customer->ulid = (string) Str::ulid();
            }
        });
    }

    public function identities()
    {
        return $this->hasMany(CustomerIdentity::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

