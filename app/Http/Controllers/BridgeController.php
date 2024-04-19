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

        // Dados validados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string',
            'arp' => 'required|string', 
        ]);

        // Valores padrão
        $defaultValues = [
            "arp-timeout" => "auto",
            "auto-mac" => "true",
            "comment" => "defconf",
            "disabled" => "false",
            "fast-forward" => "true",
            "forward-delay" => "15s",
            "igmp-snooping" => "false",
            "max-message-age" => "20s",
            "port-cost-mode" => "long",
            "priority" => "0x8000",
            "protocol-mode" => "rstp"
        ];

        // Mescla os dados validados com os valores padrão
        $formData = array_merge($defaultValues, $validatedData);

        // Faça a solicitação POST usando o Laravel HTTP Client
        $response = Http::withBasicAuth('admin', 'ltipassword')
            ->post('http://' . $routerIp . '/rest/interface/bridge/add', $formData);

        // Verifique se a solicitação foi bem-sucedida
        if ($response->successful()) {
            return back();
        } else {
            // Lida com erros de solicitação mal sucedida
            return back()->withErrors(['error' => 'Erro ao processar o pedido. Por favor, tente novamente.']);
        }
    } catch (\Exception $e) {
        // Lida com exceções durante a solicitação
        return back()->withErrors(['error' => 'Erro ao conectar ao dispositivo.']);
    }
}



    public function deleteBridge($id)
{
    try {
        $routerIp = Session::get('router_ip');
        // Use o endpoint correto para excluir a interface com o ID fornecido
        $response = Http::withBasicAuth('admin', 'ltipassword')->delete('http://' . $routerIp . '/rest/interface/bridge/' . $id);

        // Verifique se a solicitação foi bem-sucedida
        if ($response->successful()) {
            // Lógica adicional se necessário
            return back()->with('success', 'Interface bridge excluída com sucesso!');
        } else {
            return back()->withErrors(['error' => 'Erro ao processar o pedido. Por favor, tente novamente.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Erro ao conectar ao dispositivo.']);
    }
}

}
