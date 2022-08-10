<?php

use App\Models\BookQS;
use Illuminate\Http\Request;
use App\Services\BookingService;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

// -- ROUTE PATTERN
Route::pattern('station_id', '[0-9a-zA-Z]+');
Route::pattern('serial', '[0-9a-zA-Z]{17}');

// -- ROUTE MODEL BINDING
Route::bind('serial', function($value)
{
    return BookQS::withTrashed()->whereSerial($value)->firstOrFail();
});

// -- ROUTING GROUP
Route::group(['prefix' => 'booking'], function() {
	Route::post('save', function (Request $request) {
		(new BookingService($request->all()))->saveBooking();
	});

	Route::get('qcs',   [BookingController::class, 'qcs'])->name('booking.qcs');
	Route::post('qcs',  [BookingController::class, 'qcs'])->name('booking.qcs-filter');

	Route::get('qcs/{serial}',   [BookingController::class, 'show'])->name('booking.qcs-show');

	Route::get('refids',   [BookingController::class, 'refids'])->name('booking.refids');
	Route::post('refids',  [BookingController::class, 'refids'])->name('booking.refids-filter');

	Route::get('test', function (Request $request) {

		(new BookingService)->test($request -> get('arr'));

	});
});
