<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class InterfacesController extends Controller
{


    public function index()
    {
        try {
            $routerIp = Session::get('router_ip');
            $loginName = Session::get('loginName');
            $loginPassword = Session::get('loginPassword');

            $response = Http::withBasicAuth($loginName, $loginPassword)->get('http://' . $routerIp . '/rest/interface');
            
            if ($response->successful()) {
                $interfaces = $response->json();

                return view('interfaces.index', compact('interfaces'));
            } else {

                return response()->json(['error' => 'Falha ao obter as interfaces'], $response->status());
            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }

    public function indexWireless()
    {
        try {

            $routerIp = Session::get('router_ip');
            $loginName = Session::get('loginName');
            $loginPassword = Session::get('loginPassword');

            $response = Http::withBasicAuth($loginName, $loginPassword)->get('http://' . $routerIp . '/rest/interface/wireless');
            
            if ($response->successful()) {

                $interfaces = $response->json();

                return view('interfaces.wireless', compact('interfaces'));
            } else {

                return response()->json(['error' => 'Falha ao obter as interfaces'], $response->status());
            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }

    public function enableWireless($id)
    {
        try {
            $routerIp = Session::get('router_ip');
            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->put("http://{$routerIp}/rest/interface/wireless/{$id}", [
                    'disabled' => 'false'
                ]);
    
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Interface wireless habilitada com sucesso.');
            } else {
                return redirect()->back()->withErrors(['error' => 'Falha ao habilitar a interface wireless.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Falha ao conectar ao dispositivo.']);
        }
    }
    
    public function disableWireless($id)
    {
        try {
            $routerIp = Session::get('router_ip');
            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->put("http://{$routerIp}/rest/interface/wireless/{$id}", [
                    'disabled' => 'true'
                ]);
    
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Interface wireless desabilitada com sucesso.');
            } else {
                return redirect()->back()->withErrors(['error' => 'Falha ao desabilitar a interface wireless.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Falha ao conectar ao dispositivo.']);
        }
    }
    

}