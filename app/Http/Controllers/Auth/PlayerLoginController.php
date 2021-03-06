<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PlayerLoginController extends Controller
{

	public function __construct()

	{  // nesom si sity co je guest:player
		$this->middleware('guest:player');
	}
    public function showLoginForm()
    {
    	return view('auth.player-login');
    }

    public function login(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'

    	]);


    	if(Auth::guard('player')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
    	{
    		return redirect()-> intended(route('player.dashboard'));
    	}


    	return redirect()->back()->withInput($request->only('email', 'remember'));

    }
}
