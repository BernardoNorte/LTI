<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InterfacesController extends Controller
{
    
    
    public function index()
    {
        try {
            $routerIp = env('ROUTER_IP');
            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/interface');
            
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
            $routerIp = env('ROUTER_IP');
            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/interface/wireless');
            
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
