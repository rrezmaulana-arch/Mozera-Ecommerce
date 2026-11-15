<?php

namespace App\Modules\Crm\Services;

use App\Modules\Crm\Models\LoyaltyLedger;
use Illuminate\Support\Facades\DB;

class LoyaltyService
{
    public function getBalance(int $customerId): int
    {
        return (int) LoyaltyLedger::where('customer_id', $customerId)->sum('points');
    }

    public function awardPoints(int $customerId, int $orderAmountIdr, string $orderNumber): int
    {
        $points = (int) floor($orderAmountIdr / 10000);
        if ($points <= 0) {
            return 0;
        }

        LoyaltyLedger::create([
            'customer_id' => $customerId,
            'points' => $points,
            'transaction_type' => 'EARN_PURCHASE',
            'reference_id' => $orderNumber,
            'notes' => "Poin dari transaksi order #{$orderNumber}",
            'created_at' => now(),
        ]);

        return $points;
    }

    public function redeemPoints(int $customerId, int $points, string $orderNumber): bool
    {
        $current = $this->getBalance($customerId);
        if ($current < $points) {
            return false;
        }

        LoyaltyLedger::create([
            'customer_id' => $customerId,
            'points' => -$points,
            'transaction_type' => 'REDEEM_ORDER',
            'reference_id' => $orderNumber,
            'notes' => "Penukaran poin untuk order #{$orderNumber}",
            'created_at' => now(),
        ]);

        return true;
    }
}

