<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServiceController;

// -- ROUTE PATTERN
Route::pattern('function', '[a-zA-Z0-9-]+');

// -- ROUTING GROUP
Route::group(['prefix' => 'service'], function() {
    Route::get('/',                     [ServiceController::class, 'index'])->name('service.index');
    Route::get('/{function}',           [ServiceController::class, 'launch'])->name('service.launch');
    Route::post('/{function}/execute',  [ServiceController::class, 'execute'])->name('service.execute');
});
