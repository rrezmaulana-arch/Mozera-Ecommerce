<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Locations (Gudang Pusat, Bazar Surabaya, Bazar Solo, Bazar Malang)
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique(); // PUSAT, BAZAR_SBY, BAZAR_SOLO, BAZAR_MLG
            $table->string('name', 100);
            $table->string('type', 30)->default('warehouse'); // warehouse, popup_store, transit
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Stock Movement Ledger (Append-only immutable audit trail)
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('sku_id')->constrained();
            $table->string('movement_type', 30);
            // INBOUND, RESERVE, RELEASE, PICK_OUT, RETURN_IN, TRANSFER_OUT, TRANSFER_IN, ADJUST, OPNAME_ADJUST
            $table->integer('quantity'); // Positive for additions/in, negative for subtractions/out
            $table->string('reference_type', 50)->nullable(); // Order, Inbound, Return, Stocktake, Manual
            $table->string('reference_id', 100)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['sku_id', 'location_id']);
            $table->index('movement_type');
            $table->index('created_at');
        });

        // Stock Balance (Cached read model derived from ledger)
        Schema::create('stock_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('sku_id')->constrained();
            $table->integer('physical_qty')->default(0);
            $table->integer('reserved_qty')->default(0);
            $table->integer('available_qty')->default(0); // physical - reserved
            $table->timestamps();

            $table->unique(['location_id', 'sku_id']);
        });

        // Stock Reservations (Atomic lock during checkout)
        Schema::create('stock_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained();
            $table->unsignedInteger('quantity');
            $table->string('status', 20)->default('active'); // active, fulfilled, released
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->index(['status', 'expires_at']);
        });

        // Batches (Production batches / Tailor lots)
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number', 60)->unique();
            $table->string('supplier_name', 150)->nullable(); // Penjahit / Konveksi
            $table->text('notes')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamps();
        });

        // Inbounds (Goods Receipt)
        Schema::create('inbounds', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->string('inbound_number', 60)->unique();
            $table->foreignId('batch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('location_id')->constrained();
            $table->string('status', 30)->default('completed'); // draft, completed
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('received_at')->useCurrent();
            $table->timestamps();
        });

        // Inbound Items
        Schema::create('inbound_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inbound_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained();
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('cost_idr')->default(0); // Unit cost
            $table->timestamps();
        });

        // Pick & Pack Operations
        Schema::create('pick_packs', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 30)->default('pending'); // pending, picking, packed
            $table->timestamp('picked_at')->nullable();
            $table->timestamp('packed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('status');
        });

        // Pick Scans (Audit of scanned barcodes during picking/packing)
        Schema::create('pick_scans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pick_pack_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained();
            $table->string('barcode_scanned', 100);
            $table->timestamp('scanned_at')->useCurrent();
        });

        // Stocktakes (Stock Opname)
        Schema::create('stocktakes', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->string('code', 50)->unique();
            $table->foreignId('location_id')->constrained();
            $table->string('status', 30)->default('draft'); // draft, in_progress, completed
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        // Stocktake Lines
        Schema::create('stocktake_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stocktake_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained();
            $table->integer('expected_qty')->default(0);
            $table->integer('counted_qty')->default(0);
            $table->integer('difference_qty')->default(0); // counted - expected
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['stocktake_id', 'sku_id']);
        });

        // Channel Stock Quota (Jatah stok per kanal)
        Schema::create('channel_quotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('allocated_qty')->default(0);
            $table->timestamps();

            $table->unique(['channel_id', 'sku_id']);
        });

        // SKU Mapping (Marketplace SKU to Internal SKU)
        Schema::create('sku_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->constrained()->cascadeOnDelete();
            $table->string('external_sku', 100);
            $table->foreignId('internal_sku_id')->constrained('skus')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['channel_id', 'external_sku']);
        });

        // Marketplace Import Logs
        Schema::create('marketplace_imports', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('channel_id')->constrained();
            $table->string('filename', 255);
            $table->unsignedInteger('total_rows')->default(0);
            $table->unsignedInteger('success_rows')->default(0);
            $table->unsignedInteger('duplicate_rows')->default(0);
            $table->unsignedInteger('error_rows')->default(0);
            $table->string('status', 30)->default('completed'); // pending, processing, completed, failed
            $table->json('logs')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // Purchase Orders (Draft PO from Reorder Planner)
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->string('po_number', 60)->unique();
            $table->string('supplier_name', 150);
            $table->string('status', 30)->default('draft'); // draft, submitted, received, cancelled
            $table->unsignedBigInteger('total_cost_idr')->default(0);
            $table->date('expected_arrival_date')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // Purchase Order Items
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained();
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('cost_idr')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
        Schema::dropIfExists('purchase_orders');
        Schema::dropIfExists('marketplace_imports');
        Schema::dropIfExists('sku_mappings');
        Schema::dropIfExists('channel_quotas');
        Schema::dropIfExists('stocktake_lines');
        Schema::dropIfExists('stocktakes');
        Schema::dropIfExists('pick_scans');
        Schema::dropIfExists('pick_packs');
        Schema::dropIfExists('inbound_items');
        Schema::dropIfExists('inbounds');
        Schema::dropIfExists('batches');
        Schema::dropIfExists('stock_reservations');
        Schema::dropIfExists('stock_balances');
        Schema::dropIfExists('stock_movements');
        Schema::dropIfExists('locations');
    }
};

