<?php

use Illuminate\Support\Carbon;

// -- returns a Carbon instance
if (! function_exists('carbon')) {
    function carbon(string $parseString = '', string $timezone = null): Carbon
    {
        return new Carbon($parseString, $timezone);
    }
}

// -- return a formatted Carbon date
if (! function_exists('datef')) {
    function datef(Carbon $date, string $format = 'Y-m-d H:i'): string
    {
        return $date -> format($format);
    }
}

Carbon::macro('startOfProductionMonth', static function() {
	return self::this() -> clone() -> startOfMonth() -> startOfShiftC();
});

Carbon::macro('endOfProductionMonth', static function() {
	return self::this() -> clone() -> endOfMonth() -> endOfShiftB();
});

Carbon::macro('startOfProductionWeek', static function() {
	return self::this() -> clone() -> startOfWeek() -> startOfShiftC();
});

Carbon::macro('endOfProductionWeek', static function() {
	return self::this() -> clone() -> endOfWeek() -> endOfShiftB();
});

Carbon::macro('startOfShiftC', static function() {
	return self::this() -> clone() -> subDay(1) -> setTime(22, 0, 0, 0);
});

Carbon::macro('endOfShiftC', static function() {
	return self::this() -> clone() -> setTime(6, 0, 0, 0) -> subMicrosecond(1);
});

Carbon::macro('startOfShiftA', static function() {
	return self::this() -> clone() -> setTime(6, 0, 0, 0);
});

Carbon::macro('endOfShiftA', static function() {
	return self::this() -> clone() -> setTime(14, 0, 0, 0) -> subMicrosecond(1);
});

Carbon::macro('startOfShiftB', static function() {
	return self::this() -> clone() -> setTime(14, 0, 0, 0);
});

Carbon::macro('endOfShiftB', static function() {
	return self::this() -> clone() -> setTime(22, 0, 0, 0) -> subMicrosecond(1);
});

Carbon::macro('startOfCurrectShift', static function() {
	$d = self::this();

	switch( true )
	{
		case ($d -> hour >= 22 && $d -> hour < 6):
			return self::startOfShiftC();
		break;

		case ($d -> hour >= 6 && $d -> hour < 14):
			return self::startOfShiftA();
		break;

		case ($d -> hour >= 14 && $d -> hour < 22):
			return self::startOfShiftB();
		break;
	}
});

Carbon::macro('currectShift', static function() {
	$d = self::this();

	switch( true )
	{
		case ($d -> hour >= 22 && $d -> hour < 6):
			return 'C';
		break;

		case ($d -> hour >= 6 && $d -> hour < 14):
			return 'A';
		break;

		case ($d -> hour >= 14 && $d -> hour < 22):
			return 'B';
		break;
	}
});

Carbon::macro('endOfCurrectShift', static function() {
	$d = self::this();

	switch( true )
	{
		case ($d -> hour >= 22 && $d -> hour < 6):
			return self::endOfShiftC();
		break;

		case ($d -> hour >= 6 && $d -> hour < 14):
			return self::endOfShiftA();
		break;

		case ($d -> hour >= 14 && $d -> hour < 22):
			return self::endOfShiftB();
		break;
	}
});

Carbon::macro('timeFromShiftStart', static function() {
	$date = self::this();
});

Carbon::macro('timeToShiftEnd', static function() {
	$date = self::this();
});


// -----

Carbon::macro('diffFromYear', static function ($year, $absolute = false, $short = false, $parts = 1) {
    return self::this()->diffForHumans(Carbon::create($year, 1, 1, 0, 0, 0), $absolute, $short, $parts);
});

Carbon::macro('setSchoolYear', static function ($schoolYear) {
    $date = self::this();
    $date->year = $schoolYear;

    if ($date->month > 7) {
        $date->year--;
    }
});
Carbon::macro('getSchoolYear', static function () {
    $date = self::this();
    $schoolYear = $date->year;

    if ($date->month > 7) {
        $schoolYear++;
    }

    return $schoolYear;
});
