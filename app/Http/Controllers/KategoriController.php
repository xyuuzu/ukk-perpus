<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrInterface;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.tabel', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama' => $validated['nama'],
        ]);
        
        toastr('Kategori berhasil ditambahkan!.');

        return redirect()->route('buku.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $kategori = Kategori::findOrFail($kategori->id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori->update([
            'nama' => $validated['nama'],
        ]);

        toastr('Kategori berhasil diubah!.');

        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        toastr('Buku berhasil dihapus!.');

        return redirect()->route('kategori.index');
    }
}
