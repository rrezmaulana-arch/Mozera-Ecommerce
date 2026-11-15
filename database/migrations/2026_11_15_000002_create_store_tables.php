<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Carts
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 100)->index();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        // Cart Items
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();

            $table->unique(['cart_id', 'sku_id']);
        });

        // Vouchers
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 150);
            $table->string('discount_type', 20)->default('fixed'); // fixed, percentage
            $table->unsignedBigInteger('discount_amount'); // Rupiah or percentage value
            $table->unsignedBigInteger('min_purchase_idr')->default(0);
            $table->unsignedBigInteger('max_discount_idr')->nullable();
            $table->unsignedInteger('quota')->nullable();
            $table->unsignedInteger('used_count')->default(0);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Voucher Redemptions
        Schema::create('voucher_redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voucher_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('discount_idr');
            $table->timestamps();

            $table->unique(['voucher_id', 'order_id']);
        });

        // Product Drops (Exclusive collection drops)
        Schema::create('drops', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->string('code', 50)->unique(); // e.g. DROP-SEPT-2026
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->string('banner_url')->nullable();
            $table->timestamp('drop_time');
            $table->timestamp('end_time')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Drop Items (with specific allocated quota per SKU)
        Schema::create('drop_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drop_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('drop_quota')->default(0);
            $table->unsignedInteger('sold_count')->default(0);
            $table->timestamps();

            $table->unique(['drop_id', 'sku_id']);
        });

        // Waitlist Entries
        Schema::create('waitlist_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drop_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sku_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 30)->nullable();
            $table->boolean('consent_given')->default(true);
            $table->timestamp('notified_at')->nullable();
            $table->timestamps();

            $table->index(['sku_id', 'email']);
        });

        // Self-service Return Requests
        Schema::create('return_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status', 30)->default('submitted');
            // submitted, approved, received_quarantine, inspected_passed, inspected_rejected, completed, cancelled
            $table->string('reason', 100); // size_mismatch, damaged, defective, wrong_item
            $table->text('notes')->nullable();
            $table->string('photo_url')->nullable();
            $table->text('admin_notes')->nullable();
            $table->string('return_tracking_number', 100)->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });

        // Return Items
        Schema::create('return_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->string('disposition', 30)->default('pending'); // pending, restocked, defective_quarantine, discarded
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('return_items');
        Schema::dropIfExists('return_requests');
        Schema::dropIfExists('waitlist_entries');
        Schema::dropIfExists('drop_items');
        Schema::dropIfExists('drops');
        Schema::dropIfExists('voucher_redemptions');
        Schema::dropIfExists('vouchers');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};

