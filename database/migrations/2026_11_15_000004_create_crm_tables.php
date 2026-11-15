<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Consents (Per-purpose opt-in/opt-out with versioning & audit trail)
        Schema::create('consents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('consent_type', 50); // transactional_email, marketing_email, whatsapp_notif
            $table->boolean('is_granted')->default(false);
            $table->string('version', 20)->default('v1.0');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('updated_at')->useCurrent();

            $table->unique(['customer_id', 'consent_type']);
        });

        // 1st Party Event Logs (Customer journey events)
        Schema::create('event_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('session_id', 100)->index();
            $table->string('event_type', 50); // page_view, product_view, add_to_cart, start_checkout, purchase
            $table->json('metadata')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['event_type', 'created_at']);
        });

        // Customer Metrics (RFM & Customer Rhythm)
        Schema::create('customer_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->unique()->constrained()->cascadeOnDelete();
            $table->unsignedInteger('recency_days')->default(0);
            $table->unsignedInteger('frequency_count')->default(0);
            $table->unsignedBigInteger('monetary_total_idr')->default(0);
            $table->unsignedTinyInteger('r_score')->default(1); // 1-5
            $table->unsignedTinyInteger('f_score')->default(1); // 1-5
            $table->unsignedTinyInteger('m_score')->default(1); // 1-5
            $table->string('segment', 50)->default('new');
            // champions, loyal, potential, at_risk, hibernating, lost, new
            $table->unsignedInteger('rhythm_days')->nullable(); // Average days between purchases
            $table->date('predicted_next_purchase')->nullable();
            $table->timestamp('last_calculated_at')->useCurrent();
            $table->timestamps();

            $table->index('segment');
        });

        // Segments
        Schema::create('segments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->json('criteria')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Segment Members
        Schema::create('segment_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('segment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->timestamp('added_at')->useCurrent();

            $table->unique(['segment_id', 'customer_id']);
        });

        // Marketing Flows (Automated Email Campaigns)
        Schema::create('flows', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            // welcome, post_purchase, abandoned_cart, win_back, waitlist_drop
            $table->string('name', 100);
            $table->string('trigger_event', 60);
            $table->unsignedInteger('delay_hours')->default(0);
            $table->boolean('requires_approval')->default(false); // PRD: Owner approval queue
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Email Templates
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('subject', 200);
            $table->text('preview_text')->nullable();
            $table->longText('body_html');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Flow Runs (Instance of a flow executing for a customer)
        Schema::create('flow_runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flow_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('reference_type', 50)->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('status', 30)->default('scheduled');
            // scheduled, pending_approval, approved, rejected, sent, cancelled
            $table->timestamp('scheduled_for');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'scheduled_for']);
        });

        // Messages Sent / Pending
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('flow_run_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('template_id')->nullable()->constrained('email_templates')->nullOnDelete();
            $table->string('channel', 30)->default('email');
            $table->string('recipient', 150);
            $table->string('subject', 200);
            $table->longText('body_html');
            $table->string('status', 30)->default('draft'); // draft, pending_approval, sent, failed
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });

        // Message Events (Delivered, Opened, Clicked, Bounced)
        Schema::create('message_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained()->cascadeOnDelete();
            $table->string('event_type', 30); // sent, delivered, opened, clicked, bounced
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('occurred_at')->useCurrent();
        });

        // Loyalty Points Ledger (Append-only immutable points ledger)
        Schema::create('loyalty_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->integer('points'); // Positive for earn, negative for redeem
            $table->string('transaction_type', 40); // EARN_PURCHASE, REDEEM_ORDER, MANUAL_ADJUST, EXPIRE
            $table->string('reference_id', 100)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();

            $table->index('customer_id');
            $table->index('transaction_type');
        });

        // Affiliates (Influencers & Community partners)
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name', 150);
            $table->string('email', 150);
            $table->string('bank_name', 50)->nullable();
            $table->string('bank_account_number', 50)->nullable();
            $table->string('bank_account_holder', 100)->nullable();
            $table->decimal('commission_rate', 5, 2)->default(10.00); // 10%
            $table->unsignedBigInteger('total_commission_idr')->default(0);
            $table->unsignedBigInteger('total_paid_idr')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Referrals (Orders attributed to affiliate)
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('order_total_idr');
            $table->unsignedBigInteger('commission_amount_idr');
            $table->string('status', 30)->default('pending'); // pending, approved, paid
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->unique('order_id');
        });

        // Action Items (Daily Decisions Queue for Owner / Management)
        Schema::create('action_items', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->string('category', 40);
            // REORDER_LOW_STOCK, PENDING_RETURN, FLOW_APPROVAL, WIN_BACK_OPPORTUNITY, ANOMALY
            $table->string('priority', 20)->default('medium'); // high, medium, low
            $table->string('title', 200);
            $table->text('description');
            $table->string('action_url')->nullable();
            $table->string('status', 30)->default('pending'); // pending, resolved, dismissed
            $table->timestamp('resolved_at')->nullable();
            $table->foreignId('resolved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['status', 'priority']);
        });

        // Data Subject Rights (DSR / UU PDP Compliance)
        Schema::create('dsr_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->unique();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('request_type', 30); // export_data, rectify_data, erase_data
            $table->string('status', 30)->default('submitted'); // submitted, processing, completed, rejected
            $table->text('reason')->nullable();
            $table->string('result_url')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dsr_requests');
        Schema::dropIfExists('action_items');
        Schema::dropIfExists('referrals');
        Schema::dropIfExists('affiliates');
        Schema::dropIfExists('loyalty_ledgers');
        Schema::dropIfExists('message_events');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('flow_runs');
        Schema::dropIfExists('email_templates');
        Schema::dropIfExists('flows');
        Schema::dropIfExists('segment_members');
        Schema::dropIfExists('segments');
        Schema::dropIfExists('customer_metrics');
        Schema::dropIfExists('event_logs');
        Schema::dropIfExists('consents');
    }
};

