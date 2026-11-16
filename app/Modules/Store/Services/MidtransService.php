<?php

namespace App\Modules\Store\Services;

use App\Modules\Core\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    /**
     * Generate Snap payment token for a given Order.
     * Returns the token string to be used with snap.pay(token).
     */
    public function createSnapToken(Order $order): string
    {
        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_number,
                'gross_amount' => (int) $order->grand_total_idr,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email'      => $order->customer_email,
                'phone'      => $order->customer_phone,
                'shipping_address' => [
                    'first_name' => $order->customer_name,
                    'phone'      => $order->customer_phone,
                    'address'    => $order->shipping_address,
                    'city'       => $order->shipping_city,
                    'postal_code'=> '',
                    'country_code' => 'IDN',
                ],
            ],
            'item_details' => $this->buildItemDetails($order),
            'callbacks' => [
                'finish'  => route('shop.order.payment', ['ulid' => $order->ulid]),
                'unfinish'=> route('shop.order.payment', ['ulid' => $order->ulid]),
                'error'   => route('shop.order.payment', ['ulid' => $order->ulid]),
            ],
        ];

        return Snap::getSnapToken($params);
    }

    private function buildItemDetails(Order $order): array
    {
        $items = [];

        foreach ($order->items as $item) {
            $items[] = [
                'id'       => $item->sku_code,
                'price'    => (int) $item->unit_price_idr,
                'quantity' => (int) $item->quantity,
                'name'     => mb_substr($item->product_name . ' ' . $item->variant_name, 0, 50),
            ];
        }

        // Shipping cost as line item
        if ($order->shipping_cost_idr > 0) {
            $items[] = [
                'id'       => 'SHIPPING',
                'price'    => (int) $order->shipping_cost_idr,
                'quantity' => 1,
                'name'     => 'Ongkos Kirim (' . $order->shipping_courier . ')',
            ];
        }

        // Discount as negative line item
        if ($order->discount_idr > 0) {
            $items[] = [
                'id'       => 'DISCOUNT',
                'price'    => -(int) $order->discount_idr,
                'quantity' => 1,
                'name'     => 'Diskon Voucher',
            ];
        }

        return $items;
    }
}
