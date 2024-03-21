<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController
{
    public function loginForm()
    {
        return view('manager.login_form');
    }

    public function login(Request $request)
    {
        $manager = $request->all();
        if(Auth::guard('manager')->attempt(
            [
                'email' => $manager['email'],
                'password' => $manager['password']
            ]
        )){
            return redirect()->route('manager_dashboard')->with('success', 'Logged Successfully');
        }
        else{
            return back()->with('error', 'Invalid Email or Password');
        }

    }

    public function dashboard()
    {
        return view('manager.dashboard');
    }

    public function logout()
    {
        Auth::guard('manager')->logout();
        return redirect()->route('manager_dashboard');
    }
}
