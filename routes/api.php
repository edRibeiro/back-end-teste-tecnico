<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\StateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('api.users.index');
    Route::get('/users/{id}', 'show')->name('api.users.show');
    Route::post('/users', 'store')->name('api.users.store');
    Route::put('/users/{id}', 'update')->name('api.users.update');
    Route::delete('/users/{id}', 'destroy')->name('api.users.destroy');
});

Route::controller(AddressController::class)->group(function () {
    Route::get('/addresses', 'index')->name('api.addresses.index');
    Route::get('/addresses/{id}', 'show')->name('api.addresses.show');
});

Route::controller(CityController::class)->group(function () {
    Route::get('/cities', 'index')->name('api.cities.index');
    Route::get('/cities/{id}', 'show')->name('api.cities.show');
});

Route::controller(StateController::class)->group(function () {
    Route::get('/states', 'index')->name('api.states.index');
    Route::get('/states/{id}', 'show')->name('api.states.show');
});
