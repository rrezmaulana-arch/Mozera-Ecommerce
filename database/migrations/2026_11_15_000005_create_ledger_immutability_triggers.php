<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            // Prevent UPDATE and DELETE on stock_movements
            DB::unprepared("
                CREATE TRIGGER IF NOT EXISTS prevent_update_stock_movements
                BEFORE UPDATE ON stock_movements
                BEGIN
                    SELECT RAISE(FAIL, 'STOCK_MOVEMENT_IMMUTABLE: Ledger entries cannot be updated.');
                END;
            ");
            DB::unprepared("
                CREATE TRIGGER IF NOT EXISTS prevent_delete_stock_movements
                BEFORE DELETE ON stock_movements
                BEGIN
                    SELECT RAISE(FAIL, 'STOCK_MOVEMENT_IMMUTABLE: Ledger entries cannot be deleted.');
                END;
            ");

            // Prevent UPDATE and DELETE on loyalty_ledgers
            DB::unprepared("
                CREATE TRIGGER IF NOT EXISTS prevent_update_loyalty_ledgers
                BEFORE UPDATE ON loyalty_ledgers
                BEGIN
                    SELECT RAISE(FAIL, 'LOYALTY_LEDGER_IMMUTABLE: Points ledger cannot be updated.');
                END;
            ");
            DB::unprepared("
                CREATE TRIGGER IF NOT EXISTS prevent_delete_loyalty_ledgers
                BEFORE DELETE ON loyalty_ledgers
                BEGIN
                    SELECT RAISE(FAIL, 'LOYALTY_LEDGER_IMMUTABLE: Points ledger cannot be deleted.');
                END;
            ");

            // Prevent UPDATE and DELETE on audit_logs
            DB::unprepared("
                CREATE TRIGGER IF NOT EXISTS prevent_update_audit_logs
                BEFORE UPDATE ON audit_logs
                BEGIN
                    SELECT RAISE(FAIL, 'AUDIT_LOG_IMMUTABLE: Audit trail cannot be updated.');
                END;
            ");
            DB::unprepared("
                CREATE TRIGGER IF NOT EXISTS prevent_delete_audit_logs
                BEFORE DELETE ON audit_logs
                BEGIN
                    SELECT RAISE(FAIL, 'AUDIT_LOG_IMMUTABLE: Audit trail cannot be deleted.');
                END;
            ");
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            DB::unprepared("DROP TRIGGER IF EXISTS prevent_update_stock_movements;");
            DB::unprepared("DROP TRIGGER IF EXISTS prevent_delete_stock_movements;");
            DB::unprepared("DROP TRIGGER IF EXISTS prevent_update_loyalty_ledgers;");
            DB::unprepared("DROP TRIGGER IF EXISTS prevent_delete_loyalty_ledgers;");
            DB::unprepared("DROP TRIGGER IF EXISTS prevent_update_audit_logs;");
            DB::unprepared("DROP TRIGGER IF EXISTS prevent_delete_audit_logs;");
        }
    }
};

