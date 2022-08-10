<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [HomeController::class, 'index'])->name('root');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::post('/dev-login', [LoginController::class, 'developerLogin'])->name('developer-login');

// -- load controllers routes
foreach (File::files(dirname(__FILE__) . DIRECTORY_SEPARATOR .'controllers') as $file) {
    include($file);
}
