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

}
