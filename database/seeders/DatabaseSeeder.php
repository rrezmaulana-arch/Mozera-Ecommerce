<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\Core\Models\Address;
use App\Modules\Core\Models\Channel;
use App\Modules\Core\Models\Customer;
use App\Modules\Core\Models\CustomerIdentity;
use App\Modules\Core\Models\Order;
use App\Modules\Core\Models\OrderItem;
use App\Modules\Core\Models\Payment;
use App\Modules\Core\Models\Product;
use App\Modules\Core\Models\Series;
use App\Modules\Core\Models\Shipment;
use App\Modules\Core\Models\Sku;
use App\Modules\Crm\Models\ActionItem;
use App\Modules\Crm\Models\Affiliate;
use App\Modules\Crm\Models\Consent;
use App\Modules\Crm\Models\CustomerMetric;
use App\Modules\Crm\Models\EmailTemplate;
use App\Modules\Crm\Models\Flow;
use App\Modules\Crm\Models\FlowRun;
use App\Modules\Crm\Models\LoyaltyLedger;
use App\Modules\Store\Models\Drop;
use App\Modules\Store\Models\DropItem;
use App\Modules\Store\Models\ReturnRequest;
use App\Modules\Store\Models\ReturnItem;
use App\Modules\Store\Models\Voucher;
use App\Modules\Wms\Models\Batch;
use App\Modules\Wms\Models\Inbound;
use App\Modules\Wms\Models\InboundItem;
use App\Modules\Wms\Models\Location;
use App\Modules\Wms\Models\PickPack;
use App\Modules\Wms\Models\StockBalance;
use App\Modules\Wms\Models\StockMovement;
use App\Modules\Wms\Services\StockService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Staff Users
        $owner = User::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Miftah Afreza Maulana',
            'email' => 'miftah@itsfriday.id',
            'role' => 'owner',
            'phone' => '081234567890',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);

        $storeAdmin = User::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Sarah Store Admin',
            'email' => 'toko@itsfriday.id',
            'role' => 'store_admin',
            'phone' => '081234567891',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);

        $warehouseStaff = User::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Budi Staf Gudang',
            'email' => 'gudang@itsfriday.id',
            'role' => 'warehouse_staff',
            'phone' => '081234567892',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);

        $crmStaff = User::create([
            'ulid' => (string) Str::ulid(),
            'name' => 'Dinda CRM & Marketing',
            'email' => 'crm@itsfriday.id',
            'role' => 'crm_marketer',
            'phone' => '081234567893',
            'password' => Hash::make('password123'),
            'is_active' => true,
        ]);

        // 2. Channels
        $chWeb = Channel::create(['code' => 'web', 'name' => 'ITSFRIDAY Official Store (Web)', 'description' => 'Toko online direct-to-consumer']);
        $chShopee = Channel::create(['code' => 'shopee', 'name' => 'Shopee Official Store', 'description' => 'Marketplace Shopee']);
        $chTiktok = Channel::create(['code' => 'tiktok', 'name' => 'TikTok Shop', 'description' => 'Marketplace TikTok Shop']);
        $chBazar = Channel::create(['code' => 'bazar', 'name' => 'Pop-up Bazar (SBY, Solo, MLG)', 'description' => 'Penjualan event offline']);
        $chReseller = Channel::create(['code' => 'reseller', 'name' => 'Mitra Reseller', 'description' => 'Penjualan grosir reseller']);

        // 3. Locations
        $locPusat = Location::create(['code' => 'PUSAT', 'name' => 'Gudang Pusat Surabaya', 'type' => 'warehouse', 'address' => 'Jl. Rungkut Industri Raya No. 45, Surabaya']);
        $locSby = Location::create(['code' => 'BAZAR_SBY', 'name' => 'Titik Bazar Surabaya', 'type' => 'popup_store', 'address' => 'Tunjungan Plaza, Surabaya']);
        $locSolo = Location::create(['code' => 'BAZAR_SOLO', 'name' => 'Titik Bazar Solo', 'type' => 'popup_store', 'address' => 'The Park Mall Solo Baru']);
        $locMlg = Location::create(['code' => 'BAZAR_MLG', 'name' => 'Titik Bazar Malang', 'type' => 'popup_store', 'address' => 'Mall Olympic Garden, Malang']);

        // 4. Series
        $seriesPuspa = Series::create([
            'code' => 'PUSPA',
            'name' => 'PUSPA Series',
            'description' => 'Koleksi elegan terinspirasi motif flora Nusantara dengan material premium yang sejuk dan jatuh anggun.',
            'banner_image' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=1200&q=80',
        ]);

        $seriesIsla = Series::create([
            'code' => 'ISLA',
            'name' => 'ISLA Collection',
            'description' => 'Siluet santai dan minimalis untuk tampilan effortless chic sehari-hari (#everydayitsfriday).',
            'banner_image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1200&q=80',
        ]);

        $seriesSept = Series::create([
            'code' => 'SEPT_DROPS',
            'name' => 'Sept Drops',
            'description' => 'Koleksi edisi terbatas rilisan September dengan kuota eksklusif dan material linen pilihan.',
            'banner_image' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=1200&q=80',
        ]);

        // 5. Products & SKUs
        $prod1 = Product::create([
            'series_id' => $seriesPuspa->id,
            'name' => 'PUSPA Floral Outer Kimono',
            'slug' => 'puspa-floral-outer-kimono',
            'category' => 'outerwear',
            'description' => 'Outer berpotongan kimono dengan detail print eksklusif PUSPA. Cocok dipadukan dengan inner polos untuk aktivitas formal maupun santai.',
            'material' => 'Premium Rayon Twill (Lembut, dingin, tidak menerawang)',
            'care_instructions' => 'Cuci tangan dengan air dingin, jemur di tempat teduh, setrika suhu sedang.',
            'length_cm' => 110,
            'is_preorder' => false,
            'primary_image' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800&q=80',
            'gallery_images' => [
                'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800&q=80',
                'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=800&q=80',
            ],
            'is_active' => true,
        ]);

        $sku1_sage_all = Sku::create([
            'product_id' => $prod1->id,
            'sku_code' => 'PUSPA-OUT-SGE-ALL',
            'barcode' => '8991001001',
            'name' => 'PUSPA Floral Outer - Sage Green (All Size)',
            'color' => 'Sage Green',
            'size' => 'All Size',
            'price_idr' => 389000,
            'cost_idr' => 175000,
            'weight_grams' => 350,
            'image_url' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=800&q=80',
        ]);

        $sku1_terracotta_all = Sku::create([
            'product_id' => $prod1->id,
            'sku_code' => 'PUSPA-OUT-TRC-ALL',
            'barcode' => '8991001002',
            'name' => 'PUSPA Floral Outer - Terracotta (All Size)',
            'color' => 'Terracotta',
            'size' => 'All Size',
            'price_idr' => 389000,
            'cost_idr' => 175000,
            'weight_grams' => 350,
            'image_url' => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?w=800&q=80',
        ]);

        $prod2 = Product::create([
            'series_id' => $seriesPuspa->id,
            'name' => 'PUSPA Voal Printed Scarf 120x120',
            'slug' => 'puspa-voal-printed-scarf',
            'category' => 'scarf',
            'description' => 'Scarf hijab segiempat bermotif anggun dengan finishing lasercut rapi. Mudah dibentuk, tegak di dahi dan tidak kedap suara.',
            'material' => 'Voal Ultrafine Glow Premium',
            'care_instructions' => 'Cuci dengan sampo lembut, hindari memeras terlalu kencang.',
            'length_cm' => 120,
            'is_preorder' => false,
            'primary_image' => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=800&q=80',
            'gallery_images' => [
                'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=800&q=80',
            ],
            'is_active' => true,
        ]);

        $sku2_dusty_pink = Sku::create([
            'product_id' => $prod2->id,
            'sku_code' => 'PUSPA-SCF-DPK-120',
            'barcode' => '8991002001',
            'name' => 'PUSPA Scarf - Dusty Pink (120x120)',
            'color' => 'Dusty Pink',
            'size' => '120x120',
            'price_idr' => 149000,
            'cost_idr' => 60000,
            'weight_grams' => 120,
            'image_url' => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=800&q=80',
        ]);

        $sku2_olive = Sku::create([
            'product_id' => $prod2->id,
            'sku_code' => 'PUSPA-SCF-OLV-120',
            'barcode' => '8991002002',
            'name' => 'PUSPA Scarf - Olive Ash (120x120)',
            'color' => 'Olive Ash',
            'size' => '120x120',
            'price_idr' => 149000,
            'cost_idr' => 60000,
            'weight_grams' => 120,
            'image_url' => 'https://images.unsplash.com/photo-1601924994987-69e26d50dc26?w=800&q=80',
        ]);

        $prod3 = Product::create([
            'series_id' => $seriesIsla->id,
            'name' => 'ISLA Tiered Midi Dress',
            'slug' => 'isla-tiered-midi-dress',
            'category' => 'dress',
            'description' => 'Dress berpotongan A-line dengan aksen tingkat manis dan lengan karet wudhu-friendly. Nyaman dipakai seharian.',
            'material' => 'Pure Crinkle Airflow (Tanpa perlu disetrika)',
            'care_instructions' => 'Cuci mesin putaran lembut.',
            'length_cm' => 125,
            'is_preorder' => true,
            'preorder_lead_days' => 10,
            'primary_image' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=800&q=80',
            'gallery_images' => [
                'https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=800&q=80',
            ],
            'is_active' => true,
        ]);

        $sku3_isla_sm = Sku::create([
            'product_id' => $prod3->id,
            'sku_code' => 'ISLA-DRS-OAT-SM',
            'barcode' => '8991003001',
            'name' => 'ISLA Dress - Oat Milk (S/M)',
            'color' => 'Oat Milk',
            'size' => 'S/M',
            'price_idr' => 429000,
            'cost_idr' => 195000,
            'weight_grams' => 450,
            'image_url' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=800&q=80',
        ]);

        $sku3_isla_lxl = Sku::create([
            'product_id' => $prod3->id,
            'sku_code' => 'ISLA-DRS-OAT-LXL',
            'barcode' => '8991003002',
            'name' => 'ISLA Dress - Oat Milk (L/XL)',
            'color' => 'Oat Milk',
            'size' => 'L/XL',
            'price_idr' => 429000,
            'cost_idr' => 195000,
            'weight_grams' => 480,
            'image_url' => 'https://images.unsplash.com/photo-1496747611176-843222e1e57c?w=800&q=80',
        ]);

        $prod4 = Product::create([
            'series_id' => $seriesSept->id,
            'name' => 'Sept Drops Heritage Linen Trench Outer',
            'slug' => 'sept-drops-heritage-linen-trench',
            'category' => 'outerwear',
            'description' => 'Trench outer berstruktur kokoh dengan material linen rami ramah lingkungan. Dilengkapi sabuk serut untuk siluet ramping.',
            'material' => '100% Belgian Washed Linen',
            'care_instructions' => 'Dry clean direkomendasikan.',
            'length_cm' => 115,
            'is_preorder' => false,
            'primary_image' => 'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?w=800&q=80',
            'gallery_images' => [
                'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?w=800&q=80',
            ],
            'is_active' => true,
        ]);

        $sku4_sand_all = Sku::create([
            'product_id' => $prod4->id,
            'sku_code' => 'SEPT-TRN-SND-ALL',
            'barcode' => '8991004001',
            'name' => 'Sept Drops Trench - Sand Beige (All Size)',
            'color' => 'Sand Beige',
            'size' => 'All Size',
            'price_idr' => 549000,
            'cost_idr' => 240000,
            'weight_grams' => 550,
            'image_url' => 'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?w=800&q=80',
        ]);

        // 6. Inbound Stock & Initial Ledger Movements
        $batch = Batch::create([
            'batch_number' => 'BATCH-202611-01',
            'supplier_name' => 'Konveksi Hijab Mandiri Pekalongan',
            'notes' => 'Produksi rilis PUSPA dan restock ISLA',
            'received_at' => now()->subDays(5),
        ]);

        $inbound = Inbound::create([
            'inbound_number' => 'INB-202611-001',
            'batch_id' => $batch->id,
            'location_id' => $locPusat->id,
            'status' => 'completed',
            'notes' => 'Penerimaan QC lolos 100%',
            'created_by' => $warehouseStaff->id,
            'received_at' => now()->subDays(5),
        ]);

        $initialQuantities = [
            $sku1_sage_all->id => 45,
            $sku1_terracotta_all->id => 38,
            $sku2_dusty_pink->id => 80,
            $sku2_olive->id => 65,
            $sku3_isla_sm->id => 25,
            $sku3_isla_lxl->id => 4, // Intentionally low for reorder alert
            $sku4_sand_all->id => 20,
        ];

        $stockService = app(StockService::class);

        foreach ($initialQuantities as $skuId => $qty) {
            InboundItem::create([
                'inbound_id' => $inbound->id,
                'sku_id' => $skuId,
                'quantity' => $qty,
                'cost_idr' => 150000,
            ]);

            $stockService->recordMovement(
                $locPusat->id,
                $skuId,
                'INBOUND',
                $qty,
                'Inbound',
                $inbound->inbound_number,
                "Barang masuk batch {$batch->batch_number}",
                $warehouseStaff->id
            );
        }

        // 7. Customers with RFM profiles & Consents
        $c1 = Customer::create([
            'name' => 'Aulia Rahmawati',
            'email' => 'aulia.rahma@gmail.com',
            'phone' => '081122334455',
            'tags' => ['VIP', 'Scarf Lover', 'Surabaya'],
            'notes' => 'Pelanggan setia sejak 2021, suka warna pastel.',
        ]);

        Address::create([
            'customer_id' => $c1->id,
            'label' => 'Rumah Utama',
            'receiver_name' => 'Aulia Rahmawati',
            'phone' => '081122334455',
            'street_address' => 'Jl. Dharmahusada Indah Barat II No. 12',
            'subdistrict' => 'Gubeng',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'postal_code' => '60285',
            'is_default' => true,
        ]);

        Consent::create(['customer_id' => $c1->id, 'consent_type' => 'transactional_email', 'is_granted' => true, 'version' => 'v1.0']);
        Consent::create(['customer_id' => $c1->id, 'consent_type' => 'marketing_email', 'is_granted' => true, 'version' => 'v1.0']);

        $c2 = Customer::create([
            'name' => 'Citra Kirana Lestari',
            'email' => 'citra.kirana@yahoo.com',
            'phone' => '085711223344',
            'tags' => ['Outerwear Fan', 'Solo'],
            'notes' => 'Beli saat pop-up bazar di Solo.',
        ]);
        Consent::create(['customer_id' => $c2->id, 'consent_type' => 'transactional_email', 'is_granted' => true, 'version' => 'v1.0']);
        Consent::create(['customer_id' => $c2->id, 'consent_type' => 'marketing_email', 'is_granted' => true, 'version' => 'v1.0']);

        $c3 = Customer::create([
            'name' => 'Nadia Amanda Putri',
            'email' => 'nadia.putri@outlook.com',
            'phone' => '082199887766',
            'tags' => ['At Risk', 'High Spender'],
            'notes' => 'Pernah belanja Rp 1.5jt tahun lalu, sudah 120 hari belum order kembali.',
        ]);
        Consent::create(['customer_id' => $c3->id, 'consent_type' => 'transactional_email', 'is_granted' => true, 'version' => 'v1.0']);
        Consent::create(['customer_id' => $c3->id, 'consent_type' => 'marketing_email', 'is_granted' => true, 'version' => 'v1.0']);

        // 8. Sample Realistic Orders
        // Order 1: Completed paid order
        $ord1 = Order::create([
            'order_number' => 'ORD-20261110-001',
            'channel_id' => $chWeb->id,
            'customer_id' => $c1->id,
            'customer_name' => $c1->name,
            'customer_email' => $c1->email,
            'customer_phone' => $c1->phone,
            'shipping_address' => 'Jl. Dharmahusada Indah Barat II No. 12, Gubeng, Surabaya',
            'shipping_city' => 'Surabaya',
            'shipping_province' => 'Jawa Timur',
            'shipping_courier' => 'JNE',
            'shipping_service' => 'REG',
            'subtotal_idr' => 538000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 15000,
            'grand_total_idr' => 553000,
            'status' => 'delivered',
            'paid_at' => now()->subDays(4),
            'created_at' => now()->subDays(5),
        ]);

        OrderItem::create([
            'order_id' => $ord1->id,
            'sku_id' => $sku1_sage_all->id,
            'sku_code' => $sku1_sage_all->sku_code,
            'product_name' => $prod1->name,
            'variant_name' => 'Sage Green (All Size)',
            'unit_price_idr' => 389000,
            'cost_idr' => 175000,
            'quantity' => 1,
            'subtotal_idr' => 389000,
        ]);

        OrderItem::create([
            'order_id' => $ord1->id,
            'sku_id' => $sku2_dusty_pink->id,
            'sku_code' => $sku2_dusty_pink->sku_code,
            'product_name' => $prod2->name,
            'variant_name' => 'Dusty Pink',
            'unit_price_idr' => 149000,
            'cost_idr' => 60000,
            'quantity' => 1,
            'subtotal_idr' => 149000,
        ]);

        Payment::create([
            'order_id' => $ord1->id,
            'gateway' => 'midtrans',
            'transaction_id' => 'MID-TRANS-20261110-001',
            'payment_method' => 'qris',
            'amount_idr' => 553000,
            'status' => 'paid',
            'paid_at' => now()->subDays(4),
        ]);

        Shipment::create([
            'order_id' => $ord1->id,
            'courier_name' => 'JNE',
            'tracking_number' => 'JNE-SUB-99882211',
            'status' => 'delivered',
            'shipped_at' => now()->subDays(3),
            'delivered_at' => now()->subDays(1),
        ]);

        // Order 2: Picking in warehouse
        $ord2 = Order::create([
            'order_number' => 'ORD-20261115-002',
            'channel_id' => $chWeb->id,
            'customer_id' => $c2->id,
            'customer_name' => $c2->name,
            'customer_email' => $c2->email,
            'customer_phone' => $c2->phone,
            'shipping_address' => 'Jl. Slamet Riyadi No. 88, Solo',
            'shipping_city' => 'Surakarta',
            'shipping_province' => 'Jawa Tengah',
            'shipping_courier' => 'SiCepat',
            'shipping_service' => 'BEST',
            'subtotal_idr' => 389000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 18000,
            'grand_total_idr' => 407000,
            'status' => 'picking',
            'paid_at' => now()->subHours(2),
            'created_at' => now()->subHours(3),
        ]);

        OrderItem::create([
            'order_id' => $ord2->id,
            'sku_id' => $sku1_terracotta_all->id,
            'sku_code' => $sku1_terracotta_all->sku_code,
            'product_name' => $prod1->name,
            'variant_name' => 'Terracotta (All Size)',
            'unit_price_idr' => 389000,
            'cost_idr' => 175000,
            'quantity' => 1,
            'subtotal_idr' => 389000,
        ]);

        Payment::create([
            'order_id' => $ord2->id,
            'gateway' => 'midtrans',
            'transaction_id' => 'MID-TRANS-20261115-002',
            'payment_method' => 'bca_va',
            'amount_idr' => 407000,
            'status' => 'paid',
            'paid_at' => now()->subHours(2),
        ]);

        PickPack::create([
            'order_id' => $ord2->id,
            'status' => 'picking',
            'assigned_to' => $warehouseStaff->id,
        ]);

        // Order 3: An older order for customer 3 (to establish At Risk RFM score)
        $ord3 = Order::create([
            'order_number' => 'ORD-20260715-099',
            'channel_id' => $chWeb->id,
            'customer_id' => $c3->id,
            'customer_name' => $c3->name,
            'customer_email' => $c3->email,
            'customer_phone' => $c3->phone,
            'shipping_address' => 'Jl. Ijen No. 14, Malang',
            'shipping_city' => 'Malang',
            'shipping_province' => 'Jawa Timur',
            'shipping_courier' => 'JNE',
            'shipping_service' => 'REG',
            'subtotal_idr' => 1367000,
            'discount_idr' => 0,
            'shipping_cost_idr' => 15000,
            'grand_total_idr' => 1382000,
            'status' => 'completed',
            'paid_at' => now()->subDays(120),
            'created_at' => now()->subDays(120),
        ]);

        OrderItem::create([
            'order_id' => $ord3->id,
            'sku_id' => $sku4_sand_all->id,
            'sku_code' => $sku4_sand_all->sku_code,
            'product_name' => $prod4->name,
            'variant_name' => 'Sand Beige',
            'unit_price_idr' => 549000,
            'cost_idr' => 240000,
            'quantity' => 2,
            'subtotal_idr' => 1098000,
        ]);

        // 9. Vouchers
        Voucher::create([
            'code' => 'EVERYDAYFRIDAY',
            'name' => 'Diskon Sambutan Komunitas #everydayitsfriday',
            'discount_type' => 'percentage',
            'discount_amount' => 10,
            'min_purchase_idr' => 300000,
            'max_discount_idr' => 50000,
            'quota' => 200,
            'used_count' => 14,
            'is_active' => true,
        ]);

        Voucher::create([
            'code' => 'PUSPA50K',
            'name' => 'Voucher Eksklusif Seri PUSPA',
            'discount_type' => 'fixed',
            'discount_amount' => 50000,
            'min_purchase_idr' => 350000,
            'quota' => 100,
            'used_count' => 8,
            'is_active' => true,
        ]);

        // 10. Exclusive Drop
        $dropSept = Drop::create([
            'code' => 'SEPT-DROP-EXCLUSIVE',
            'title' => 'Sept Drops: Limited Outerwear Release',
            'description' => 'Rilisan terbatas mantel linen premium edisi September. Tersedia hanya 20 pcs nasional.',
            'banner_url' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=1200&q=80',
            'drop_time' => now()->subDays(2),
            'end_time' => now()->addDays(5),
            'is_active' => true,
        ]);

        DropItem::create([
            'drop_id' => $dropSept->id,
            'sku_id' => $sku4_sand_all->id,
            'drop_quota' => 20,
            'sold_count' => 2,
        ]);

        // 11. Sample Self-service Return Request
        $ret1 = ReturnRequest::create([
            'order_id' => $ord1->id,
            'customer_id' => $c1->id,
            'status' => 'submitted',
            'reason' => 'Tukar Ukuran / Ingin Varian Warna Berbeda',
            'notes' => 'Bahan kimono sangat bagus, namun saya ingin tukar warna ke Terracotta jika masih ada stok.',
            'photo_url' => 'https://images.unsplash.com/photo-1539109136881-3be0616acf4b?w=400&q=80',
        ]);

        ReturnItem::create([
            'return_request_id' => $ret1->id,
            'sku_id' => $sku1_sage_all->id,
            'quantity' => 1,
            'disposition' => 'pending',
        ]);

        // 12. Email Flows & Templates
        $tmplWelcome = EmailTemplate::create([
            'code' => 'TMPL_WELCOME',
            'subject' => 'Selamat datang di ITSFRIDAY — Cerita di Balik #everydayitsfriday',
            'preview_text' => 'Terima kasih telah bergabung di lingkaran keluarga ITSFRIDAY.',
            'body_html' => '<div style="font-family: sans-serif; max-width: 600px; margin: auto; padding: 24px; color: #2D3748;">
                <h2 style="color: #1A202C;">Halo {{ customer_name }},</h2>
                <p>Selamat datang di <strong>ITSFRIDAY</strong>. Bagi kami, rasa nyaman, percaya diri, dan kehangatan akhir pekan seharusnya bisa Anda rasakan setiap hari (#everydayitsfriday).</p>
                <p>Nikmati voucher sambutan 10% dengan kode: <strong style="background: #EDF2F7; padding: 4px 8px; border-radius: 4px;">EVERYDAYFRIDAY</strong></p>
                <p>Salam hangat,<br><strong>Tim ITSFRIDAY</strong></p>
            </div>',
            'is_active' => true,
        ]);

        $tmplPostPurchase = EmailTemplate::create([
            'code' => 'TMPL_POST_PURCHASE',
            'subject' => 'Panduan Perawatan dan Styling Produk ITSFRIDAY Anda',
            'preview_text' => 'Tips agar kain rayon twill dan voal Anda tetap selembut hari pertama.',
            'body_html' => '<div style="font-family: sans-serif; max-width: 600px; margin: auto; padding: 24px;">
                <h2>Terima kasih atas pesanan Anda!</h2>
                <p>Kami harap produk ITSFRIDAY melengkapi hari-hari Anda dengan sempurna.</p>
                <p>Ingat untuk mencuci dengan air dingin dan hindari penjemuran langsung di bawah terik matahari agar warna tetap awet.</p>
            </div>',
            'is_active' => true,
        ]);

        $flowWelcome = Flow::create([
            'code' => 'welcome',
            'name' => 'Welcome Series (Pelanggan Baru)',
            'trigger_event' => 'customer.registered',
            'delay_hours' => 0,
            'requires_approval' => false,
            'is_active' => true,
        ]);

        $flowPostPurchase = Flow::create([
            'code' => 'post_purchase',
            'name' => 'Post-Purchase Care & Styling Tips',
            'trigger_event' => 'order.paid',
            'delay_hours' => 24,
            'requires_approval' => false,
            'is_active' => true,
        ]);

        $flowWinBack = Flow::create([
            'code' => 'win_back',
            'name' => 'Win-Back Personal Touch (Pelanggan Lama)',
            'trigger_event' => 'rfm.at_risk',
            'delay_hours' => 0,
            'requires_approval' => true, // Owner approval required as per PRD
            'is_active' => true,
        ]);

        // Sample pending flow run awaiting owner approval
        FlowRun::create([
            'flow_id' => $flowWinBack->id,
            'customer_id' => $c3->id,
            'reference_type' => 'Customer',
            'reference_id' => $c3->id,
            'status' => 'pending_approval',
            'scheduled_for' => now()->addDay(),
        ]);

        // 13. Loyalty Ledger (Sample points for Aulia)
        LoyaltyLedger::create([
            'customer_id' => $c1->id,
            'points' => 55,
            'transaction_type' => 'EARN_PURCHASE',
            'reference_id' => $ord1->order_number,
            'notes' => "Poin transaksi order #{$ord1->order_number}",
            'created_at' => now()->subDays(4),
        ]);

        // 14. Affiliate
        Affiliate::create([
            'code' => 'AULIAFRIDAY',
            'customer_id' => $c1->id,
            'name' => 'Aulia Rahmawati (Creator)',
            'email' => $c1->email,
            'bank_name' => 'BCA',
            'bank_account_number' => '8290123456',
            'bank_account_holder' => 'Aulia Rahmawati',
            'commission_rate' => 10.00,
            'total_commission_idr' => 55300,
            'total_paid_idr' => 0,
            'is_active' => true,
        ]);

        // 15. Recalculate RFM for all customers
        app(\App\Modules\Crm\Services\RfmService::class)->recalculate();

        // 16. Generate Daily Decision Queue for Owner
        app(\App\Modules\Crm\Services\ActionItemService::class)->generateDailyDecisions();
    }
}
