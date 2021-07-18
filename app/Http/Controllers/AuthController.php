<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validate email & password
        $validated = $request->validate([
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);

        // check if user is authenticated
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // user is authenticated and login and redirected to home page
            return redirect('/');
        } else {
            // error in login email or password and redirect to login with error
            $error = "Invalid Email or Password";
            $oldEmail = $request->email;
            return view('login', compact('error', 'oldEmail'));
        }
    }

    public function logout()
    {
        // logout user
        Auth::logout();
        return redirect('/login');
    }
}
