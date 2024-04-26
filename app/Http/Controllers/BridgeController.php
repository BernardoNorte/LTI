<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class BridgeController extends Controller
{
    public function index()
    {
        try {
            $routerIp = Session::get('router_ip');
            
            
            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/interface/bridge');
            $interfaces = $response->json();

            
            $responseWithPort = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/interface/bridge/port');
            $ports = $responseWithPort->json();
            
            
            $interfacesWithPorts = [];
            foreach ($interfaces as $interface) {
                $interfaceName = $interface['name'];
                $interfacePorts = [];

                
                foreach ($ports as $port) {
                    if ($port['bridge'] === $interfaceName) {
                        $interfacePorts[] = $port;
                    }
                }

                
                $interfacesWithPorts[] = [
                    'interface' => $interface,
                    'ports' => $interfacePorts
                ];
            }

            return view('bridge.index', compact('interfacesWithPorts'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }


    public function create(): View
    {
        return view('bridge.create');
    }

    public function store(Request $request)
{
    try {
        $routerIp = Session::get('router_ip');

        $validatedData = $request->validate([
            'name' => 'required|string',
            'arp' => 'required|string',
            'ageing-time' => 'required|regex:/^\d{2}:\d{2}:\d{2}$/',
            'fast-forward' => 'nullable:boolean',
            'igmp-snooping' => 'nullable:boolean',
            'dhcp-snooping' => 'nullable:boolean',
            'dhcp-snooping82' => 'nullable:boolean',
        ]);

        
        $defaultValues = [
            "arp-timeout" => "auto",
            "auto-mac" => "true",
            "comment" => "defconf",
            "disabled" => "false",
            "forward-delay" => "15s",
            "max-message-age" => "20s",
            "port-cost-mode" => "long",
            "priority" => "0x8000",
            "protocol-mode" => "rstp",
            "fast-forward" => "false",
        ];

        
        if (isset($validatedData['fast-forward'])) {
            unset($defaultValues["fast-forward"]);
        }

        
        $formData = array_merge($defaultValues, $validatedData);
        
        $response = Http::withBasicAuth('admin', 'ltipassword')
            ->post('http://' . $routerIp . '/rest/interface/bridge/add', $formData);

        if ($response->successful()) {
            return back();
        } else if ($response->status() === 400 && $response['detail'] === "failure: already have interface with such name") {
            return back()->withErrors(['error' => 'Name already in use.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error connecting to the device.']);
    }
}





public function edit($id)
{
    try {
        $routerIp = Session::get('router_ip');

        $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/interface/bridge/' . $id);
        
        if ($response->successful()) {
            
            $bridge = $response->json();
            
            return view('bridge.edit', compact('id', 'bridge'));
        } else {
            
            return back()->withErrors(['error' => 'Failed to fetch interface data.']);
        }
    } catch (\Exception $e) {
        
        return back()->withErrors(['error' => 'Error connecting to the device.']);
    }
}





public function updateBridge(Request $request, $id)
{
    try {
        $routerIp = Session::get('router_ip');

        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'mtu' => 'nullable|integer',
            'arp' => 'nullable|string',
            'ageing-time' => 'nullable|string',
            'igmp-snooping' => 'nullable|string',
            'dhcp-snooping' => 'nullable|string',
            'fast-forward' => 'nullable|string',
        ]);

        $validatedData['igmp-snooping'] = isset($validatedData['igmp-snooping']) ? 'true' : 'false';
        $validatedData['dhcp-snooping'] = isset($validatedData['dhcp-snooping']) ? 'true' : 'false';
        $validatedData['fast-forward'] = isset($validatedData['fast-forward']) ? 'true' : 'false';
       
        $response = Http::withBasicAuth('admin', 'ltipassword')
                        ->patch('http://' . $routerIp . '/rest/interface/bridge/' . $id, $validatedData);
        
        if ($response->successful()) {
            return back()->with('success', 'Interface successfully updated.');
        } else {
            return back()->withErrors(['error' => 'Failed to update interface data.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error connecting to the device.']);
    }
}


public function deleteBridge($id)
{
    try {
        $routerIp = Session::get('router_ip');
            
        $response = Http::withBasicAuth('admin', 'ltipassword')->delete('http://' . $routerIp . '/rest/interface/bridge/' . $id);
            
        if ($response->successful()) {
                
            return back()->with('success', 'Interface bridge excluída com sucesso!');
        } else {
            return back()->withErrors(['error' => 'Erro ao processar o pedido. Por favor, tente novamente.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Erro ao conectar ao dispositivo.']);
    }
}

}
