<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Flasher\Toastr\Prime\ToastrInterface;


class PeminjamanController extends Controller
{
    public function pinjamBuku(Request $request, $id)
    {
        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $id,
            'status' => 'menunggu',
        ]);

        toastr('Permintaan peminjaman buku berhasil dikirim!.');


        return redirect()->back();
    }

    public function listPermintaan()
    {
        $permintaan = Peminjaman::with('user', 'buku')->where('status', 'menunggu')->get();
        return view('peminjaman.list-permintaan', compact('permintaan'));
    }

    public function listPeminjaman()
    {
        $peminjaman = Peminjaman::with('user', 'buku')->get();
        return view('peminjaman.list-peminjaman', compact('peminjaman'));
    }

    public function terimaPeminjaman($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->update([
            'status' => 'terima',
            'tanggalPinjam' => Carbon::now()->format('Y-m-d'),
            'tanggalKembali' => Carbon::now()->addDays(7)->format('Y-m-d'),
        ]);

        toastr('Peminjaman berhasil diterima!.');


        return redirect()->back();
    }

    public function tolakPeminjaman($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->update([
            'status' => 'tolak',
        ]);

        toastr('Peminjaman telah ditolak!.');


        return redirect()->back();
    }

    public function formmanualCreate()
    {
        $bukus = Buku::all();
        $users = User::all();
        return view('peminjaman.manualCreate', compact('bukus', 'users'));
    }

    public function manualCreate(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggalPinjam' => 'required|after_or_equal:today',
            'tanggalKembali' => 'required|after_or_equal:tanggalPinjam|before_or_equal:tanggalKembali',
        ],
        [
            'user_id.required' => 'Pengguna harus dipilih.',
            'buku_id.required' => 'Buku harus dipilih.',
            'tanggalPinjam.required' => 'Tanggal peminjaman harus diisi.',
            'tanggalPinjam.after_or_equal' => 'Tanggal peminjaman harus setelah hari ini.',
            'tanggalKembali.required' => 'Tanggal pengembalian harus diisi.',
            'tanggalKembali.after_or_equal' => 'Tanggal pengembalian harus setelah tanggal peminjaman.',
            'tanggalKembali.before_or_equal' => 'Tanggal pengembalian harus sebelum tanggal kembali.',
        ]);

        Peminjaman::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'status' => 'terima',
            'tanggalPinjam' => $request->tanggalPinjam,
            'tanggalKembali' => $request->tanggalKembali,
        ]);

        toastr('Peminjaman berhasil dibuat.');

        return redirect()->route('list-peminjaman');
    }
}
