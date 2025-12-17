<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbkategori;

class KategoriController extends Controller
{
    public function index()
    {
        return view('front.kategori');
    }

    public function input_data(Request $request){

        tbkategori::create([
            'kategori'=> $request->kategori,
        ]);
        return redirect()->route('kategori');

        }


}
