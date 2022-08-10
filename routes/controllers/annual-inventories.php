<?php

use App\Models\Inventory;
use App\Models\InventoryVoucher;
use App\Models\InventoryDocument;

use App\Models\InventoryContainer;
use App\Models\InventoryProduction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoriesController;
use App\Http\Controllers\InventoryScannerController;
use App\Http\Controllers\InventoryVouchersController;
use App\Http\Controllers\InventoryDocumentsController;
use App\Http\Controllers\InventoryContainersController;
use App\Http\Controllers\InventoryProductionController;
use App\Http\Controllers\InventoryStatisticsController;

// -- ROUTE MODEL PATTERN
Route::pattern('vid', '[0-9]+');
Route::pattern('voucher', '[0-9]+');
Route::pattern('prodVoucher', '[0-9]+');
Route::pattern('containerVoucher', '[0-9]+');
Route::pattern('document', '[0-9]+');

// -- ROUTE MODEL BINDING
Route::bind('vid', function ($value) {
    return InventoryVoucher::fetchWithoutProduction($value);
});

Route::bind('voucher', function ($value) {
    return InventoryVoucher::fetch($value);
});

Route::bind('prodVoucher', function ($value) {
    return InventoryProduction::fetch($value);
});

Route::bind('containerVoucher', function ($value) {
    return InventoryContainer::fetch($value);
});

Route::bind('document', function ($value) {
    return InventoryDocument::fetch($value);
});

// -- Admin Routes
Route::group(['prefix' => 'inventories', 'as' => 'inventories.'], function () {
    Route::get('/',         [InventoriesController::class, 'index'])->name('index');
    Route::post('/',        [InventoriesController::class, 'index'])->name('index-filter');

    Route::get('trash',     [InventoriesController::class, 'trash'])->name('trash');
    Route::post('trash',    [InventoriesController::class, 'trash'])->name('trash-filter');

    Route::get('create',    [InventoriesController::class, 'create'])->name('create');
    Route::put('/',         [InventoriesController::class, 'store'])->name('store');

    Route::delete('destroy', [InventoriesController::class, 'bulkDestroy'])->name('bulkDestroy');
    Route::delete('restore', [InventoriesController::class, 'bulkRestore'])->name('bulkRestore');

    Route::get('/badges', [InventoriesController::class, 'badges'])->name('badges');

    Route::get('{inventory}',      [InventoriesController::class, 'show'])->name('show');
    Route::get('{inventory}/edit', [InventoriesController::class, 'edit'])->name('edit');
    Route::patch('{inventory}',    [InventoriesController::class, 'update'])->name('update');
    Route::delete('{inventory}',   [InventoriesController::class, 'destroy'])->name('destroy');
    Route::delete('{inventory}/restore', [InventoriesController::class, 'restore'])->name('restore');

    Route::get('{inventory}/doc/{document}',      [InventoriesController::class, 'showDocument'])->name('show-doc');

    Route::get('{inventory}/open', [InventoriesController::class, 'open'])->name('open');
    Route::get('{inventory}/close', [InventoriesController::class, 'close'])->name('close');

    Route::get('{inventory}/confirm', [InventoriesController::class, 'confirm'])->name('confirm');
    Route::post('{inventory}/confirm', [InventoriesController::class, 'confirmSubmit'])->name('confirm-submit');

});

Route::group(['prefix' => 'inventory'], function () {

    Route::group(['prefix' => 'statistics', 'as' => 'inventorystatistics.'], function () {
        Route::get('/', [InventoryStatisticsController::class, 'index'])->name('index');
        Route::post('/', [InventoryStatisticsController::class, 'index'])->name('index-filter');
    });

    Route::group(['as' => 'inventoryscanner.'], function () {
        Route::post('/login', [InventoryScannerController::class, 'login'])->name('login');
        Route::post('/logout', [InventoryScannerController::class, 'logout'])->name('logout');

        Route::group(['prefix' => 'scan'], function () {
            Route::get('/',         [InventoryScannerController::class, 'index'])->name('scan');
            Route::post('/{vid}/submit',  [InventoryScannerController::class, 'submit'])->name('submit');
            Route::post('/load',    [InventoryScannerController::class, 'load'])->name('load');
            Route::get('/{vid?}',    [InventoryScannerController::class, 'fetch'])->name('fetch');
            Route::get('/{vid?}/storno',    [InventoryScannerController::class, 'storno'])->name('storno-req');
        });
    });

    Route::group(['prefix' => 'book'], function () {
        Route::group(['prefix' => 'vouchers', 'as' => 'inventoryvouchers.'], function () {
            Route::get('{voucher}/edit', [InventoryVouchersController::class, 'edit'])->name('edit');
            Route::patch('{voucher}', [InventoryVouchersController::class, 'update'])->name('update');
            Route::get('{voucher}/take', [InventoryVouchersController::class, 'take'])->name('take');
            Route::get('{voucher}/drop', [InventoryVouchersController::class, 'drop'])->name('drop');
            Route::get('{voucher}/storno', [InventoryVouchersController::class, 'storno'])->name('storno');
            Route::get('{voucher}/reset', [InventoryVouchersController::class, 'reset'])->name('reset');

            Route::get('/', [InventoryVouchersController::class, 'index'])->name('index');
            Route::post('/', [InventoryVouchersController::class, 'index'])->name('index-filter');
        });

        Route::group(['prefix' => 'documents', 'as' => 'inventorydocuments.'], function () {
            Route::get('{document}/edit', [InventoryDocumentsController::class, 'edit'])->name('edit');
            Route::patch('{document}', [InventoryDocumentsController::class, 'update'])->name('update');
            Route::get('{document}/take', [InventoryDocumentsController::class, 'take'])->name('take');
            Route::get('{document}/drop', [InventoryDocumentsController::class, 'drop'])->name('drop');
            Route::get('{document}/storno', [InventoryDocumentsController::class, 'storno'])->name('storno');
            Route::get('{document}/approve-items', [InventoryDocumentsController::class, 'approve'])->name('approve-items');
            Route::get('{document}',   [InventoryDocumentsController::class, 'show'])->name('show');

            Route::get('/', [InventoryDocumentsController::class, 'index'])->name('index');
            Route::post('/', [InventoryDocumentsController::class, 'index'])->name('index-filter');
        });

        Route::group(['prefix' => 'production', 'as' => 'inventoryproduction.'], function () {
            Route::get('create', [InventoryProductionController::class, 'create'])->name('create');
            Route::put('/',     [InventoryProductionController::class, 'store'])->name('store');
            Route::get('{prodVoucher}/edit', [InventoryProductionController::class, 'edit'])->name('edit');
            Route::patch('{prodVoucher}', [InventoryProductionController::class, 'update'])->name('update');
            Route::get('{prodVoucher}/take', [InventoryProductionController::class, 'take'])->name('take');
            Route::get('{prodVoucher}/drop', [InventoryProductionController::class, 'drop'])->name('drop');
            Route::get('{prodVoucher}/storno', [InventoryProductionController::class, 'storno'])->name('storno');
            Route::get('{prodVoucher}/destroy', [InventoryProductionController::class, 'destroy'])->name('destroy');
            Route::get('{prodVoucher}',   [InventoryProductionController::class, 'show'])->name('show');

            Route::get('/', [InventoryProductionController::class, 'index'])->name('index');
            Route::post('/', [InventoryProductionController::class, 'index'])->name('index-filter');
        });

        Route::group(['prefix' => 'containers', 'as' => 'inventorycontainers.'], function () {
            Route::get('summary', [InventoryContainersController::class, 'summary'])->name('summary');
            Route::get('download', [InventoryContainersController::class, 'download'])->name('download');

            Route::get('create', [InventoryContainersController::class, 'create'])->name('create');
            Route::put('/',     [InventoryContainersController::class, 'store'])->name('store');
            Route::get('{containerVoucher}/edit', [InventoryContainersController::class, 'edit'])->name('edit');
            Route::patch('{containerVoucher}', [InventoryContainersController::class, 'update'])->name('update');
            Route::get('{containerVoucher}/take', [InventoryContainersController::class, 'take'])->name('take');
            Route::get('{containerVoucher}/drop', [InventoryContainersController::class, 'drop'])->name('drop');
            Route::get('{containerVoucher}/storno', [InventoryContainersController::class, 'storno'])->name('storno');
            Route::get('{containerVoucher}',   [InventoryContainersController::class, 'show'])->name('show');

            Route::get('/', [InventoryContainersController::class, 'index'])->name('index');
            Route::post('/', [InventoryContainersController::class, 'index'])->name('index-filter');
        });
    });

});
    // Route::group(['prefix' => 'stations'], function () {
    //     Route::get('/',         [AnnualInventoryBookingController::class, 'index'])->name('stations.index');
    //     Route::post('/',        [AnnualInventoryBookingController::class, 'index'])->name('stations.index-filter');

    //     Route::get('trash',     [AnnualInventoryBookingController::class, 'trash'])->name('stations.trash');
    //     Route::post('trash',    [AnnualInventoryBookingController::class, 'trash'])->name('stations.trash-filter');

    //     Route::get('create',    [AnnualInventoryBookingController::class, 'create'])->name('stations.create');
    //     Route::put('/',         [AnnualInventoryBookingController::class, 'store'])->name('stations.store');

    //     Route::delete('destroy', [AnnualInventoryBookingController::class, 'bulkDestroy'])->name('stations.bulkDestroy');
    //     Route::delete('restore', [AnnualInventoryBookingController::class, 'bulkRestore'])->name('stations.bulkRestore');

    //     Route::get('{role}',      [AnnualInventoryBookingController::class, 'show'])->name('stations.show');
    //     Route::get('{role}/edit', [AnnualInventoryBookingController::class, 'edit'])->name('stations.edit');
    //     Route::patch('{role}',    [AnnualInventoryBookingController::class, 'update'])->name('stations.update');
    //     Route::delete('{role}',   [AnnualInventoryBookingController::class, 'destroy'])->name('stations.destroy');
    //     Route::delete('{role}/restore', [AnnualInventoryBookingController::class, 'restore'])->name('stations.restore');
    // });
