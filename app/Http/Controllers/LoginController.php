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
            $credentials = ['email' => $request->email, 'password' => $request->password];
            
            // Try teacher guard first
            if(Auth::guard('teacher')->attempt(array_merge($credentials, ['role' => 'teacher']))){
                return redirect()->route('teacher.dashboard');
            }
            // Try student guard
            elseif(Auth::guard('student')->attempt(array_merge($credentials, ['role' => 'student']))){
                return redirect()->route('student.dashboard');
            }
            else{
                return redirect()->route('account.login')->with('error', 'Invalid credentials of Email or Password')->withInput();
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
                            'role' => 'required|string',
                            'password' => 'required|min:6|confirmed',
                        ]);

                        if($validated){

                            $user = new User();
                            $user->name = $request->user;
                            $user->email = $request->email;
                            $user->password = bcrypt($request->password);
                            $user->role = $request->role;
                            $user->save();
                            return redirect()->route('account.login')->with('success', 'Registration successful. Please login.');

                        }
                        else{
                            return redirect()->route('account.register')->withErrors($validated)->withInput();
                        }



    }

    public function logout(Request $request){
        if(Auth::guard('teacher')->check()){
            Auth::guard('teacher')->logout();
        } elseif(Auth::guard('student')->check()){
            Auth::guard('student')->logout();
        }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('account.login')->with('success', 'Logged out successfully.');
    }
}
