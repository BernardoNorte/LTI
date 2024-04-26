<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DhcpController extends Controller
{

    public function index()
    {
        session(['router_ip' => $this->routerIp]);
        try {
            $routerIp = Session::get('router_ip');

            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/ip/dhcp-server');

            if ($response->successful()) {
                $dhcp = $response->json();
                return view('dhcp.index', compact('dhcp'));
            } else {
                return response()->json(['error' => 'Falha ao obter os servidores dhcp'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }

    public function create()
    {
        try {
            $routerIp = Session::get('router_ip');

            $interfacesController = new InterfacesController();
            $interfacesView = $interfacesController->index();
            $interfacesArray = $interfacesView->getData()['interfaces'];
            $interfaceNames = array_map(function ($interface) {
                return $interface['name'];
            }, $interfacesArray);

            $responseWithPort = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/interface/bridge/port');
            $bridgePorts = $responseWithPort->json();

            foreach ($bridgePorts as $bridgePort) {
                if (($key = array_search($bridgePort['interface'], $interfaceNames)) !== false) {
                    unset($interfaceNames[$key]);
                }
            }

            return view('dhcp.create', ['interfaceNames' => $interfaceNames]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }


    public function deleteDhcp($id)
    {
        try {
            $routerIp = Session::get('router_ip');

            $response = Http::withBasicAuth('admin', 'ltipassword')->delete('http://' . $routerIp . '/rest/ip/dhcp-server/' . $id);

            if ($response->successful()) {

                return back()->with('success', 'Servidor Dhcp excluída com sucesso!');
            } else {
                return back()->withErrors(['error' => 'Erro ao processar o pedido. Por favor, tente novamente.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erro ao conectar ao dispositivo.']);
        }
    }

    public function edit($id)
    {
        try {
            $routerIp = Session::get('router_ip');

            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/ip/dhcp-server/' . $id);

            if ($response->successful()) {

                $dhcp = $response->json();

                return view('dhcp.edit', compact('id', 'dhcp'));
            } else {

                return back()->withErrors(['error' => 'Failed to fetch interface data.']);
            }
        } catch (\Exception $e) {

            return back()->withErrors(['error' => 'Error connecting to the device.']);
        }
    }

    public function store(Request $request)
    {
        try {
            $routerIp = Session::get('router_ip');

            $validatedData = $request->validate([
                'name' => 'required|string',
                'interface' => 'required|string',
                'lease-time' => 'required|string',
                'authoritative' => 'required|in:yes,no,after 2s delay,after 10s delay',
                'bootp-support' => 'required|in:static,none,dynamic',
                'use-radius' => 'required|in:no,yes,accounting',
            ]);

            $formData = [
                'name' => $validatedData['name'],
                'interface' => $validatedData['interface'],
                'lease-time' => $validatedData['lease-time'],
                'authoritative' => $validatedData['authoritative'],
                'bootp-support' => $validatedData['bootp-support'],
                'use-radius' => $validatedData['use-radius'],
            ];

            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->post('http://' . $routerIp . '/rest/ip/dhcp-server/add', $formData);

            if ($response->successful()) {
                return redirect()->route('dhcp.create')->with('formData', $formData);
            } else {
                return response()->json(['error' => 'Failed to create DHCP server.'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error connecting to the device.'], 500);
        }
    }


    public function updateDhcp(Request $request, $id)
    {
        try {
            $routerIp = Session::get('router_ip');

            $validatedData = $request->validate([
                'name' => 'nullable|string',
                'address-pool' => 'nullable|string',
                'authoritative' => 'nullable|string|in:yes,no,after 2s delay,after 10s delay',
                'lease-time' => 'nullable|string',
                'use-radius' => 'nullable|string|in:no,accounting,yes',
            ]);
            $validatedData['interface'] = $request->input('interface');
            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->put('http://' . $routerIp . '/rest/ip/dhcp-server/' . $id, $validatedData);

            if ($response->successful()) {
                return back()->with('success', 'DHCP server successfully updated.');
            } else {
                return back()->withErrors(['error' => 'Failed to update DHCP server data.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error connecting to the device.']);
        }
    }

}

