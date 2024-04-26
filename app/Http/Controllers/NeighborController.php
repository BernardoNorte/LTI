<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use PEAR2\Net\RouterOS;

class NeighborController extends Controller
{
    
    public function index()
    {
        session(['router_ip' => $this->routerIp]);
        session(['loginName' => $this->loginName]);
        session(['loginPassword' => $this->loginPassword]);
        try {
            $routerIp = Session::get('router_ip');
            $loginName = Session::get('loginName');
            $loginPassword = Session::get('loginPassword');
            
            $response = Http::withBasicAuth($loginName, $loginPassword)->get('http://' . $routerIp . '/rest/ip/neighbor');

            if ($response->successful()) {
                $neighbors = $response->json();
                return view('home.index', compact('neighbors'));
            } else {
                return response()->json(['error' => 'Falha ao obter os vizinhos'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }



    
}
