<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\SpecialistsController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\UserController;
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

Route::get('/old', function () {
    return view('welcome');
});

Route::get('/admi', [PanelController::class, 'index'])->name('admin');

Route::get('/admi/Category', [CategoryController::class, 'index'])->name('Category');

Route::get('/admi/Recommendation', [RecommendationController::class, 'index'])->name('Recommendation');

Route::get('/admi/Service', [ServiceController::class, 'index'])->name('Service');

Route::get('/admi/Specialist', [SpecialistController::class, 'index'])->name('Specialist');

Route::get('/admi/Speciality', [SpecialityController::class, 'index'])->name('Speciality');



Route::get('/admi/User', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create.form');
Route::post('/users/create', [UserController::class, 'store'])->name('users.create');
Route::get('/users/{id}/edit', [UserController::class, 'index'])->name('users.edit');
Route::put('/users/update/{id}', [UserController::class, 'index'])->name('users.update');




