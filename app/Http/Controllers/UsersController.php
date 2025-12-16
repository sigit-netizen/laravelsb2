<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use function Laravel\Prompts\alert;

class UsersController extends Controller
{
    public function Tampil_data()
    {
        $users = User::all();
        return view('welcome', compact('users'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('home');
    }

    public function edit($id)
    {

        $user = User::findOrFail($id);
        return view('editUser', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'password' => 'nullable|min:8',
        ]);

        $user = User::findOrFail($id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('home');
    }
}
