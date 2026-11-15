<?php

namespace App\Modules\Wms\Services;

use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\Sku;
use App\Modules\Wms\Models\Location;
use App\Modules\Wms\Models\StockBalance;
use App\Modules\Wms\Models\StockMovement;
use App\Modules\Wms\Models\StockReservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StockService
{
    /**
     * Records an immutable stock movement and updates the cached stock balance atomically.
     */
    public function recordMovement(
        int $locationId,
        int $skuId,
        string $movementType,
        int $quantity, // Positive for in, negative for out
        ?string $referenceType = null,
        ?string $referenceId = null,
        ?string $notes = null,
        ?int $userId = null
    ): StockMovement {
        return DB::transaction(function () use (
            $locationId, $skuId, $movementType, $quantity, $referenceType, $referenceId, $notes, $userId
        ) {
            // 1. Insert into immutable ledger
            $movement = StockMovement::create([
                'ulid' => (string) Str::ulid(),
                'location_id' => $locationId,
                'sku_id' => $skuId,
                'movement_type' => $movementType,
                'quantity' => $quantity,
                'reference_type' => $referenceType,
                'reference_id' => $referenceId,
                'notes' => $notes,
                'created_by' => $userId ?? auth()->id(),
                'created_at' => now(),
            ]);

            // 2. Update cached balance
            $balance = StockBalance::firstOrCreate(
                ['location_id' => $locationId, 'sku_id' => $skuId],
                ['physical_qty' => 0, 'reserved_qty' => 0, 'available_qty' => 0]
            );

            if ($movementType === 'INBOUND' || $movementType === 'RETURN_IN') {
                $balance->physical_qty += $quantity;
            } elseif ($movementType === 'PICK_OUT') {
                $balance->physical_qty -= abs($quantity);
                $balance->reserved_qty = max(0, $balance->reserved_qty - abs($quantity));
            } elseif ($movementType === 'RESERVE') {
                $balance->reserved_qty += abs($quantity);
            } elseif ($movementType === 'RELEASE') {
                $balance->reserved_qty = max(0, $balance->reserved_qty - abs($quantity));
            } elseif ($movementType === 'ADJUST' || $movementType === 'OPNAME_ADJUST') {
                $balance->physical_qty += $quantity;
            }

            $balance->available_qty = max(0, $balance->physical_qty - $balance->reserved_qty);
            $balance->save();

            return $movement;
        });
    }

    /**
     * Atomically reserves stock during checkout.
     * Throws \Exception if available stock is insufficient.
     */
    public function reserveOrderStock(Order $order, ?int $locationId = null): void
    {
        $targetLocationId = $locationId ?? Location::where('code', 'PUSAT')->value('id') ?? 1;

        DB::transaction(function () use ($order, $targetLocationId) {
            foreach ($order->items as $item) {
                if (!$item->sku_id) {
                    continue;
                }

                $balance = StockBalance::where('location_id', $targetLocationId)
                    ->where('sku_id', $item->sku_id)
                    ->lockForUpdate()
                    ->first();

                $available = $balance ? $balance->available_qty : 0;

                if ($available < $item->quantity) {
                    throw new \RuntimeException(
                        "Stok tidak mencukupi untuk SKU {$item->sku_code} ({$item->product_name}). Tersedia: {$available}, diminta: {$item->quantity}."
                    );
                }

                // Create reservation
                StockReservation::create([
                    'order_id' => $order->id,
                    'sku_id' => $item->sku_id,
                    'location_id' => $targetLocationId,
                    'quantity' => $item->quantity,
                    'status' => 'active',
                    'expires_at' => now()->addMinutes(60), // 1 hour checkout payment window
                ]);

                // Record reserve movement
                $this->recordMovement(
                    $targetLocationId,
                    $item->sku_id,
                    'RESERVE',
                    $item->quantity,
                    'Order',
                    (string) $order->order_number,
                    "Reservasi checkout order #{$order->order_number}"
                );
            }
        });
    }

    /**
     * Releases reservations for an expired or cancelled order.
     */
    public function releaseOrderStock(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $reservations = StockReservation::where('order_id', $order->id)
                ->where('status', 'active')
                ->get();

            foreach ($reservations as $res) {
                $res->status = 'released';
                $res->save();

                $this->recordMovement(
                    $res->location_id,
                    $res->sku_id,
                    'RELEASE',
                    $res->quantity,
                    'Order',
                    (string) $order->order_number,
                    "Pembatalan / kadaluwarsa order #{$order->order_number}"
                );
            }
        });
    }

    /**
     * Fulfills pick: converts reservation into physical deduction (PICK_OUT).
     */
    public function fulfillOrderStock(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $reservations = StockReservation::where('order_id', $order->id)
                ->where('status', 'active')
                ->get();

            foreach ($reservations as $res) {
                $res->status = 'fulfilled';
                $res->save();

                $this->recordMovement(
                    $res->location_id,
                    $res->sku_id,
                    'PICK_OUT',
                    -$res->quantity,
                    'Order',
                    (string) $order->order_number,
                    "Pengiriman barang keluar order #{$order->order_number}"
                );
            }
        });
    }
}

