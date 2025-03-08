<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login(Request $request) {
        // Validate the incoming login request data
//        $request->validate([
//            'email' => 'required|email',
//            'password' => 'required|min:8',
//        ]);
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('loginView')->withErrors($validator);
        }

        // Attempt to authenticate the user using email and password
        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Store user data in session if authentication is successful
            session(['userData' => $user]);
            return redirect()->route('homeView');
        }

        // If authentication fails, redirect back with an error message
        return redirect()->route('loginView')->withErrors(['email' => 'Invalid email or password.']);
    }

    public function logout()
    {
        // Logout the user and clear the session
        Auth::logout();
        session()->forget('userData');
        return redirect()->route('loginView');
    }
}
