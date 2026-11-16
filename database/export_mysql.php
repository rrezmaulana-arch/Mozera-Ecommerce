<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Generating MySQL Dump from current database...\n";

$tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
$tableNames = array_map(fn($t) => $t->name, $tables);

$sqlDump = "-- ==========================================================\n";
$sqlDump .= "-- MOZÉRA (ITSFRIDAY) E-Commerce & WMS Database Dump\n";
$sqlDump .= "-- Compatible with MySQL 5.7 / 8.0+ and phpMyAdmin\n";
$sqlDump .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
$sqlDump .= "-- ==========================================================\n\n";
$sqlDump .= "SET FOREIGN_KEY_CHECKS=0;\n";
$sqlDump .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
$sqlDump .= "START TRANSACTION;\n";
$sqlDump .= "SET time_zone = \"+07:00\";\n\n";

// Table order to avoid foreign key errors when importing
$priorityOrder = [
    'users',
    'password_reset_tokens',
    'sessions',
    'cache',
    'cache_locks',
    'jobs',
    'job_batches',
    'failed_jobs',
    'channels',
    'customers',
    'series',
    'products',
    'skus',
    'locations',
    'orders',
    'order_items',
    'payments',
    'carts',
    'cart_items',
    'vouchers',
    'voucher_redemptions',
    'drops',
    'stock_balances',
    'stock_movements',
    'pick_lists',
    'pick_list_items',
    'returns',
    'consents',
    'customer_segments',
    'loyalty_points',
    'domain_events',
    'idempotency_keys',
    'migrations',
];

$orderedTables = [];
foreach ($priorityOrder as $t) {
    if (in_array($t, $tableNames)) {
        $orderedTables[] = $t;
    }
}
foreach ($tableNames as $t) {
    if (!in_array($t, $orderedTables)) {
        $orderedTables[] = $t;
    }
}

foreach ($orderedTables as $table) {
    $columns = DB::select("PRAGMA table_info('{$table}')");
    if (empty($columns)) continue;

    $sqlDump .= "-- --------------------------------------------------------\n";
    $sqlDump .= "-- Table structure for table `{$table}`\n";
    $sqlDump .= "-- --------------------------------------------------------\n";
    $sqlDump .= "DROP TABLE IF EXISTS `{$table}`;\n";
    $sqlDump .= "CREATE TABLE `{$table}` (\n";

    $colDefs = [];
    $primaryKeys = [];

    foreach ($columns as $col) {
        $name = $col->name;
        $type = strtoupper($col->type);
        $notNull = $col->notnull ? 'NOT NULL' : 'NULL';
        $default = $col->dflt_value !== null ? "DEFAULT " . $col->dflt_value : ($col->notnull ? '' : 'DEFAULT NULL');

        // Convert SQLite types to MySQL types
        if ($name === 'id') {
            $myType = "bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT";
            $colDefs[] = "  `{$name}` {$myType}";
            $primaryKeys[] = "`{$name}`";
            continue;
        }

        if (str_contains($type, 'INT')) {
            $myType = "bigint(20)";
        } elseif (str_contains($type, 'VARCHAR') || str_contains($type, 'CHAR')) {
            $myType = "varchar(255)";
        } elseif (str_contains($type, 'TEXT')) {
            $myType = "text";
        } elseif (str_contains($type, 'DECIMAL') || str_contains($type, 'NUMERIC')) {
            $myType = "decimal(14,2)";
        } elseif (str_contains($type, 'DATETIME') || str_contains($type, 'TIMESTAMP')) {
            $myType = "timestamp";
            if ($default === "DEFAULT CURRENT_TIMESTAMP") {
                $default = "DEFAULT CURRENT_TIMESTAMP";
            }
        } elseif (str_contains($type, 'BOOLEAN')) {
            $myType = "tinyint(1)";
        } else {
            $myType = "varchar(255)";
        }

        $line = "  `{$name}` {$myType} {$notNull}";
        if ($default !== '') {
            $line .= " {$default}";
        }
        $colDefs[] = $line;

        if ($col->pk && $name !== 'id') {
            $primaryKeys[] = "`{$name}`";
        }
    }

    if (!empty($primaryKeys)) {
        $colDefs[] = "  PRIMARY KEY (" . implode(', ', $primaryKeys) . ")";
    }

    $sqlDump .= implode(",\n", $colDefs);
    $sqlDump .= "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";

    // Dump Data
    $rows = DB::table($table)->get();
    if ($rows->count() > 0) {
        $sqlDump .= "-- Dumping data for table `{$table}`\n";
        $insertHeaders = array_keys((array) $rows->first());
        $colNamesList = implode('`, `', $insertHeaders);

        foreach ($rows->chunk(50) as $chunk) {
            $sqlDump .= "INSERT INTO `{$table}` (`{$colNamesList}`) VALUES\n";
            $valRows = [];
            foreach ($chunk as $row) {
                $vals = [];
                foreach ((array) $row as $val) {
                    if ($val === null) {
                        $vals[] = "NULL";
                    } elseif (is_numeric($val) && !is_string($val)) {
                        $vals[] = $val;
                    } else {
                        $escaped = str_replace(
                            ["\\", "\x00", "\n", "\r", "'", '"', "\x1a"],
                            ["\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z"],
                            (string) $val
                        );
                        $vals[] = "'{$escaped}'";
                    }
                }
                $valRows[] = "(" . implode(', ', $vals) . ")";
            }
            $sqlDump .= implode(",\n", $valRows) . ";\n";
        }
        $sqlDump .= "\n";
    }
}

$sqlDump .= "SET FOREIGN_KEY_CHECKS=1;\n";
$sqlDump .= "COMMIT;\n";

$targetPath = __DIR__ . '/mozera_database_mysql.sql';
file_put_contents($targetPath, $sqlDump);

$publicPath = __DIR__ . '/../public/mozera_database_mysql.sql';
file_put_contents($publicPath, $sqlDump);

echo "Successfully exported " . count($orderedTables) . " tables to:\n";
echo "- {$targetPath} (" . round(strlen($sqlDump) / 1024, 1) . " KB)\n";
echo "- {$publicPath}\n";
