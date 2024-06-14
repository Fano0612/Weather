<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('dashboard', [WeatherController::class, 'index'])->name('dashboard');
Route::get('test', [WeatherController::class, 'index2'])->name('test');
Route::post('/update-timestamp', [WeatherController::class, 'updateTimestamp']);