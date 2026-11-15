<?php

namespace App\Modules\Shared\Idempotency;

use Illuminate\Support\Facades\Cache;

class IdempotencyGuard
{
    /**
     * Executes the callback only once for a given idempotency key.
     * Prevents double-processing of payment webhooks or orders.
     */
    public static function run(string $key, callable $callback, int $ttlSeconds = 86400)
    {
        $cacheKey = "idempotency:{$key}";

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $result = $callback();
        Cache::put($cacheKey, $result ?? true, $ttlSeconds);

        return $result;
    }

    public static function exists(string $key): bool
    {
        return Cache::has("idempotency:{$key}");
    }
}

