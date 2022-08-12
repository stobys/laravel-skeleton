<?php

namespace App\Enums;

use Illuminate\Support\Collection;

class DocumentStatus
{
    const PENDING = 'pending';
    const READY = 'ready';
    const IN_BOOKING = 'in_booking';
    const BOOKED = 'booked';
    const NEED_EDIT = 'need_edit';
    const STORNO = 'storno';

    const TYPES = [
        self::PENDING,
        self::READY,
        self::IN_BOOKING,
        self::BOOKED,
        self::NEED_EDIT,
        self::STORNO
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
