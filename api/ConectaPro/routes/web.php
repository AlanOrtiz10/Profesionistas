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
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
| Estas rutas son cargadas por RouteServiceProvider y todas serán asignadas
| al grupo de middleware "web". ¡Haz algo genial!
|
*/

Route::get('/old', function () {
    return view('welcome');
});

Route::get('/admi', [PanelController::class, 'index'])->name('admin');

Route::get('/admi/Category', [CategoryController::class, 'index'])->name('admin.category.index');
Route::post('/admi/Category', [CategoryController::class, 'store'])->name('admin.category.store');
Route::get('/admi/Category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::put('/admi/Category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');




Route::get('/admi/Recommendation', [RecommendationController::class, 'index'])->name('admin.recommendation.index');
Route::get('/admi/Recommendation/create', [RecommendationController::class, 'create'])->name('admin.recommendation.create');
Route::post('/admi/Recommendation', [RecommendationController::class, 'store'])->name('admin.recommendation.store');
Route::get('/get-services/{specialistId}', [RecommendationController::class, 'getServices']);

Route::get('/admi/Service', [ServiceController::class, 'index'])->name('admin.service.index');
Route::post('/admi/Service', [ServiceController::class, 'store'])->name('admin.service.store');

Route::get('/admi/Specialist', [SpecialistController::class, 'index'])->name('admin.specialist.index');
Route::post('/admi/Specialist', [SpecialistController::class, 'create'])->name('admin.specialist.create');

Route::get('/admi/Speciality', [SpecialityController::class, 'index'])->name('admin.speciality.index');
Route::get('/admi/Speciality/create', [SpecialityController::class, 'create'])->name('admin.speciality.create');
Route::post('/admi/Speciality/create', [SpecialityController::class, 'create']); // Agregar esta línea




Route::get('/admi/User', [UserController::class, 'index'])->name('admin.users.index');
Route::post('/admi/User/create', [UserController::class, 'store'])->name('admin.users.create');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
