<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RouteController extends Controller
{
    public function index()
    {
        try {
            $routerIp = Session::get('router_ip');;
            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/ip/route');
            
            if ($response->successful()) {
                
                $routes = $response->json();
                
                return view('routes.index', compact('routes'));
            } else {
                
                return response()->json(['error' => 'Falha ao obter as rotas'], $response->status());
            }
        } catch (\Exception $e) {
            
            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }
}
