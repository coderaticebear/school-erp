<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }
    public function register(Request $request) {
        //$request->validate([]);
        $validator = Validator::make($request->all(), [
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // Explicitly check if user already exists
        $existingUser = User::where('email', $request->input('email'))->first();

        if ($existingUser) {
            // If the user already exists, redirect back with a custom error message
            return redirect()->route('registerView')
                ->withErrors(['email' => 'This email is already registered.'])
                ->withInput();
        }
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            UserDetail::create([
                'user_id' => $user->id,
                'role_id' => 1,
                'first_name' => $request->input('f_name'),
                'last_name' => $request->input('l_name'),
                'middle_name' => $request->input('m_name'),
            ]);
            DB::commit();
            return redirect()->route('homeView');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('registerView')->withErrors(['error' => "Something went wrong"]);
        }
    }

}
