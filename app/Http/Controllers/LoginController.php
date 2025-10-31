<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //shows login page for general users
    public function index(){
        return view('login');
    }

    //authenticate users
    public function authenticate(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if($validated){
            //authentication logic
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $request->session()->regenerate();
            }
            else{
                return redirect()->route('account.login')->withErrors(['message' => 'Invalid credentials of Email or Password'])->withInput();
            }


        }
        else{
            return redirect()->route('account.login')->withErrors($validated)->withInput();
        }

    }

    public function register()
    {

        return view('register');
    }

    public function processRegister(Request $request)
    {

        $validated = $request->validate([
                            'user' => 'required|string|max:255',
                            'email' => 'required|email|unique:users,email',
                            'password' => 'required|min:6|confirmed',
                        ]);

                        if($validated){
                            //authentication logic
                            $user = new User();

                        }
                        else{
                            return redirect()->route('account.register')->withErrors($validated)->withInput();
                        }



    }
}
