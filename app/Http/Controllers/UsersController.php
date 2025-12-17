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
        return view('backend.tableuser', compact('users'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('home');
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
    public function tambah_user(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email', 
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('home')->with('success', 'User berhasil ditambahkan.');
    }
}
