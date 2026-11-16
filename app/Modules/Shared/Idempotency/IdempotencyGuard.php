<?php

namespace App\Modules\Shared\Idempotency;

use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;

class IdempotencyGuard
{
    /**
     * Executes the callback only once for a given idempotency key atomically.
     * Prevents double-processing of payment webhooks or orders.
     */
    public static function run(string $key, callable $callback, int $ttlSeconds = 86400)
    {
        $trimmedKey = trim($key);
        if ($trimmedKey === '') {
            throw new InvalidArgumentException('Idempotency key cannot be empty.');
        }

        $cacheKey = "idempotency:{$trimmedKey}";

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Acquire an atomic lock to prevent race conditions
        $lock = Cache::lock("lock:{$cacheKey}", 15);

        return $lock->block(10, function () use ($cacheKey, $callback, $ttlSeconds) {
            // Re-check after acquiring the lock (double-checked locking)
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }

            $result = $callback();
            Cache::put($cacheKey, $result ?? true, $ttlSeconds);

            return $result;
        });
    }

    public static function exists(string $key): bool
    {
        $trimmedKey = trim($key);
        if ($trimmedKey === '') {
            return false;
        }

        return Cache::has("idempotency:{$trimmedKey}");
    }
}
