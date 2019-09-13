<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class TitulairesLoginController extends Controller
{
    use AuthenticatesUsers;
   
    protected $guard = 'titulaires';

    protected $redirectTo = '/professeur';

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function guard()
    {
      return Auth::guard('titulaires');
    }

    public function showLoginForm(){
    	return view('auth.titulairesLogin');
    }

    public function login(Request $request){
    	if(auth()->guard('titulaires')->attempt(['pseudo' => $request->pseudo,'password'=>$request->password]))
    	{
          return redirect($this->redirectTo());
    	}

    	return back()->withErrors(['pseudo'=>'Pseudo ou mot de passe invalide.']);

    }


    public function username()
    {
        return 'pseudo';
    }

    protected function redirectTo(){
      return route('professeur.index');
    }

}
