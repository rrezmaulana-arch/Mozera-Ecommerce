<?php

namespace App\Modules\Store\Models;

use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'name',
        'discount_type',
        'discount_amount',
        'min_purchase_idr',
        'max_discount_idr',
        'quota',
        'used_count',
        'starts_at',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'discount_amount' => 'integer',
        'min_purchase_idr' => 'integer',
        'max_discount_idr' => 'integer',
        'quota' => 'integer',
        'used_count' => 'integer',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function calculateDiscount(int $subtotal): int
    {
        if ($subtotal < $this->min_purchase_idr) {
            return 0;
        }

        if ($this->discount_type === 'percentage') {
            $discount = (int) round(($subtotal * $this->discount_amount) / 100);
            if ($this->max_discount_idr && $discount > $this->max_discount_idr) {
                $discount = $this->max_discount_idr;
            }
            return $discount;
        }

        return min($this->discount_amount, $subtotal);
    }
}

