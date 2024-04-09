<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BridgeController extends Controller
{
    public function index()
    {
        try {
            $routerIp = env('ROUTER_IP');
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
