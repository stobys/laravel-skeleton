<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\It\ContactsController;
use App\Http\Controllers\It\LinksController;
use App\Http\Controllers\It\RCPController;

// -- ROUTE PATTERN

// -- ROUTE MODEL BINDING

// Route::get('contacts', [ContactsController::class, 'catalog'])->name('contacts.catalog');
// Route::get('contacts/{contact}', [ContactsController::class, 'profile'])->name('contacts.profile');

// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
//     // -- Contacts
//     Route::get('contacts/published', [ContactsController::class, 'published'])->name('contacts.published');
//     Route::post('contacts/published', [ContactsController::class, 'published']);
//     Route::get('contacts/notpublished', [ContactsController::class, 'notpublished'])->name('contacts.notpublished');
//     Route::post('contacts/notpublished', [ContactsController::class, 'notpublished']);
//     Route::delete('contacts/destroy', [ContactsController::class, 'bulkDestroy'])->name('contacts.bulkDestroy');
//     Route::delete('contacts/restore', [ContactsController::class, 'bulkRestore'])->name('contacts.bulkRestore');
//     Route::delete('contacts/{contact}/restore', [ContactsController::class, 'restore'])->name('contacts.restore');
//     Route::get('contacts/trash', [ContactsController::class, 'trash'])->name('contacts.trash');
//     Route::put('contacts/{contact}/inline', [ContactsController::class, 'updateInline'])->name('contacts.update-inline');

//     Route::resource('contacts', ContactsController::class) -> names(resourceRouteNames('contacts'));

//     //
//     //  PUT|PATCH | admin/contacts/{contact}                 | admin.contacts.update            | App\Http\Controllers\ContactsController@update                         | web

// });


// Route::get('links', [LinksController::class, 'catalog'])->name('links.catalog');
// Route::get('links/{link}', [LinksController::class, 'profile'])->name('links.profile');

// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

//     // -- links
//     Route::delete('links/destroy', [LinksController::class, 'bulkDestroy'])->name('links.bulkDestroy');
//     Route::delete('links/restore', [LinksController::class, 'bulkRestore'])->name('links.bulkRestore');
//     Route::delete('links/{link}/restore', [LinksController::class, 'restore'])->name('links.restore');
//     Route::get('links/trash', [LinksController::class, 'trash'])->name('links.trash');
//     Route::resource('links', LinksController::class) -> names(resourceRouteNames('links'));

// });


// Route::get('rcp/{card?}', [RCPController::class, 'index'])->name('rcp.index');
// Route::post('rcp/{card?}', [RCPController::class, 'index']);
