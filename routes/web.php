<?php

use App\Http\Controllers\AktuController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\MqController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RainController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\UserController;
use App\Models\Temperature;
use App\Service\WaNotifService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});


Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//route sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('aktu', [AktuController::class, 'index'])->name('aktu');

    // Route::get('datasensor', [SensorController::class, 'index'])->name('datasensor');

    Route::get('temps', [TempController::class, 'index'])->name('datasensor.datatemp');
    Route::get('rains', [RainController::class, 'index'])->name('datasensor.datarain');
    Route::get('mqs', [MqController::class, 'index'])->name('datasensor.datamq');

    Route::get('/whatsapp', function () {
        $target = '088980939146';
        $message = 'Ada kebocoran gas di rumah anda, segera cek dan perbaiki';
        $response = WaNotifService::sendMessage($target, $message);
        echo $response;
    });

});



require __DIR__ . '/auth.php';
