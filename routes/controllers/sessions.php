<?php

use App\Models\Session;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionsController;

// -- ROUTE MODEL BINDING
Route::pattern('session', '[0-9a-zA-Z]+');
Route::bind('session', function($value)
{
    return Session::whereId($value)->firstOrFail();
});

Route::group(['middleware' => ['auth']], function () {

    // -- Projects
    Route::group(['prefix' => 'sessions', 'as' => 'sessions.'], function () {
        Route::get('/',     [SessionsController::class, 'index']) -> name('index');
        Route::post('/',    [SessionsController::class, 'index']) -> name('index-filter');

        Route::delete('destroy', [SessionsController::class, 'bulkDestroy']) -> name('bulkDestroy');
        Route::delete('restore', [SessionsController::class, 'bulkRestore']) -> name('bulkRestore');

        Route::delete('{session}', [SessionsController::class, 'destroy']) -> name('destroy');
        Route::delete('{session}/restore', [SessionsController::class, 'restore']) -> name('restore');
    });

});



