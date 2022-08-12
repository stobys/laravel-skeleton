<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

class CarbonMacrosServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this -> registerProductionMacros();

    }

    protected function registerProductionMacros()
    {
        Carbon::macro('getWeekOfYearLeadingZeros', function () {
            return str_pad($this->weekOfYear, 2, '0', STR_PAD_LEFT);
        });

        Carbon::macro('getFiscalYear', function () {
            $schoolYear = self::this()->year;

            if ($this->month > 9) {
                $schoolYear++;
            }

            return $schoolYear;
        });

        Carbon::macro('isShiftA', function () {
            if ($this->hour >= 6 && $this->hour < 14) {
                return true;
            }

            return false;
        });

        Carbon::macro('isShiftB', function () {
            if ($this->hour >= 14 && $this->hour < 22) {
                return true;
            }

            return false;
        });

        Carbon::macro('isShiftC', function () {
            if ($this->hour >= 22 || $this->hour < 6) {
                return true;
            }

            return false;
        });

        Carbon::macro('getShiftNumber', function () {
            switch (true) {
                case $this->isShiftA():
                    return 1;
                    break;

                case $this->isShiftB():
                    return 2;
                    break;

                case $this->isShiftC():
                    return 3;
                    break;
            }
        });

        Carbon::macro('getShift', function() {
            switch(true){
                case $this -> isShiftA():
                    return 'A';
                break;

                case $this -> isShiftB():
                    return 'B';
                break;

                case $this -> isShiftC():
                    return 'C';
                break;
            }
        });

        Carbon::macro('isPastWeek', function () {
            if ($this->weekOfYear < $this->clone()->now()->weekOfYear) {
                return true;
            }

            return false;
        });
    }
}
