<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductionController;

// -- ROUTE PATTERN
// Route::pattern('week', '[0-9]+');
// Route::pattern('year', '[0-9]+');

Route::group(['prefix' => 'production', 'middleware' => ['auth']], function () {

	// Planowanie i Realizacja Produkcji
    Route::get('planning', [ProductionController::class, 'planning'])
    		-> name('production.planning');
    Route::post('planning/load', [ProductionController::class, 'loadPlan'])
    		-> name('production.planning.load-plan');
    Route::post('planning/save', [ProductionController::class, 'savePlan'])
    		-> name('production.planning.save-plan');

    // -- Kanban
	Route::get('kanban/order',         [ProductionController::class, 'kanbanOrder'])
			-> name('production.kanban.order');
	Route::post('kanban/order/submit', [ProductionController::class, 'kanbanOrderSubmit'])
			-> name('production.kanban.order.submit');

	Route::get('kanban/shipment',          [ProductionController::class, 'kanbanShipment'])
			-> name('production.kanban.shipment');
	Route::post('kanban/shipment/submit',  [ProductionController::class, 'kanbanShipmentSubmit'])
			-> name('production.kanban.shipment.submit');

});

Route::group(['prefix' => 'production'], function () {
    Route::get('realization/{period?}/{project?}/{material?}', [ProductionController::class, 'realization'])
    		-> name('production.realization')
    		-> where('period', '[a-zA-Z]+');
});
