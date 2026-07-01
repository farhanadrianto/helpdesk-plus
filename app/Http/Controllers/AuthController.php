<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login Page
    public function index()
    {
        if(session()->has('role')){

            if(session('role') == 'admin'){
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return view('auth.login');
    }

    // Login Process
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('users')
                    ->where('email', $request->email)
                    ->first();

        if(!$user){
            return back()
                    ->withInput()
                    ->with('error','Email tidak ditemukan.');
        }

        if ($request->password != $user->password) {
            return back()
                    ->withInput()
                    ->with('error','Password salah.');
        }

        session([
            'id' => $user->id,
            'employee_id' => $user->employee_id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ]);

        if($user->role == 'admin'){
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

public function register()
{
    return view('auth.register');
}

public function registerProcess(Request $request)
{
    DB::table('users')->insert([

        'employee_id' => 'EMP'.rand(1000,9999),

        'name' => $request->name,

        'email' => $request->email,

        'phone' => $request->phone,

        'password' => $request->password,

        'department' => $request->department,

        'role' => 'user',

        'created_at' => now(),
        'updated_at' => now()

    ]);

        return redirect()
            ->route('login')
            ->with('success','Registration successful. Please sign in.');
}
}