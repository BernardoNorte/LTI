<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\DhcpController;
use App\Http\Controllers\WireguardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterfacesController;
use App\Http\Controllers\BridgeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\NeighborController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\DnsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('interfaces', [InterfacesController::class, 'index'])->name('interfaces');
Route::get('interfaces/wireless', [InterfacesController::class, 'indexWireless'])->name('interfaces/wireless');
Route::put('interfaces/wireless/{id}/enable', [InterfacesController::class, 'enableWireless'])->name('wireless.enable');
Route::put('interfaces/wireless/{id}/disable', [InterfacesController::class, 'disableWireless'])->name('wireless.disable');
Route::get('interfaces/bridge', [BridgeController::class, 'index'])->name('interfaces/bridge');
Route::get('routes/static', [RouteController::class, 'index'])->name('routes/static');
Route::get('routes/static/create', [RouteController::class, 'create'])->name('route.create');
Route::post('routes/static/create', [RouteController::class, 'store'])->name('route.store');
Route::get('routes/static/{id}', [RouteController::class, 'edit'])->name('route.edit');
Route::patch('routes/static/{id}', [RouteController::class, 'updateRoute'])->name('route.update');
Route::delete('routes/static/{id}', [RouteController::class, 'deleteRoute'])->name('route.delete');
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
Route::get('dhcp', [DhcpController::class, 'index'])->name('dhcp');
Route::get('dhcp/create', [DhcpController::class, 'create'])->name('dhcp.create');
Route::post('dhcp/create', [DhcpController::class, 'store'])->name('dhcp.store');
Route::put('dhcp/{id}', [DhcpController::class, 'updateDhcp'])->name('dhcp.update');
Route::get('dhcp/{id}', [DhcpController::class, 'edit'])->name('dhcp.edit');
Route::delete('dhcp/{id}', [DhcpController::class, 'deleteDhcp'])->name('dhcp.delete');
Route::get('dns', [DnsController::class, 'index'])->name('dns');
Route::post('dns/enable/{id}', [DnsController::class, 'enable'])->name('dns.enable');
Route::post('dns/disable/{id}', [DnsController::class, 'disable'])->name('dns.disable');
Route::get('addresses', [AddressController::class, 'index'])->name('addresses');
Route::get('addresses/create', [AddressController::class, 'create'])->name('address.create');
Route::post('addresses/create', [AddressController::class, 'store'])->name('address.store');
Route::patch('address/{id}', [AddressController::class, 'updateAddress'])->name('address.update');
Route::get('address/{id}', [AddressController::class, 'edit'])->name('address.edit');
Route::delete('address/{id}', [AddressController::class, 'deleteAddress'])->name('address.delete');
Route::post('/update-login-credentials', [Controller::class, 'updateLoginCredentials'])->name('update_login_credentials');
Route::get('wireguard', [WireguardController::class, 'index'])->name('wireguard');
Route::get('wireguard/create', [WireguardController::class, 'create'])->name('wireguard.create');
Route::post('wireguard/create', [WireguardController::class, 'store'])->name('wireguard.store');
Route::patch('wireguard/{id}', [WireguardController::class, 'updateWireguard'])->name('wireguard.update');
Route::get('wireguard/{id}', [WireguardController::class, 'edit'])->name('wireguard.edit');
Route::delete('wireguard/{id}', [WireguardController::class, 'deleteWireguard'])->name('wireguard.delete');

