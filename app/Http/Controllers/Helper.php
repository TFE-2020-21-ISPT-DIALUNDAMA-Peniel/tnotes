<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Helper extends Controller
{
    public static function  getPrefixeRoute($request){
    	if (!empty($request->server()['PATH_INFO'])) {
			$path_info = $request->server()['PATH_INFO'];
		    $path_info =trim($path_info,'/');
		    $prefixe = explode('/',$path_info)[0];
		   
		    return $prefixe;
    	}
    	return '';
    }

    public static function getUserRole(){
    	if(auth()->check()){
    		$role = \App\Models\Users_role::find(auth()->user()->idusers_roles);
    		return $role->lib;
    	}
    	return '';
    }

    public static function redirectToDashboard(){
    	if(auth()->check()){
    		return redirect()->route(self::getUserRole().'.index');
    	}
    	return redirect()->route("login");
    }

}
