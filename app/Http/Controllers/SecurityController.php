<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class SecurityController extends Controller
{
    public function index()
    {
        session(['router_ip' => $this->routerIp]);
        try {
            $routerIp = Session::get('router_ip');
            $loginName = Session::get('loginName');
            $loginPassword = Session::get('loginPassword');
            
            $response = Http::withBasicAuth($loginName, $loginPassword)->get('http://' . $routerIp . '/rest/interface/wireless/security-profiles');

            if ($response->successful()) {
                $profiles = $response->json();
                
                return view('security.index', compact('profiles'));
            } else {
                return response()->json(['error' => 'Falha ao obter os perfis'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao conectar ao dispositivo'], 500);
        }
    }

    public function create(): View
    {
        return view('security.create');
    }

    public function edit($id): View
{
    try {
        $routerIp = Session::get('router_ip');
        $loginName = Session::get('loginName');
        $loginPassword = Session::get('loginPassword');
        $response = Http::withBasicAuth($loginName, $loginPassword)->get('http://' . $routerIp . '/rest/interface/wireless/security-profiles/' . $id);
        
        if ($response->successful()) {
            
            $profile = $response->json();
            
            return view('security.edit', compact('id', 'profile'));
        } else {
            
            return back()->withErrors(['error' => 'Failed to fetch interface data.']);
        }
    } catch (\Exception $e) {
        
        return back()->withErrors(['error' => 'Error connecting to the device.']);
    }
}

public function updateSecurityProfile(Request $request, $id)
{
    try {
        $routerIp = Session::get('router_ip');
        $loginName = Session::get('loginName');
        $loginPassword = Session::get('loginPassword');
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'mode' => 'nullable',
            'authentication-types' => 'nullable|array',
            'authentication-types.*' => 'string',
            'group-ciphers' => 'nullable|array',
            'group-ciphers.*' => 'string',
            'unicast-ciphers' => 'nullable|array',
            'unicast-ciphers.*' => 'string',
            'group-key-update' => 'nullable|regex:/^\d{2}:\d{2}:\d{2}$/',
            'wpa-pre-shared-key' => 'nullable|string',
            'wpa2-pre-shared-key' => 'nullable|string',
            'supplicant-identity' => 'nullable|string',
            'management-protection' => 'nullable',
            'disable-pmkid' => 'nullable',
            'management-protection-key' => 'nullable'
        ]);

        if ($request->mode === 'dynamic-keys' && !$request->has('authentication-types')) {
            return back()->withErrors(['error' => 'At least one authentication type is required when mode is dynamic keys.']);
        }

        if ($request->mode === 'dynamic-keys') {
            
            $validatedData['authentication-types'] = implode(',', $validatedData['authentication-types']);
            $validatedData['group-ciphers'] = implode(',', $validatedData['group-ciphers']);
            $validatedData['unicast-ciphers'] = implode(',', $validatedData['unicast-ciphers']);
        }
        
        $validatedData['disable-pmkid'] = $request->has('disable-pmkid') ? "true" : "false";


        $response = Http::withBasicAuth($loginName, $loginPassword)
            ->patch('http://' . $routerIp . '/rest/interface/wireless/security-profiles/' . $id, $validatedData);

        if ($response->successful()) {
            return back()->with('success', 'Security profile successfully updated.');
        } else {
            return back()->withErrors(['error' => 'Failed to update security profile data.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error connecting to the device.']);
    }
}


public function store(Request $request)
{
    try {
        $routerIp = Session::get('router_ip');
        $loginName = Session::get('loginName');
        $loginPassword = Session::get('loginPassword');

        $validatedData = $request->validate([
            'name' => 'required|string',
            'mode' => 'required',
            'authentication-types' => 'nullable|array',
            'authentication-types.*' => 'string',
            'group-ciphers' => 'nullable|array',
            'group-ciphers.*' => 'string',
            'unicast-ciphers' => 'nullable|array',
            'unicast-ciphers.*' => 'string',
            'group-key-update' => 'required|regex:/^\d{2}:\d{2}:\d{2}$/',
            'wpa-pre-shared-key' => 'nullable|string',
            'wpa2-pre-shared-key' => 'nullable|string',
            'supplicant-identity' => 'nullable|string',
            'management-protection' => 'nullable',
            'disable-pmkid' => 'nullable',
            'management-protection-key' => 'nullable'
        ]);
        
        if ($request->mode === 'dynamic-keys') {
            
            $validatedData['authentication-types'] = implode(',', $validatedData['authentication-types']);
            $validatedData['group-ciphers'] = implode(',', $validatedData['group-ciphers']);
            $validatedData['unicast-ciphers'] = implode(',', $validatedData['unicast-ciphers']);
        }
        
        if ($request->mode === 'dynamic-keys' && !$request->has('authentication-types')) {
            return back()->withErrors(['error' => 'At least one authentication type is required when mode is dynamic keys.']);
        }

        $validatedData['disable-pmkid'] = isset($validatedData['disable-pmkid']) ? 'true' : 'false';
        
        $response = Http::withBasicAuth($loginName, $loginPassword)
            ->post('http://' . $routerIp . '/rest/interface/wireless/security-profiles/add', $validatedData);

        if ($response->successful()) {
            return back();
        } else if ($response->status() === 400 && $response['detail'] === "failure: profile with the same name already exists") {
            return back()->withErrors(['error' => 'Name already in use.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Error connecting to the device.']);
    }
}



public function deleteSecurity($id)
{
    try {
        $routerIp = Session::get('router_ip');
        $loginName = Session::get('loginName');
        $loginPassword = Session::get('loginPassword');
        
        $response = Http::withBasicAuth($loginName, $loginPassword)->delete('http://' . $routerIp . '/rest/interface/wireless/security-profiles/' . $id);
            
        if ($response->successful()) {
                
            return back()->with('success', 'Security profile deleted with success!');
        } else {
            return back()->withErrors(['error' => 'Erro ao processar o pedido. Por favor, tente novamente.']);
        }
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Erro ao conectar ao dispositivo.']);
    }
}

}
