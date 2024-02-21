<?php

use App\Http\Controllers\Api\categoriesController as ApiCategoriesController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\recommendationsController;
use App\Http\Controllers\Api\servicesController;
use App\Http\Controllers\Api\SpecialistController;
use App\Http\Controllers\Api\specialistsController;
use App\Http\Controllers\Api\specialitiesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\usersController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [CategoryController::class, 'list']);
Route::get('/categories/{id}', [CategoryController::class, 'item']);
Route::post('/categories/create', [CategoryController::class, 'create']);
Route::post('/categories/update', [CategoryController::class, 'update']);


Route::get('/specialities', [specialitiesController::class, 'list']);
Route::get('/specialities/{id}', [specialitiesController::class, 'item']);
Route::post('/specialities/create', [specialitiesController::class, 'create']);


Route::get('/services', [servicesController::class, 'list']);
Route::get('/services/{id}', [servicesController::class, 'item']);
Route::post('/services/create', [servicesController::class, 'create']);


Route::get('/users', [UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'item']);
Route::post('/users/create', [UserController::class, 'create']);



Route::get('/specialists', [SpecialistController::class, 'list']);
Route::get('/specialists/{id}', [SpecialistController::class, 'item']);
Route::post('/specialists/create', [SpecialistController::class, 'create']);


Route::get('/recommendations', [recommendationsController::class, 'list']);
Route::get('/recommendations/{id}', [recommendationsController::class, 'item']);
Route::post('/recommendations/create', [recommendationsController::class, 'create']);




