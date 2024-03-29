<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\categoriesController as ApiCategoriesController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\recommendationsController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\servicesController;
use App\Http\Controllers\Api\SpecialistController;
use App\Http\Controllers\Api\specialistsController;
use App\Http\Controllers\Api\specialitiesController;
use App\Http\Controllers\Api\SpecialityController;
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
Route::delete('/categories/delete/{id}', [CategoryController::class, 'delete']);



Route::get('/specialities', [SpecialityController::class, 'list']);
Route::get('/specialities/{id}', [SpecialityController::class, 'item']);
Route::post('/specialities/create', [SpecialityController::class, 'create']);
Route::post('/specialities/update', [SpecialityController::class, 'update']);
Route::delete('/specialities/delete/{id}', [SpecialityController::class, 'delete']);




Route::get('/services', [ServiceController::class, 'list']);
Route::get('/services/{id}', [ServiceController::class, 'item']);
Route::post('/services/create', [ServiceController::class, 'create']);
Route::post('/services/update', [ServiceController::class, 'update']);
Route::delete('/services/delete/{id}', [ServiceController::class, 'delete']);




Route::get('/users', [UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'item']);
Route::post('/users/create', [UserController::class, 'create']);
Route::post('/users/update', [UserController::class, 'update']);
Route::delete('/users/delete/{id}', [UserController::class, 'delete']);




Route::get('/specialists', [SpecialistController::class, 'list']);
Route::get('/specialists/{id}', [SpecialistController::class, 'item']);
Route::post('/specialists/create', [SpecialistController::class, 'create']);
Route::post('/specialists/update', [SpecialistController::class, 'update']);
Route::delete('/specialists/delete/{id}', [SpecialistController::class, 'delete']);




Route::get('/recommendations', [RecommendationController::class, 'list']);
Route::get('/recommendations/{id}', [RecommendationController::class, 'item']);
Route::post('/recommendations/create', [RecommendationController::class, 'create']);
Route::post('/recommendations/update', [RecommendationController::class, 'update']);
Route::delete('/recommendations/delete/{id}', [RecommendationController::class, 'delete']);



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::get('/orders', [OrderController::class, 'list']);
Route::get('/orders/{id}', [OrderController::class, 'item']);
Route::post('/orders/create', [OrderController::class, 'create']);
Route::post('/orders/update', [OrderController::class, 'update']);
Route::delete('/orders/delete/{id}', [OrderController::class, 'delete']);






