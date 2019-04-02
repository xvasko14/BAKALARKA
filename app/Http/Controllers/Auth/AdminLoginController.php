<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class AdminLoginController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest:admin');
	}
    public function showLoginForm()
    {
    	return view('auth.admin-login');
    }
    // nefunguje podla predstav hadze ma to na home 
    public function logout(Request $request) {
       //echo "test"; die;
      //Auth::logout();
      return redirect('auth.admin-login');
    }


    /*public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Invalid Username or Password'); 
        //return view('auth.admin-login');
    }*/

    public function login(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'

    	]);

        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
            {
            return redirect()-> intended(route('admin.dashboard'));  // po logien nas directne spravne kde ma, na dashboard
            }
            else {
                // zatial nefunguje, musim vyriesit !! TO DO !!
            return redirect('/admin')->with('flash_message_error','Invalid Username or Password'); // vratime chybu ak zle zadane parametre
            }
        }

    	return redirect()->back()->withInput($request->only('email', 'remember'));

    }
}



//stara funkcna verzia
 /*public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'

        ]);

            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return redirect()-> intended(route('admin.dashboard'));
        }

        

        return redirect()->back()->withInput($request->only('email', 'remember'));

    }*/