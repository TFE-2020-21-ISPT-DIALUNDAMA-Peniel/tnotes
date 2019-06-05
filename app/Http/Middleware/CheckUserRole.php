<?php

namespace App\Http\Middleware;
// use App\Models\Users_role;
use App\Http\Controllers\Helper;
use Illuminate\Support\Facades\Auth;


use Closure;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $reponse = $next($request);
        // if(auth()->check()){
        //    $role = Users_role::find(auth()->user()->idusers_roles);
           // $prefixe = Helper::getPrefixeRoute($request);
        //    $prefixe = trim(\Route::current()->action['prefix'],'/');
        //    if ($role->lib != $prefixe) {
        //        return redirect()->route($role->lib.'.index');
        //    }
        // }
        return $reponse;
    }
}
