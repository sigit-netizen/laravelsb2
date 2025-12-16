<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // 2. Cek email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar',
            ])->onlyInput('email');
        }

        // 3. Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah',
            ])->onlyInput('email');
        }
        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
