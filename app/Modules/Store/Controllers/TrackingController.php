<?php

namespace App\Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $order = null;

        if ($request->filled('order_number')) {
            $orderNumber = strtoupper(trim($request->order_number));
            $verification = strtolower(trim($request->input('verification') ?? $request->input('customer_email') ?? $request->input('phone_last4') ?? ''));

            if (empty($verification)) {
                return back()->with('error', 'Wajib memasukkan email pemesan atau 4 digit akhir nomor HP untuk verifikasi keamanan pelacakan.')->withInput();
            }

            $candidate = Order::where('order_number', $orderNumber)
                ->with(['items.sku.product', 'shipments', 'payments'])
                ->first();

            if (! $candidate) {
                return back()->with('error', 'Nomor pesanan tidak ditemukan. Mohon periksa kembali.')->withInput();
            }

            // Verify email or last 4 digits of phone
            $emailMatch = strtolower(trim($candidate->customer_email)) === $verification;
            $phoneClean = preg_replace('/\D/', '', $candidate->customer_phone ?? '');
            $phoneMatch = (strlen($verification) === 4 && str_ends_with($phoneClean, $verification))
                || ($verification === $phoneClean);

            if (! $emailMatch && ! $phoneMatch) {
                return back()->with('error', 'Verifikasi kontak (email atau 4 digit akhir nomor HP) tidak cocok dengan pesanan ini.')->withInput();
            }

            // Masking data pribadi untuk kepatuhan UU PDP
            $candidate->customer_name = self::maskName($candidate->customer_name);
            $candidate->customer_phone = self::maskPhone($candidate->customer_phone);
            $candidate->shipping_address = self::maskAddress($candidate->shipping_address);

            $order = $candidate;
        }

        return view('shop.tracking', compact('order'));
    }

    public function detail(Request $request, string $orderNumber)
    {
        $orderNumber = strtoupper(trim($orderNumber));
        $verification = strtolower(trim($request->input('verification') ?? $request->input('customer_email') ?? $request->input('phone_last4') ?? ''));

        $isSessionVerified = (bool) $request->session()->get('tracking_verified_' . $orderNumber);

        if (! $isSessionVerified && empty($verification)) {
            return redirect()->route('shop.tracking', ['order_number' => $orderNumber])
                ->with('error', 'Wajib memasukkan email pemesan atau 4 digit akhir nomor HP untuk verifikasi keamanan pelacakan.');
        }

        $order = Order::where('order_number', $orderNumber)
            ->with(['items.sku.product', 'shipments', 'payments'])
            ->firstOrFail();

        if (! $isSessionVerified) {
            $emailMatch = strtolower(trim($order->customer_email)) === $verification;
            $phoneClean = preg_replace('/\D/', '', $order->customer_phone ?? '');
            $phoneMatch = (strlen($verification) === 4 && str_ends_with($phoneClean, $verification))
                || ($verification === $phoneClean);

            if (! $emailMatch && ! $phoneMatch) {
                return redirect()->route('shop.tracking', ['order_number' => $orderNumber])
                    ->with('error', 'Verifikasi kontak tidak cocok dengan pesanan ini.');
            }
        }

        // Masking data pribadi untuk kepatuhan UU PDP
        $order->customer_name = self::maskName($order->customer_name);
        $order->customer_phone = self::maskPhone($order->customer_phone);
        $order->shipping_address = self::maskAddress($order->shipping_address);

        return view('shop.tracking', compact('order'));
    }

    public static function maskName(string $name): string
    {
        $parts = explode(' ', trim($name));
        if (count($parts) === 1) {
            $len = strlen($parts[0]);
            return substr($parts[0], 0, 1) . str_repeat('*', max(3, $len - 1));
        }
        $masked = [$parts[0]];
        for ($i = 1; $i < count($parts); $i++) {
            $masked[] = substr($parts[$i], 0, 1) . str_repeat('*', max(2, strlen($parts[$i]) - 1));
        }
        return implode(' ', $masked);
    }

    public static function maskPhone(?string $phone): string
    {
        if (! $phone) {
            return '-';
        }
        $digits = preg_replace('/\D/', '', $phone);
        if (strlen($digits) <= 6) {
            return substr($digits, 0, 2) . '****';
        }
        return substr($digits, 0, 4) . '****' . substr($digits, -4);
    }

    public static function maskAddress(?string $address): string
    {
        if (! $address) {
            return '-';
        }
        $len = strlen($address);
        if ($len <= 10) {
            return substr($address, 0, 3) . '*** [Disensor]';
        }
        return substr($address, 0, 10) . '*** [Alamat disensor untuk privasi]';
    }
}
