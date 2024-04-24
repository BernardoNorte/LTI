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
            
            $response = Http::withBasicAuth('admin', 'ltipassword')->get('http://' . $routerIp . '/rest/interface/wireless/security-profiles');

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

    public function store(Request $request)
    {
        try {
            
            $routerIp = Session::get('router_ip');
            ;
            $validatedData = $request->validate([
                'name' => 'required|string',
                'mode' => 'required',
                'authentication-types' => 'nullable',
                'group-key-update' => 'required|regex:/^\d{2}:\d{2}:\d{2}$/',
                'wpa-pre-shared-key' => 'nullable|string',
                'wpa2-pre-shared-key' => 'nullable|string',
                'supplicant-identity' => 'nullable|string',
                'management-protection' => 'nullable',
                'disable-pmkid' => 'nullable|boolean',
            ]);
            
            if ($request->mode === 'dynamic-keys' && !$request->has('authentication-types')) {
                return back()->withErrors(['error' => 'At least one authentication type is required when mode is dynamic keys.']);
            }
            
            
            
           
            
            $response = Http::withBasicAuth('admin', 'ltipassword')
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
}
