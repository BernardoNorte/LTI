<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterfacesController;
use App\Http\Controllers\BridgeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\NeighborController;
use App\Http\Controllers\Controller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('interfaces', [InterfacesController::class, 'index'])->name('interfaces');
Route::get('interfaces/wireless', [InterfacesController::class, 'indexWireless'])->name('interfaces/wireless');
Route::get('interfaces/bridge', [BridgeController::class, 'index'])->name('interfaces/bridge');
Route::get('routes/static', [RouteController::class, 'index'])->name('routes/static');
Route::view('teste', 'layout');
Route::post('update-router-ip/{newIp}', [Controller::class, 'updateRouterIp'])->name('update_router_ip');
Route::get('interfaces/bridge/create', [BridgeController::class, 'create'])->name('bridge.create');
Route::post('interfaces/bridge/create', [BridgeController::class, 'store'])->name('bridge.store');
Route::delete('interfaces/bridge/{id}', [BridgeController::class, 'deleteBridge'])->name('bridge.delete');
Auth::routes();

Route::get('neighbors', [NeighborController::class, 'index'])->name('neighbors');
