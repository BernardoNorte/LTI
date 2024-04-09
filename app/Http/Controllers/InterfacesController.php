<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InterfacesController extends Controller
{
    public function index()
    {
        $response = Http::get('http://10.20.139.25/rest/interface');

        if ($response->successful()) {
            $interfaces = $response->json();
            return view('interfaces', compact('interfaces'));
        } else {
            return response()->json(['error' => 'Falha ao obter as interfaces'], $response->status());
        }
    }

}
