<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterfacesController;
use App\Http\Controllers\BridgeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\NeighborController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SecurityController;

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
Route::patch('interfaces/bridge/{id}', [BridgeController::class,'updateBridge'])->name('bridge.update');
Route::get('interfaces/bridge/{id}', [BridgeController::class, 'edit'])->name('bridge.edit');
Route::get('interfaces/wireless/security-profiles', [SecurityController::class, 'index'])->name('security.index');
Route::get('interfaces/wireless/security-profiles/create', [SecurityController::class, 'create'])->name('security.create');
Route::post('interfaces/wireless/security-profiles/create', [SecurityController::class, 'store'])->name('security.store');
Route::delete('interfaces/wireless/security-profiles/{id}', [SecurityController::class, 'deleteSecurity'])->name('security.delete');
Route::patch('interfaces/wireless/security-profiles/{id}', [SecurityController::class,'updateSecurityProfile'])->name('security.update');
Route::get('interfaces/wireless/security-profiles/{id}', [SecurityController::class, 'edit'])->name('security.edit');
Route::get('neighbors', [NeighborController::class, 'index'])->name('neighbors');
Route::post('/update-login-credentials', [Controller::class, 'updateLoginCredentials'])->name('update_login_credentials');

