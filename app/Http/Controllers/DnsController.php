<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class DnsController extends Controller
{

    public function index()
    {
        session(['router_ip' => $this->routerIp]);
        try {
            $routerIp = Session::get('router_ip');

            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/ip/dns/static');

            if ($response->successful()) {
                $dns = $response->json();
                return view('dns.index', compact('dns'));
            } else {
                return response()->json(['error' => 'Falha ao obter os servidores dns'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }

    public function enable($id)
    {
        try {
            $routerIp = Session::get('router_ip');
            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->post("http://{$routerIp}/rest/ip/dns/static/enable", [
                    '.id' => $id
                ]);
    
            if ($response->successful()) {
                return redirect()->back()->with('success', 'DNS habilitada com sucesso.');
            } else {
                return redirect()->back()->withErrors(['error' => 'Falha ao habilitar DNS.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Falha ao conectar ao dispositivo.']);
        }
    }
    
    public function disable($id)
    {
        try {
            $routerIp = Session::get('router_ip');
            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->post("http://{$routerIp}/rest/ip/dns/static/disable", [
                    '.id' => $id
                ]);
    
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Dns desabilitada com sucesso.');
            } else {
                return redirect()->back()->withErrors(['error' => 'Falha ao desabilitar DNS.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Falha ao conectar ao dispositivo.']);
        }
    }
    

}
