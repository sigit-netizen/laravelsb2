<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backend.tableuser', compact('users'));
    }
        public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('adminhome')->with('success', 'User berhasil dihapus.');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,',
            'password' => 'nullable|min:8',
        ]);

        $user = User::findOrFail($id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('adminhome')->with('success', 'User berhasil dihapus.')->with('success', 'User berhasil diperbarui.');
    }
    public function tambah_user(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role'     => 'string|max:25',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()->route('adminhome')->with('success', 'User berhasil dihapus.')->with('success', 'User berhasil ditambahkan.');
    }
}
