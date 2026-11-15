<?php

namespace App\Modules\Crm\Services;

use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Crm\Models\CustomerMetric;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RfmService
{
    /**
     * Recalculates RFM metrics and customer rhythm for all customers or a specific customer.
     */
    public function recalculate(?int $customerId = null): void
    {
        $customersQuery = Customer::query();
        if ($customerId) {
            $customersQuery->where('id', $customerId);
        }

        $customers = $customersQuery->get();

        foreach ($customers as $customer) {
            $orders = Order::where('customer_id', $customer->id)
                ->whereIn('status', ['paid', 'picking', 'packed', 'shipped', 'delivered', 'completed'])
                ->orderBy('created_at', 'asc')
                ->get();

            $frequency = $orders->count();
            $monetary = (int) $orders->sum('grand_total_idr');

            $recencyDays = 999;
            $rhythmDays = null;
            $predictedNextPurchase = null;

            if ($frequency > 0) {
                $lastOrderDate = $orders->last()->created_at;
                $recencyDays = (int) Carbon::now()->diffInDays($lastOrderDate);

                // Calculate rhythm if multiple purchases
                if ($frequency > 1) {
                    $firstOrderDate = $orders->first()->created_at;
                    $spanDays = max(1, $firstOrderDate->diffInDays($lastOrderDate));
                    $rhythmDays = (int) round($spanDays / ($frequency - 1));

                    $predictedNextPurchase = Carbon::parse($lastOrderDate)->addDays($rhythmDays);
                }
            }

            // Score R (1-5)
            $rScore = 1;
            if ($recencyDays <= 30) $rScore = 5;
            elseif ($recencyDays <= 60) $rScore = 4;
            elseif ($recencyDays <= 90) $rScore = 3;
            elseif ($recencyDays <= 180) $rScore = 2;

            // Score F (1-5)
            $fScore = 1;
            if ($frequency >= 5) $fScore = 5;
            elseif ($frequency >= 3) $fScore = 4;
            elseif ($frequency >= 2) $fScore = 3;
            elseif ($frequency == 1) $fScore = 2;

            // Score M (1-5)
            $mScore = 1;
            if ($monetary >= 2000000) $mScore = 5;
            elseif ($monetary >= 1000000) $mScore = 4;
            elseif ($monetary >= 500000) $mScore = 3;
            elseif ($monetary > 0) $mScore = 2;

            // Segment mapping
            $segment = 'new';
            if ($frequency == 0) {
                $segment = 'new';
            } elseif ($rScore >= 4 && $fScore >= 4) {
                $segment = 'champions';
            } elseif ($rScore >= 3 && $fScore >= 3) {
                $segment = 'loyal';
            } elseif ($rScore >= 4 && $fScore <= 2) {
                $segment = 'potential';
            } elseif ($rScore <= 2 && $fScore >= 3) {
                $segment = 'at_risk';
            } elseif ($rScore <= 2 && $fScore <= 2) {
                $segment = 'hibernating';
            } else {
                $segment = 'lost';
            }

            CustomerMetric::updateOrCreate(
                ['customer_id' => $customer->id],
                [
                    'recency_days' => $recencyDays,
                    'frequency_count' => $frequency,
                    'monetary_total_idr' => $monetary,
                    'r_score' => $rScore,
                    'f_score' => $fScore,
                    'm_score' => $mScore,
                    'segment' => $segment,
                    'rhythm_days' => $rhythmDays,
                    'predicted_next_purchase' => $predictedNextPurchase,
                    'last_calculated_at' => now(),
                ]
            );
        }
    }
}

