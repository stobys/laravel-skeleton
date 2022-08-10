<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		// -- Register @partial directive
		$this -> registerPartialDirective();
    }
	
	public function registerPartialDirective()
	{
		Blade::directive('partial', function ($expression) {
            $expression = explode(',', $expression);

            $data = trim($expression[1] ?? '[]');
            $path = str_replace(['(', ')', "'", '"'], '', $expression[0]);

            $base = '_' . basename($path);

            $dir = dirname($path);
            $dir = 'partials/' . ($dir == '.' ? '' : ($dir . '/'));

            return Blade::compileString('@includeIf("' . $dir . $base . '", '. $data .')');
        });
	}		
}
