<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SettingsController;

Route::group(['middleware' => ['auth']], function () {

    // -- Permissions
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/',              [SettingsController::class, 'index']) -> name('settings.index');
        Route::patch('{permission}', [SettingsController::class, 'update']) -> name('settings.update');
    });

});
