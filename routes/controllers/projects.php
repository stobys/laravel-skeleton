<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ProjectsController;

use App\Models\Material;
use App\Models\Project;

// -- ROUTE MODEL BINDING
Route::pattern('project', '[0-9a-z]+');
Route::bind('project', function($value)
{
    return Project::withTrashed()->whereId($value)->firstOrFail();
});

Route::pattern('material', '[0-9a-z]+');
Route::bind('material', function($value)
{
    return Material::withTrashed()->whereId($value)->firstOrFail();
});

Route::group(['middleware' => ['auth']], function () {

    // -- Projects
    Route::group(['prefix' => 'projects'], function () {
        Route::get('/',     [ProjectsController::class, 'index']) -> name('projects.index');
        Route::post('/',    [ProjectsController::class, 'index']) -> name('projects.index-filter');

        Route::get('trash', [ProjectsController::class, 'trash']) -> name('projects.trash');
        Route::post('trash',[ProjectsController::class, 'trash']) -> name('projects.trash-filter');

        Route::get('create',[ProjectsController::class, 'create']) -> name('projects.create');
        Route::put('/',     [ProjectsController::class, 'store']) -> name('projects.store');

        Route::delete('destroy', [ProjectsController::class, 'bulkDestroy']) -> name('projects.bulkDestroy');
        Route::delete('restore', [ProjectsController::class, 'bulkRestore']) -> name('projects.bulkRestore');

        Route::get('{project}',   [ProjectsController::class, 'show']) -> name('projects.show');
        Route::get('{project}/edit',   [ProjectsController::class, 'edit']) -> name('projects.edit');
        Route::patch('{project}', [ProjectsController::class, 'update']) -> name('projects.update');
        Route::delete('{project}', [ProjectsController::class, 'destroy']) -> name('projects.destroy');
        Route::delete('{project}/restore', [ProjectsController::class, 'restore']) -> name('projects.restore');
    });

    // -- Materials
    Route::group(['prefix' => 'materials'], function () {
        Route::get('/',     [MaterialsController::class, 'index']) -> name('materials.index');
        Route::post('/',    [MaterialsController::class, 'index']) -> name('materials.index-filter');

        Route::get('trash', [MaterialsController::class, 'trash']) -> name('materials.trash');
        Route::post('trash',[MaterialsController::class, 'trash']) -> name('materials.trash-filter');

        Route::get('create',[MaterialsController::class, 'create']) -> name('materials.create');
        Route::put('/',     [MaterialsController::class, 'store']) -> name('materials.store');

        Route::delete('destroy', [MaterialsController::class, 'bulkDestroy']) -> name('materials.bulkDestroy');
        Route::delete('restore', [MaterialsController::class, 'bulkRestore']) -> name('materials.bulkRestore');

        Route::get('{material}',   [MaterialsController::class, 'show']) -> name('materials.show');
        Route::get('{material}/edit',   [MaterialsController::class, 'edit']) -> name('materials.edit');
        Route::patch('{material}', [MaterialsController::class, 'update']) -> name('materials.update');
        Route::delete('{material}', [MaterialsController::class, 'destroy']) -> name('materials.destroy');
        Route::delete('{material}/restore', [MaterialsController::class, 'restore']) -> name('materials.restore');
    });

});



