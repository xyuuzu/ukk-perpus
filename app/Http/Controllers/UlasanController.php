<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrInterface;


class UlasanController extends Controller
{
    
    public function storeUlasan(Request $request, $bukuId)
    {
        $request->validate([
            'ulasan' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        $user = auth()->user();
    
        // Cek apakah pengguna sudah memberi ulasan pada buku ini
        $existingUlasan = Ulasan::where('buku_id', $bukuId)->where('user_id', $user->id)->first();
    
        if ($existingUlasan) {
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk buku ini.');
        }
    
        // Simpan ulasan baru
        Ulasan::create([
            'buku_id' => $bukuId,
            'user_id' => $user->id,
            'ulasan' => $request->ulasan,
            'rating' => $request->rating,
        ]);

        toastr('Ulasan berhasil dikirim!.');

    
        return redirect()->back();
    }
    
}
