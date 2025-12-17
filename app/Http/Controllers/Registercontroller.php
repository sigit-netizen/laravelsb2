<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation;
use App\Models\User;

class Registercontroller extends Controller
{
    public function index(){
        return view('register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:Users,email',
            'password'=> 'required'
        ]);


        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password)
        ]);
        if($validated){
            return redirect()->route('login');

        }
    }
}
