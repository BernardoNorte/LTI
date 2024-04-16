<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BridgeController extends Controller
{
    public function index()
    {
        try {
            $routerIp = Session::get('router_ip');;
            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/interface/bridge');
            
            if ($response->successful()) {
                
                $interfaces = $response->json();
                
                return view('bridge.index', compact('interfaces'));
            } else {
                return response()->json(['error' => 'Falha ao obter as interfaces'], $response->status());
            }
        } catch (\Exception $e) {
            
            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }
}
