<?php

namespace App\Modules\Shared\Money;

class Money
{
    public static function format(int|float $amountIdr): string
    {
        return 'Rp ' . number_format((float)$amountIdr, 0, ',', '.');
    }

    public static function parse(string $formatted): int
    {
        $clean = preg_replace('/[^\d]/', '', $formatted);
        return (int)$clean;
    }
}

