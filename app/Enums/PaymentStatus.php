<?php

namespace App\Enums;

use Illuminate\Support\Collection;

class PaymentStatus
{
    const PENDING = 'pending';
    const SUCCESS = 'success';
    const FAILURE = 'failure';

    const TYPES = [
        self::PENDING,
        self::SUCCESS,
        self::FAILURE
    ];

    public static function asArray(): array
    {
        return self::TYPES;
    }

    public static function asCollection(): Collection
    {
        return collect(self::asArray());
    }
}
