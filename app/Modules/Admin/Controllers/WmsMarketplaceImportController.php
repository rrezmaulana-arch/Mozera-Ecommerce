<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\OrderItem;
use App\Modules\Core\Models\Shipment;
use App\Modules\Core\Models\Sku;
use App\Modules\Wms\Models\MarketplaceImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WmsMarketplaceImportController extends Controller
{
    const MAX_ROWS = 2000;

    public function index()
    {
        $imports = MarketplaceImport::with(['channel', 'creator'])->latest()->paginate(15);
        $channels = Channel::whereIn('code', ['shopee', 'tiktok'])->get();

        return view('admin.wms.import.index', compact('imports', 'channels'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|exists:channels,id',
            'csv_file' => 'required|file|mimes:csv,txt|max:5120',
        ]);

        $channel = Channel::findOrFail($request->channel_id);
        $file = $request->file('csv_file');
        $filename = $file->getClientOriginalName();

        $handle = fopen($file->getRealPath(), 'r');
        if (! $handle) {
            return back()->with('error', 'Gagal membuka file CSV.');
        }

        // Read header row
        $headerRaw = fgetcsv($handle);
        if (! $headerRaw || empty(array_filter($headerRaw))) {
            fclose($handle);
            return back()->with('error', 'File CSV kosong atau tidak memiliki baris header.');
        }

        $header = array_map(function ($h) {
            return strtolower(trim(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $h)));
        }, $headerRaw);

        // Identify column indices
        $orderCol = $this->findColumnIndex($header, ['no. pesanan', 'order id', 'order_id', 'nomor pesanan']);
        $skuCol = $this->findColumnIndex($header, ['nomor referensi sku', 'sku', 'sku reference no', 'parent sku']);
        $productCol = $this->findColumnIndex($header, ['nama produk', 'product name', 'item name']);
        $qtyCol = $this->findColumnIndex($header, ['jumlah', 'qty', 'quantity']);
        $priceCol = $this->findColumnIndex($header, ['total pembayaran', 'total', 'order total', 'grand total']);
        $buyerCol = $this->findColumnIndex($header, ['username (pembeli)', 'nama penerima', 'recipient name', 'buyer']);
        $phoneCol = $this->findColumnIndex($header, ['no. telepon', 'phone', 'phone number']);
        $resiCol = $this->findColumnIndex($header, ['no. resi', 'tracking number', 'tracking_no']);

        $totalRows = 0;
        $successRows = 0;
        $duplicateRows = 0;
        $errorRows = 0;
        $logs = [];

        // Streaming read line-by-line using fgetcsv
        while (($row = fgetcsv($handle)) !== false) {
            if (empty(array_filter($row))) {
                continue;
            }

            $totalRows++;
            if ($totalRows > self::MAX_ROWS) {
                $logs[] = "Peringatan: File melebihi batas maksimal " . self::MAX_ROWS . " baris. Baris selanjutnya dilewati.";
                break;
            }

            $extOrderNumber = $orderCol !== null ? trim($row[$orderCol] ?? '') : null;
            if (!$extOrderNumber) {
                $errorRows++;
                $logs[] = "Baris #{$totalRows}: Nomor pesanan tidak ditemukan.";
                continue;
            }

            // Check duplicate
            $existing = Order::where('channel_id', $channel->id)->where('order_number', $extOrderNumber)->first();
            if ($existing) {
                $duplicateRows++;
                $logs[] = "Baris #{$totalRows}: Pesanan {$extOrderNumber} sudah pernah diimpor (duplikat dilewati).";
                continue;
            }

            $rawSku = $skuCol !== null ? trim($row[$skuCol] ?? '') : '';
            $sku = Sku::where('sku_code', $rawSku)->orWhere('barcode', $rawSku)->first();

            $qty = $qtyCol !== null ? max(1, (int) ($row[$qtyCol] ?? 1)) : 1;
            $totalAmount = $priceCol !== null ? (int) preg_replace('/[^\d]/', '', $row[$priceCol] ?? '0') : 0;
            $buyerName = $buyerCol !== null ? trim($row[$buyerCol] ?? 'Pembeli ' . $channel->name) : 'Pembeli ' . $channel->name;
            $buyerPhone = $phoneCol !== null ? trim($row[$phoneCol] ?? '') : null;
            $resi = $resiCol !== null ? trim($row[$resiCol] ?? '') : null;

            // Transaction per row
            try {
                DB::transaction(function () use (
                    $extOrderNumber, $channel, $buyerName, $buyerPhone, $totalAmount, $sku, $rawSku, $productCol, $row, $qty, $resi
                ) {
                    $customer = Customer::firstOrCreate(
                        ['email' => strtolower($extOrderNumber) . "@marketplace.internal"],
                        [
                            'name' => $buyerName,
                            'phone' => $buyerPhone,
                            'tags' => [$channel->code, 'Marketplace Buyer'],
                            'notes' => "Impor pesanan {$channel->name} #{$extOrderNumber}",
                        ]
                    );

                    $order = Order::create([
                        'ulid' => (string) Str::ulid(),
                        'order_number' => $extOrderNumber,
                        'channel_id' => $channel->id,
                        'customer_id' => $customer->id,
                        'customer_name' => $buyerName,
                        'customer_email' => $customer->email,
                        'customer_phone' => $buyerPhone,
                        'subtotal_idr' => $totalAmount,
                        'grand_total_idr' => $totalAmount,
                        'status' => $resi ? 'shipped' : 'paid',
                        'paid_at' => now(),
                    ]);

                    OrderItem::create([
                        'order_id' => $order->id,
                        'sku_id' => $sku ? $sku->id : null,
                        'sku_code' => $sku ? $sku->sku_code : ($rawSku ?: 'UNMAPPED'),
                        'product_name' => $sku ? $sku->product->name : ($productCol !== null ? ($row[$productCol] ?? 'Produk Marketplace') : 'Produk Marketplace'),
                        'variant_name' => $sku ? ($sku->color . ' ' . $sku->size) : 'Default',
                        'unit_price_idr' => $sku ? $sku->price_idr : $totalAmount,
                        'cost_idr' => $sku ? $sku->cost_idr : 0,
                        'quantity' => $qty,
                        'subtotal_idr' => $totalAmount,
                    ]);

                    if ($resi) {
                        Shipment::create([
                            'ulid' => (string) Str::ulid(),
                            'order_id' => $order->id,
                            'courier_name' => 'Marketplace Courier',
                            'tracking_number' => $resi,
                            'status' => 'in_transit',
                            'shipped_at' => now(),
                        ]);
                    }
                });

                $successRows++;
            } catch (\Throwable $e) {
                $errorRows++;
                $logs[] = "Baris #{$totalRows}: Gagal memproses pesanan {$extOrderNumber} - " . $e->getMessage();
            }
        }

        fclose($handle);

        MarketplaceImport::create([
            'ulid' => (string) Str::ulid(),
            'channel_id' => $channel->id,
            'filename' => $filename,
            'total_rows' => $totalRows,
            'success_rows' => $successRows,
            'duplicate_rows' => $duplicateRows,
            'error_rows' => $errorRows,
            'status' => 'completed',
            'logs' => $logs,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.wms.import.index')
            ->with('success', "Impor selesai! {$successRows} pesanan berhasil diimpor, {$duplicateRows} duplikat dicegah, {$errorRows} gagal.");
    }

    private function findColumnIndex(array $header, array $candidates): ?int
    {
        foreach ($candidates as $cand) {
            foreach ($header as $idx => $col) {
                if (str_contains($col, $cand)) {
                    return $idx;
                }
            }
        }
        return null;
    }
}
