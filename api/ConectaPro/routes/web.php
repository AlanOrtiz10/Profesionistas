<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\categoriesController;
use App\Http\Controllers\Api\servicesController as ApiServicesController;
use App\Http\Controllers\CategoriesController as ControllersCategoriesController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index'])->name('dashboard');

Route::get('/admin/Category', [ControllersCategoriesController::class, 'index'])->name('categories');
Route::get('/admin/Services', [ServicesController::class, 'index'])->name('services');

