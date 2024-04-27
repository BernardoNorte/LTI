<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class WireguardController extends Controller
{

    public function index()
    {
        try {
            $routerIp = Session::get('router_ip');
            $loginName = Session::get('loginName');
            $loginPassword = Session::get('loginPassword');

            $response = Http::withBasicAuth($loginName, $loginPassword)->get('http://' . $routerIp . '/rest/interface/wireguard');
            
            if ($response->successful()) {
                $wireguard = $response->json();

                return view('wireguard.index', compact('wireguard'));
            } else {

                return response()->json(['error' => 'Falha ao obter WireGuard'], $response->status());
            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }

    public function create(){
        return view('wireguard.create');
    }

    public function store(Request $request)
    {
        try {
            $routerIp = Session::get('router_ip');
    
            $validatedData = $request->validate([
                'name' => 'required|string',
                'mtu' => 'required|string',
                'listen-port' => 'required|string',
            ]);
    
            $formData = [
                'name' => $validatedData['name'],
                'mtu' => $validatedData['mtu'],
                'listen-port' => $validatedData['listen-port'],
            ];
    
            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->post('http://' . $routerIp . '/rest/interface/wireguard/add', $formData);
    
            if ($response->successful()) {
                return redirect()->route('wireguard')->with('success', 'WireGuard server created successfully.');
            } else {
                return back()->withErrors(['error' => 'Failed to create WireGuard server.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error connecting to the device.']);
        }
    }

    public function edit($id)
{
    try {
        $routerIp = Session::get('router_ip');

        $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/interface/wireguard/' . $id);

        if ($response->successful()) {

            $wireguard = $response->json();

            return view('wireguard.edit', compact('id', 'wireguard'));
        } else {

            return back()->withErrors(['error' => 'Falha ao obter os dados do servidor WireGuard.']);
        }
    } catch (\Exception $e) {

        return back()->withErrors(['error' => 'Erro ao conectar ao dispositivo.']);
    }
}

public function updateWireguard(Request $request, $id)
{
    try {
        $routerIp = Session::get('router_ip');

        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'mtu' => 'nullable|string',
            'listen-port' => 'nullable|string',
        ]);

        $formData = [
            'name' => $validatedData['name'],
            'mtu' => $validatedData['mtu'],
            'listen-port' => $validatedData['listen-port'],
        ];

        $response = Http::withBasicAuth('admin', 'ltipassword')
            ->patch('http://' . $routerIp . '/rest/interface/wireguard/' . $id, $formData);

        if ($response->successful()) {
            return back()->with('success', 'WireGuard server successfully updated.');
        } else {
            return back()->withErrors(['error' => 'Failed to update WireGuard server data.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error connecting to the device.']);
    }
}
    public function deleteWireguard($id)
    {
        try {
            $routerIp = Session::get('router_ip');
    
            $response = Http::withBasicAuth('admin', 'ltipassword')->delete('http://' . $routerIp . '/rest/interface/wireguard/' . $id);
    
            if ($response->successful()) {
                return back()->with('success', 'Servidor WireGuard excluído com sucesso!');
            } else {
                return back()->withErrors(['error' => 'Erro ao processar o pedido. Por favor, tente novamente.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erro ao conectar ao dispositivo.']);
        }
    }
    
}