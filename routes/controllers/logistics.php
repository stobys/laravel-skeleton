<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Logistics\LogisticsController;
use App\Http\Controllers\Logistics\MaterialsController;
use App\Http\Controllers\Logistics\ProjectsController;
use App\Http\Controllers\Logistics\ShelfsController;

use App\Models\Logistics\Material;
use App\Models\Logistics\Project;
use App\Models\Logistics\Shelf;
use App\Models\Logistics\StocktakingVoucher;

// -- ROUTE MODEL BINDING
// Route::pattern('project', '[0-9a-z]+');
// Route::bind('project', function($value)
// {
//     return Project::withTrashed()->whereId($value)->firstOrFail();
// });

// Route::pattern('material', '[0-9a-z]+');
// Route::bind('material', function($value)
// {
//     return Material::withTrashed()->whereId($value)->firstOrFail();
// });

// Route::pattern('shelf', '[0-9a-z]+');
// Route::bind('shelf', function($value)
// {
//     // return Shelf::withTrashed()->whereId($value)->firstOrFail();
//     return Shelf::whereId($value)->firstOrFail();
// });

// Route::pattern('voucher', '[0-9]+');

//     // -- Admin Routes
//     Route::group(['prefix' => 'logistics', 'as' => 'logistics.'], function () {
//         // Logistics \ Projects
//         Route::group(['prefix' => 'projects'], function () {
//             // -- Projects
//             Route::delete('destroy', [
//                 ProjectsController::class, 'bulkDestroy'
//             ]) -> name('projects.bulkDestroy');

//             Route::delete('restore', [
//                 ProjectsController::class, 'bulkRestore'
//             ]) -> name('projects.bulkRestore');

//             Route::delete('{project}/restore', [
//                 ProjectsController::class, 'restore'
//             ]) -> name('projects.restore');

//             Route::get('trash', [
//                 ProjectsController::class, 'trash'
//             ]) -> name('projects.trash');
//         });

//             Route::resource('projects', ProjectsController::class)
//                 -> names(resourceRouteNames('projects'));

//         // Logistics \ Materials
//         Route::group(['prefix' => 'materials'], function () {
//             // -- Materials
//             Route::get('without-projects', [
//                 MaterialsController::class, 'withoutProjects'
//             ]) -> name('materials.without-projects');

//             Route::delete('destroy', [
//                 MaterialsController::class, 'bulkDestroy'
//             ]) -> name('materials.bulkDestroy');

//             Route::delete('restore', [
//                 MaterialsController::class, 'bulkRestore'
//             ]) -> name('materials.bulkRestore');

//             Route::delete('{material}/restore', [
//                 MaterialsController::class, 'restore'
//             ]) -> name('materials.restore');

//             Route::get('trash', [
//                 MaterialsController::class, 'trash'
//             ]) -> name('materials.trash');
//         });

//             Route::resource('materials', MaterialsController::class)
//                 -> names(resourceRouteNames('materials'));

//         // Logistics \ Shelfs
//         Route::group(['prefix' => 'shelfs'], function () {
//             // -- Shelfs
//             Route::get('without-materials', [
//                 ShelfsController::class, 'withoutMaterials'
//             ]) -> name('shelfs.without-materials');

//             Route::delete('destroy', [
//                 ShelfsController::class, 'bulkDestroy'
//             ]) -> name('shelfs.bulkDestroy');

//             Route::delete('restore', [
//                 ShelfsController::class, 'bulkRestore'
//             ]) -> name('shelfs.bulkRestore');

//             Route::delete('{shelf}/restore', [
//                 ShelfsController::class, 'restore'
//             ]) -> name('shelfs.restore');

//             // Route::get('trash', [
//             //     ShelfsController::class, 'trash'
//             // ]) -> name('shelfs.trash');
//         });

//             Route::resource('shelfs', ShelfsController::class)
//                 -> names(resourceRouteNames('shelfs'));

//         // Logistics \ Projects
//         Route::group(['prefix' => 'stocktaking'], function () {
//             Route::get('take/{voucher?}', [LogisticsController::class, 'stocktakingTake']) -> name('stocktaking-take');
//             Route::post('post/{voucher}', [LogisticsController::class, 'stocktakingPost']) -> name('stocktaking-post');
//             Route::post('load', [LogisticsController::class, 'stocktakingLoad']) -> name('stocktaking-load');
//             Route::post('login', [LogisticsController::class, 'stocktakingLogin']) -> name('stocktaking-login');
//             Route::get('logout', [LogisticsController::class, 'stocktakingLogout']) -> name('stocktaking-logout');
//             Route::get('repairZH', [LogisticsController::class, 'stocktakingRepairZH']) -> name('stocktaking-repair-zh');
//             Route::get('repairF9B', [LogisticsController::class, 'stocktakingRepairF9B']) -> name('stocktaking-repair-f9b');
//             Route::get('repairMyjkaQty', [LogisticsController::class, 'stocktakingRepairF9B']) -> name('stocktaking-repair-myjka');
//             Route::get('repairMoveHighF2Z', [LogisticsController::class, 'stocktakingRepairMoveHighF2Z']) -> name('stocktaking-repair-move-high-F2Z');
//             Route::get('repairMoveBlockF2Z', [LogisticsController::class, 'stocktakingRepairMoveBlockF2Z']) -> name('stocktaking-repair-move-block-F2Z');
//             Route::get('repairZNullQty', [LogisticsController::class, 'stocktakingRepairZNullQty']) -> name('stocktaking-repair-z-null-qty');

//             // Route::get('stocktaking', [LogisticsController::class, 'stocktaking']) -> name('stocktaking');
//         });


//         // -- Common Routes
//     	Route::get('/', [LogisticsController::class, 'index'])->name('index');
//         Route::get('layout', [LogisticsController::class, 'layout'])->name('layout');
//         Route::post('loadMaterialsByProject', [LogisticsController::class, 'getMaterialsByProject']) -> name('loadMaterialsByProject');

//         Route::post('setShelfPosition/{shelf}', [LogisticsController::class, 'setShelfPosition']) -> name('set-shelf-position');

//         // -- Projects
//         Route::get('projects/without-materials', [
//             LogisticsController::class, 'projectsWithoutMaterials'
//         ]) -> name('projects.without-materials');

//         Route::post('projects/without-materials', [
//             LogisticsController::class, 'projectsWithoutMaterials'
//         ]);

//         Route::get('projects/{project}/dashboard', [
//             LogisticsController::class, 'projectsDashboard'
//         ]) -> name('projects.dashboard');
//     });

    // -- User Routes
	// Route::get('projects', [ProjectsController::class, 'index'])->name('projects.index');
	// Route::get('materials', [MaterialsController::class, 'index'])->name('materials.index');




    // -- Materials
    // Route::delete('materials/destroy', [MaterialsController::class, 'bulkDestroy'])->name('materials.bulkDestroy');
    // Route::delete('materials/restore', [MaterialsController::class, 'bulkRestore'])->name('materials.bulkRestore');
    // Route::delete('materials/{project}/restore', [MaterialsController::class, 'restore'])->name('materials.restore');
    // Route::get('materials/trash', [MaterialsController::class, 'trash'])->name('materials.trash');
    // Route::resource('materials', MaterialsController::class) -> names(resourceRouteNames('materials'));

