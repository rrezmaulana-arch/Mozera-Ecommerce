<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add ULID, role, phone, and is_active to users
        Schema::table('users', function (Blueprint $table) {
            $table->string('ulid', 26)->nullable()->unique()->after('id');
            $table->string('role', 30)->default('store_admin')->after('email'); // owner, store_admin, warehouse_staff, crm_marketer
            $table->string('phone', 30)->nullable()->after('role');
            $table->boolean('is_active')->default(true)->after('phone');
        });

        // Channels (web, shopee, tiktok, bazar, reseller)
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Customers
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 30)->nullable()->index();
            $table->json('tags')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Customer Identities (link external marketplace accounts to customer)
        Schema::create('customer_identities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('channel_code', 50); // shopee, tiktok, web
            $table->string('external_id', 150);
            $table->string('identifier_value', 150)->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->unique(['channel_code', 'external_id']);
        });

        // Customer Addresses
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('label', 50)->default('Rumah');
            $table->string('receiver_name');
            $table->string('phone', 30);
            $table->text('street_address');
            $table->string('subdistrict', 100)->nullable();
            $table->string('city', 100);
            $table->string('province', 100);
            $table->string('postal_code', 10);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        // Series (PUSPA, ISLA, Sept Drops, etc.)
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->string('code', 50)->unique();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->string('banner_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('series_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category', 50)->default('outerwear'); // outerwear, scarf, dress, bundle
            $table->text('description')->nullable();
            $table->string('material')->nullable(); // e.g. Premium Linen, Rayon Twill, Voal Ultrafine
            $table->text('care_instructions')->nullable();
            $table->unsignedInteger('length_cm')->nullable(); // Used for Fit Helper
            $table->boolean('is_preorder')->default(false);
            $table->unsignedInteger('preorder_lead_days')->default(0);
            $table->string('primary_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // SKUs (Product Variants: size, color, barcode)
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku_code', 60)->unique();
            $table->string('barcode', 60)->nullable()->unique();
            $table->string('name');
            $table->string('color', 60)->nullable();
            $table->string('size', 30)->nullable(); // All Size, S, M, L, XL
            $table->unsignedBigInteger('price_idr'); // Integer Rupiah
            $table->unsignedBigInteger('cost_idr')->default(0); // HPP
            $table->unsignedInteger('weight_grams')->default(300);
            $table->string('image_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->string('order_number', 50); // e.g. ORD-20261115-001
            $table->foreignId('channel_id')->constrained();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 30)->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('shipping_city', 100)->nullable();
            $table->string('shipping_province', 100)->nullable();
            $table->string('shipping_courier', 50)->nullable(); // JNE, SiCepat, J&T
            $table->string('shipping_service', 50)->nullable(); // REG, YES, Cargo
            $table->unsignedBigInteger('subtotal_idr')->default(0);
            $table->unsignedBigInteger('discount_idr')->default(0);
            $table->unsignedBigInteger('shipping_cost_idr')->default(0);
            $table->unsignedBigInteger('grand_total_idr')->default(0);
            $table->string('status', 30)->default('pending_payment');
            // pending_payment, paid, picking, packed, shipped, delivered, completed, cancelled, refunded
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();

            $table->unique(['channel_id', 'order_number']);
            $table->index('status');
            $table->index('created_at');
        });

        // Order Items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->nullable()->constrained()->nullOnDelete();
            $table->string('sku_code', 60);
            $table->string('product_name');
            $table->string('variant_name')->nullable();
            $table->unsignedBigInteger('unit_price_idr');
            $table->unsignedBigInteger('cost_idr')->default(0);
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('subtotal_idr');
            $table->timestamps();
        });

        // Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('gateway', 50)->default('midtrans'); // midtrans, xendit, manual
            $table->string('transaction_id', 150)->nullable()->unique();
            $table->string('payment_method', 50)->nullable(); // qris, bca_va, mandiri_va, cc
            $table->unsignedBigInteger('amount_idr');
            $table->string('status', 30)->default('pending'); // pending, paid, expired, failed
            $table->string('idempotency_key', 100)->nullable()->unique();
            $table->json('payload')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });

        // Shipments
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('courier_name', 50);
            $table->string('tracking_number', 100)->index(); // Resi
            $table->string('status', 30)->default('label_created'); // label_created, in_transit, delivered
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });

        // Domain Events Outbox
        Schema::create('domain_events', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->string('event_name', 100)->index();
            $table->json('payload');
            $table->string('status', 30)->default('pending'); // pending, processed, failed
            $table->unsignedInteger('attempts')->default(0);
            $table->text('error_message')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });

        // Audit Logs (Immutable)
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action', 100);
            $table->string('entity_type', 100);
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['entity_type', 'entity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('domain_events');
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('skus');
        Schema::dropIfExists('products');
        Schema::dropIfExists('series');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('customer_identities');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('channels');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['ulid', 'role', 'phone', 'is_active']);
        });
    }
};

