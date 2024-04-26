<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{

    public function index()
    {
        session(['router_ip' => $this->routerIp]);
        try {
            $routerIp = Session::get('router_ip');

            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/ip/address');

            if ($response->successful()) {
                $addresses = $response->json();
                return view('addresses.index', compact('addresses'));
            } else {
                return response()->json(['error' => 'Falha ao obter os endereços ip'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }

    public function create()
    {
    try {

       $interfacesController = new InterfacesController();
       $interfacesView = $interfacesController->index();

       $interfacesArray = $interfacesView->getData()['interfaces'];

           $interfaceNames = array_map(function ($interface) {
           return $interface['name'];
       }, $interfacesArray);

        return view('addresses.create', ['interfaceNames' => $interfaceNames]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
    }
}

public function store(Request $request)
{
    try {
        $routerIp = Session::get('router_ip');

        $validatedData = $request->validate([
            'address' => 'required|string',
            'interface' => 'required|string',
            'network' => 'required|string',
        ]);

        $formData = [
            'address' => $validatedData['address'],
            'interface' => $validatedData['interface'],
            'network' => $validatedData['network'],
        ];

        $response = Http::withBasicAuth('admin', 'ltipassword')
            ->post('http://' . $routerIp . '/rest/ip/address/add', $formData);

        if ($response->successful()) {
            return redirect()->route('address.create')->with('success', 'Address created successfully.');
        } else {
            return back()->withErrors(['error' => 'Failed to create address.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error connecting to the device.']);
    }
}
    public function deleteAddress($id)
    {
        try {
            $routerIp = Session::get('router_ip');

            $response = Http::withBasicAuth('admin', 'ltipassword')->delete('http://' . $routerIp . '/rest/ip/address/' . $id);

            if ($response->successful()) {

                return back()->with('success', 'Endereço ip excluído com sucesso!');
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
            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/ip/address/' . $id);

            if ($response->successful()) {

                $address = $response->json();

                return view('addresses.edit', compact('id', 'address'));
            } else {

                return back()->withErrors(['error' => 'Failed to fetch interface data.']);
            }
        } catch (\Exception $e) {

            return back()->withErrors(['error' => 'Error connecting to the device.']);
        }
    }

    public function updateAddress(Request $request, $id)
    {
        try {
            $routerIp = Session::get('router_ip');

            $validatedData = $request->validate([
                'address' => 'nullable|string',
                'network' => 'nullable|string',
            ]);

            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->patch('http://' . $routerIp . '/rest/ip/address/' . $id, $validatedData);

            if ($response->successful()) {
                return back()->with('success', 'Address successfully updated.');
            } else {
                return back()->withErrors(['error' => 'Failed to update address data.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error connecting to the device.']);
        }
    }


}

