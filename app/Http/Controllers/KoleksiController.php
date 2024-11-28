<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksiController extends Controller
{
    public function index()
    {
        $koleksi = Koleksi::where('user_id', Auth::id())->get();

        return view('layouts.home.koleksi', compact('koleksi'));
    }
    public function toggleKoleksi($buku_id)
    {
        $koleksi = Koleksi::where('buku_id', $buku_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($koleksi) {
            $koleksi->delete();
        } else {
            Koleksi::create([
                'buku_id' => $buku_id,
                'user_id' => Auth::id(),
                'status' => 'terdaftar', 
            ]);
        }

        return redirect()->back();
    }
}
