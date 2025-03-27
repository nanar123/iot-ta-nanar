<?php

use App\Http\Controllers\Api\MqController;
use App\Http\Controllers\Api\RainController;
use App\Http\Controllers\Api\TempController;
use App\Http\Controllers\Api\UserController;

// use App\Http\Controllers\SensorController;
// use App\Http\Controllers\UserController as ControllersUserController;
// use App\Http\Controllers\Api\MqSensorController;
// use App\Http\Controllers\Api\BuzzerController;
// use App\Http\Controllers\Api\LampController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store_user'])->name('users.store');
Route::post('login', [UserController::class, 'login_user']);
Route::get('show/{id}', [UserController::class, 'show_user'])->name('users.show');
Route::put('update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('destroy/{id}', [UserController::class, 'destroy_user'])->name('users.destroy');
Route::middleware(['auth:sanctum'])->get('logout', [UserController::class, 'logout_user']);

Route::get('temps', [TempController::class, 'index'])->name('temps.index');
Route::middleware(['auth:sanctum'])->post('temps', [TempController::class, 'store']);
Route::middleware(['auth:sanctum'])->get('temps/{temp}', [TempController::class, 'show']);

Route::get('mqs', [MqController::class, 'index'])->name('mqs.index');
Route::middleware(['auth:sanctum'])->post('mqs', [MqController::class, 'store']);
Route::middleware(['auth:sanctum'])->get('mqs/{mq}', [MqController::class, 'show']);

Route::get('rains', [RainController::class, 'index'])->name('rains.index');
Route::middleware(['auth:sanctum'])->post('rains', [RainController::class, 'store']);
Route::middleware(['auth:sanctum'])->get('rains/{rain}', [RainController::class, 'show']);
