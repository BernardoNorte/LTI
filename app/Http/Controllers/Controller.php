<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $routerIp;
    public $loginName;
    public $loginPassword;

    public function __construct()
    {
        $this->routerIp = "192.168.1.78";
        $this->loginName = "admin";
        $this->loginPassword = "ltipassword";
        
    }

    public function updateRouterIp($newIp)
    {
        try {
            if (!empty($newIp) && $newIp !== Session::get('router_ip')) {
                Session::put('router_ip', $newIp);
                
                return back();
            }
        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }

       
    }

    public function updateLoginCredentials(Request $request)
    {
        try {
            $this->loginName = $request->input('loginName');
            $this->loginPassword = $request->input('loginPassword');
            
            Session::put('loginName', $this->loginName);
            Session::put('loginPassword', $this->loginPassword);

            return back();
        } catch (\Exception $e) {
            dd($e->getMessage()); 
        }
    }

}
