<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function home()
    {
        $bukus = Buku::all();
        return view('layouts.home.home', compact('bukus'));
    }

    public function list_book()
    {
        $kategori = Kategori::with('bukus')->get();
        return view('layouts.home.list-buku', ['kategori' => $kategori]);
    }

    public function detail_buku($id)
    {
        $buku = Buku::with(['peminjaman' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->findOrFail($id);
        $kategori = Kategori::all();

        $averageRating = $buku->averageRating();


        return view('layouts.home.detail', compact('buku', 'kategori', 'averageRating'));
    }

    public function bukuAnda()
    {
        $user = Auth::user();

        $buku =  $peminjaman = Peminjaman::with('user', 'buku')->where('user_id', Auth::id())->where('user_id', $user->id)->where('status', 'terima')->get();

        return view('layouts.home.buku-anda', compact('buku'));
    }

    public function infoPengembalian()
    {
        $pengembalian = Pengembalian::with('peminjaman.buku', 'peminjaman.user')->get();
        return view('layouts.home.infopengembalian', compact('pengembalian'));
    }
}
