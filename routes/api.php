<?php

use App\Http\Controllers\Api\BuzzerController;
use App\Http\Controllers\Api\LampController;
use App\Http\Controllers\Api\MqController;
use App\Http\Controllers\Api\MqSensorController;
use App\Http\Controllers\Api\RainController;
use App\Http\Controllers\Api\TempController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UserController as ControllersUserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CRUD
// Route::get('/users', [UserController::class, 'index']);
// Route::get('/users/{id}', [UserController::class, 'show']);
// Route::post('/users', [UserController::class, 'store']);
// Route::put('/users/{id}', [UserController::class, 'update']);
// Route::delete('/users/{id}', [UserController::class, 'destroy']);

// resource route
Route::group(['as' => 'api.'], function ()  {
    Route::resource('users', UserController::class)
    ->except(['create', 'edit']);

    // Route::resource('sensors/mq', MqSensorController::class)
    // ->names('sensors.mq');

    Route::resource('mqs', MqController::class)
    ->names('sensors.mqs');

    Route::resource('temps', TempController::class)
    ->names('sensors.temps');

    Route::resource('rains', RainController::class)
    ->names('sensors.rains');

    Route::resource('lamps', LampController::class)
    ->names('sensors.lamps');

    Route::resource('buzzers', BuzzerController::class)
    ->names('sensors.buzzers');

    // Route::resource('datasensors', SensorController::class)
    // ->names('sensors.data');


});
