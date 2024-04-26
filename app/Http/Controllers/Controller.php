<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $routerIp;

    public function __construct()
    {
        $this->routerIp = "192.168.1.78"; //192.168.1.143
        
    }

    public function updateRouterIp($newIp)
    {
        try {
            if (!empty($newIp) && $newIp !== Session::get('router_ip')) {
                Session::put('router_ip', $newIp);
                return view("auth.login");
            }
        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }

        return view("auth.login");
    }
}
