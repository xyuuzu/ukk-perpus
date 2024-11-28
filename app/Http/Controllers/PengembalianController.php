<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrInterface;


class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with('peminjaman.buku', 'peminjaman.user')->get();
        return view('pengembalian.index ', compact('pengembalian'));
    }

    public function create($id)
    {
        $peminjaman = Peminjaman::with('user', 'buku')->findOrFail($id);
        return view('pengembalian.kembalian', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'peminjaman_id' => 'required|exists:peminjamen,id',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_buku' => 'required|string|max:255',
        ]);
    
        $peminjaman = Peminjaman::find($validated['peminjaman_id']);
        $tanggalPengembalian = Carbon::parse($validated['tanggal_pengembalian']);
        $tanggalKembali = Carbon::parse($peminjaman->tanggalKembali);
    
        // Tentukan status berdasarkan perbandingan tanggal
        $status = $tanggalPengembalian->greaterThan($tanggalKembali) ? 'terlambat' : 'tepat_waktu';
    
        // Hitung denda jika terlambat
        $denda = 0;
        if ($status === 'terlambat') {
            $selisihHari = $tanggalPengembalian->diffInDays($tanggalKembali);
            $denda = $selisihHari * 1000; // Tarif denda per hari
        }
    
        // Simpan data pengembalian
        Pengembalian::create([
            'peminjaman_id' => $validated['peminjaman_id'],
            'tanggal_pengembalian' => $validated['tanggal_pengembalian'],
            'kondisi_buku' => $validated['kondisi_buku'],
            'status' => $status,
            'denda' => $denda,
        ]);
    
        $peminjaman->update([
            'status' => 'dikembalikan',
        ]);
    
        toastr('Buku berhasil dikembalikan.');
    
        // Redirect dengan pesan sukses
        return redirect()->route('pengembalian.index');
    }
    


    public function manual()
    {
        $peminjaman = Peminjaman::where('status', 'terima')->get(); 
        return view('pengembalian.manual', compact('peminjaman'));
    }
}
