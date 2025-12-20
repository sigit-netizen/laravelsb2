<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use function Laravel\Prompts\alert;

class UsersController extends Controller
{
    public function index()
    {
        return view('front.dashboarduser');
    }

    public function panen()
    {
        return view('front.grafik');
    }

    public function input_panen(Request $request)
    {
        // $request->validate([
        //     'jenis_panen' => 'required|string|max:255',
        //     'tanggal_panen' => 'required|date',
        //     'jumlah_panen' => 'required|integer',
        // ]);

        // $panen = new \App\Models\Panen();
        // $panen->users_id = auth()->user()->id;
        // $panen->jenis_panen = $request->jenis_panen;
        // $panen->tanggal_panen = $request->tanggal_panen;
        // $panen->jumlah_panen = $request->jumlah_panen;
        // $panen->save();

        // return redirect()->route('usershome')->with('success', 'Data panen berhasil ditambahkan.');
    }

}
