<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login_form');
    }

    public function login(Request $request)
    {
        $admin = $request->all();
        if(Auth::guard('admin')->attempt(
            [
                'email' => $admin['email'],
                'password' => $admin['password']
            ]
        )){
            return redirect()->route('admin_dashboard')->with('success', 'Logged Successfully');
        }
        else{
            return back()->with('error', 'Invalid Email or Password');
        }

    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_dashboard');
    }
}
