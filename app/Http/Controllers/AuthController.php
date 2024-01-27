<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;

class AuthController extends Controller
{
    use AuthenticatesUsers;

   
    public function index(Request $request)
    {
		return view('index');
	}

    public function doLogin(Request $request){
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (\Auth::guard('admin')->attempt($request->only(['username','password']), $request->get('remember'))){
           return redirect()->intended('dashboard');
        }

        return redirect()->route('login')->withErrors(['message1'=>'The Username Or Password Is Incorrect']);
        
	}

    public function logout(Request $request)
    {
		Session::flush();
         auth()->guard('admin')->logout();
        return redirect()->route('login')->with('message1', 'Logout Successfully');	
	}

    
}
