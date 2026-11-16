<?php

namespace App\Modules\Shared\Outbox;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DomainEventDispatcher
{
    protected static array $handlers = [];

    public static function register(string $eventName, callable $handler, ?string $key = null): void
    {
        if ($key !== null) {
            static::$handlers[$eventName][$key] = $handler;
        } else {
            static::$handlers[$eventName][] = $handler;
        }
    }

    public static function flushHandlers(): void
    {
        static::$handlers = [];
    }

    public static function publish(string $eventName, array $payload): void
    {
        $ulid = (string) Str::ulid();

        // 1. Record to Outbox table
        $eventId = DB::table('domain_events')->insertGetId([
            'ulid' => $ulid,
            'event_name' => $eventName,
            'payload' => json_encode($payload),
            'status' => 'pending',
            'attempts' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Dispatch to registered listeners
        try {
            if (isset(static::$handlers[$eventName])) {
                foreach (static::$handlers[$eventName] as $handler) {
                    $handler($payload, $ulid);
                }
            }

            DB::table('domain_events')->where('id', $eventId)->update([
                'status' => 'processed',
                'processed_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $e) {
            DB::table('domain_events')->where('id', $eventId)->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
                'updated_at' => now(),
            ]);
            report($e);
            throw $e;
        }
    }
}

