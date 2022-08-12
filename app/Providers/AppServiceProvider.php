<?php

namespace App\Providers;


use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\AppComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::share('sidebarCollapse', false);
        View::composer('layouts.app', AppComposer::class);

        Blade::if('debug', function () {
            return env('APP_DEBUG', false);
        });

        Blade::if('superAdmin', function () {
            return auth()->user()?->isSuperAdmin() || TRUE;
        });

        Builder::macro('addSubSelect', function($column, $query) {
            if (is_null($this->getQuery()->columns)) {
                $this->select($this->getQuery()->from .'.*');
            }

            return $this->selectSub($query->limit(1)->getQuery(), $column);
        });

        /*
         * Orders sub-query results.
         *
         * @author @reinink
         *
         * @param Builder $query
         * @param        $direction
         *
         * @return Builder
         */
        Builder::macro('orderBySub', function ($query, $direction='asc', $nullPosition=null) {
            if (!in_array($direction, ['asc', 'desc'])) {
                throw new Exception('Not a valid direction.');
            }

            if (!in_array($nullPosition, [null, 'first', 'last'], true)) {
                throw new Exception('Not a valid null position.');
            }

            return $this->orderByRaw(
                implode('', ['(', $query->limit(1)->toSql(), ') ', $direction, $nullPosition ? ' NULLS ' . strtoupper($nullPosition) : null]),
                $query->getBindings()
            );
        });

    }
}
