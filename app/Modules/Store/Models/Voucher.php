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

    public function getValidationErrorMessage(int $subtotal, ?int $customerId = null): ?string
    {
        if (! $this->is_active) {
            return 'Kode voucher tidak valid atau tidak aktif.';
        }

        if ($this->starts_at && now()->lt($this->starts_at)) {
            return 'Periode penggunaan voucher belum dimulai.';
        }

        if ($this->expires_at && now()->gt($this->expires_at)) {
            return 'Kode voucher telah kedaluwarsa.';
        }

        if ($this->quota !== null && $this->used_count >= $this->quota) {
            return 'Kuota penukaran voucher telah habis.';
        }

        if ($subtotal < $this->min_purchase_idr) {
            return 'Minimum belanja untuk voucher ini adalah Rp ' . number_format($this->min_purchase_idr, 0, ',', '.');
        }

        if ($customerId) {
            $userRedemptions = VoucherRedemption::where('voucher_id', $this->id)
                ->where('customer_id', $customerId)
                ->count();
            if ($userRedemptions >= 1) {
                return 'Anda sudah pernah menggunakan voucher ini.';
            }
        }

        return null;
    }

    public function isUsableBy(int $subtotal, ?int $customerId = null): bool
    {
        return $this->getValidationErrorMessage($subtotal, $customerId) === null;
    }
}

