<?php

use App\Http\Controllers\Common\FilesController;
use App\Models\File;

// -- ROUTE PATTERN
Route::pattern('file', '[0-9a-z]+');

// -- ROUTE MODEL BINDING
// Route::bind('file', function($value)
// {
//     return File::withTrashed()->whereUniq($value)->first();
// });

// // -- ROUTING GROUP
// Route::group(['prefix' => 'files'], function() {
//     Route::get('/random-background',  [FilesController::class, 'randomBackground']) -> name('random-background');

//     // Route::post('/upload', 'FilesController@upload') -> name('file-upload');

//     // Route::get('/{file}/serve/{disposition?}',  'FilesController@serve') -> name('files-serve');
//     // Route::get('/{file}/delete',  'FilesController@delete') -> name('files-delete');
//     // Route::get('/{file}/restore', 'FilesController@restore') -> name('files-restore');

//     // Route::get('/{file}/unlink/{ticket}', 'FilesController@unlink') -> name('files-unlink');

// });
