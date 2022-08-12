<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\BarcodeController;

// -- ROUTE PATTERN

// -- ROUTE MODEL BINDING

// -- ROUTING GROUP
// Route::group(['prefix' => 'settings'], function() {

//     Route::get('/',			[SettingsController::class, 'index']) -> name('settings-index');
//     Route::post('/',		[SettingsController::class, 'update']) -> name('settings-update');

//     Route::get('set-lang/{lang}', 	[SettingsController::class, 'setLang']) -> name('set-lang');
// });

// Route::match(['get', 'post'], 'barcode', BarcodeController::class) -> name('barcode');
