<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterfacesController;
use App\Http\Controllers\BridgeController;
use App\Http\Controllers\RouteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('interfaces', [InterfacesController::class, 'index'])->name('interfaces');
Route::get('interfaces/wireless', [InterfacesController::class, 'indexWireless'])->name('interfaces/wireless');
Route::get('interfaces/bridge', [BridgeController::class, 'index'])->name('interfaces/bridge');
Route::get('routes/static', [RouteController::class, 'index'])->name('routes/static');
Route::view('teste', 'layout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
