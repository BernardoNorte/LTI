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
            $routerIp = Session::get('router_ip');
            ;
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

    public function create()
    {
        return view('routes.create');
    }

    public function store(Request $request)
    {
        try {
            $routerIp = Session::get('router_ip');

            $validatedData = $request->validate([
                'dst-address' => 'required|string',
                'gateway' => 'required|string',
            ]);

            $formData = array_merge( $validatedData);

            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->post('http://' . $routerIp . '/rest/ip/route/add', $formData);

            if ($response->successful()) {
                return back()->with('success', 'Route successfully created.');
            } else {
                return back()->withErrors(['error' => 'Failed to create route.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error connecting to the device.']);
        }
    }

    public function deleteRoute($id)
    {
        try {
            $routerIp = Session::get('router_ip');

            $response = Http::withBasicAuth('admin', 'ltipassword')->delete('http://' . $routerIp . '/rest/ip/route/' . $id);

            if ($response->successful()) {

                return back()->with('success', 'Rota estática excluída com sucesso!');
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
            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/ip/route/' . $id);

            if ($response->successful()) {

                $routes = $response->json();

                return view('routes.edit', compact('id', 'routes'));
            } else {

                return back()->withErrors(['error' => 'Failed to fetch interface data.']);
            }
        } catch (\Exception $e) {

            return back()->withErrors(['error' => 'Error connecting to the device.']);
        }
    }

    public function updateRoute(Request $request, $id)
    {
        try {
            $routerIp = Session::get('router_ip');

            $validatedData = $request->validate([
                'dst-address' => 'nullable|string',
                'gateway' => 'nullable|string',
            ]);

            $response = Http::withBasicAuth('admin', 'ltipassword')
                ->patch('http://' . $routerIp . '/rest/ip/route/' . $id, $validatedData);

            if ($response->successful()) {
                return back()->with('success', 'Route successfully updated.');
            } else {
                return back()->withErrors(['error' => 'Failed to update route data.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error connecting to the device.']);
        }
    }

}
