<?php

// 1. Setup temporary writable directories for Vercel Serverless
$tmpDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/database',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// 2. Salin SQLite database yang sudah ter-seed jika belum ada di /tmp
$sourceDb = __DIR__ . '/../database/database.sqlite';
$targetDb = '/tmp/database/database.sqlite';

if (file_exists($sourceDb) && !file_exists($targetDb)) {
    @copy($sourceDb, $targetDb);
}

// 3. Fallback Environment Variables jika tidak diset manual di dashboard Vercel
$defaults = [
    'APP_NAME' => 'MOZERA',
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'APP_KEY' => 'base64:PNzL/zrGxhyw4DiwrQRpHcUEVgMC+dP76O7jSegFVwg=',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => file_exists($targetDb) ? $targetDb : (file_exists($sourceDb) ? $sourceDb : ':memory:'),
    'SESSION_DRIVER' => 'cookie',
    'CACHE_STORE' => 'array',
    'LOG_CHANNEL' => 'stderr',
    'MIDTRANS_SERVER_KEY' => 'SB-Mid-server-eo.sjNayLVRo2KybEvLn04Ak',
    'MIDTRANS_CLIENT_KEY' => 'Mid-client-BCH8_jCEDMoRbr2a',
    'MIDTRANS_IS_PRODUCTION' => 'false',
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
    'APP_STORAGE' => '/tmp/storage',
];

foreach ($defaults as $k => $v) {
    if (!getenv($k) && !isset($_ENV[$k])) {
        putenv("{$k}={$v}");
        $_ENV[$k] = $v;
        $_SERVER[$k] = $v;
    }
}

require __DIR__ . '/../public/index.php';
