<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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


Route::get('/config', [PanelController::class, 'config'])->name('config');
Route::get('/search', [PanelController::class, 'search'])->name('search');

Route::put('/admin/{id}', [AdminController::class, 'update'])->name('editar-usuario');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admi', [PanelController::class, 'index'])->name('admin');

Route::get('/admi/Category', [CategoryController::class, 'index'])->name('admin.category.index');
Route::post('/admi/Category', [CategoryController::class, 'store'])->name('admin.category.store');
Route::get('/admi/Category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
Route::put('/admi/Category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
Route::delete('/admi/service/{id}', [ServiceController::class, 'destroy'])->name('admin.service.destroy');
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');




Route::get('/admi/Recommendation', [RecommendationController::class, 'index'])->name('admin.recommendation.index');
Route::get('/admi/Recommendation/create', [RecommendationController::class, 'create'])->name('admin.recommendation.create');
Route::post('/admi/Recommendation', [RecommendationController::class, 'store'])->name('admin.recommendation.store');
Route::get('/get-services/{specialistId}', [RecommendationController::class, 'getServices']);
Route::get('/admi/Recommendation/{id}/edit', [RecommendationController::class, 'edit'])->name('admin.recommendation.edit');
Route::put('/admi/Recommendation/{id}', [RecommendationController::class, 'update'])->name('admin.recommendation.update');
Route::get('/get-service-name/{id}', [RecommendationController::class, 'getServiceName']);
Route::delete('/admi/Recommendation/{id}', [RecommendationController::class, 'destroy'])->name('admin.recommendation.destroy');






Route::get('/admi/Service', [ServiceController::class, 'index'])->name('admin.service.index');
Route::post('/admi/Service', [ServiceController::class, 'store'])->name('admin.service.store');
Route::delete('/admin/service/{id}', [ServiceController::class, 'destroy'])->name('admin.service.destroy');
Route::put('/admin/service/{id}', [ServiceController::class, 'update'])->name('admin.service.update');



Route::get('/admi/Specialist', [SpecialistController::class, 'index'])->name('admin.specialist.index');
Route::post('/admi/Specialist', [SpecialistController::class, 'create'])->name('admin.specialist.create');
Route::get('/admin/specialist/{id}', [SpecialistController::class, 'show']);
Route::delete('/admi/specialist/{id}', [SpecialistController::class, 'destroy'])->name('admin.specialist.destroy');
Route::put('/admi/specialist/{id}', [SpecialistController::class, 'update'])->name('admin.specialist.update');



Route::get('/admi/Speciality', [SpecialityController::class, 'index'])->name('admin.speciality.index');
Route::get('/admi/Speciality/create', [SpecialityController::class, 'create'])->name('admin.speciality.create');
Route::post('/admi/Speciality/create', [SpecialityController::class, 'create']); // Agregar esta línea
Route::put('/specialities/update', [SpecialityController::class, 'update'])->name('admin.speciality.update');
Route::delete('/admi/Speciality/{id}', [SpecialityController::class, 'destroy'])->name('admin.speciality.destroy');





Route::get('/admi/User', [UserController::class, 'index'])->name('admin.users.index');
Route::post('/admi/User/create', [UserController::class, 'store'])->name('admin.users.create');
Route::delete('/admi/User/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');


Auth::routes();

