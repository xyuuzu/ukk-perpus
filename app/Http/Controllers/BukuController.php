<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrInterface;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::all();
        return view('buku.tabel', compact('bukus'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('buku.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'required| mimes:jpg,jpeg,png,jfif',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahunTerbit' => 'required',
            'kategori_id' => 'required',
        ]
    ,
    [
        'judul.required' => 'Judul harus diisi.',
        'gambar.required' => 'Gambar harus diisi.',
        'penulis.required' => 'Penulis harus diisi.',
        'penerbit.required' => 'Penerbit harus diisi.',
        'tahunTerbit.required' => 'Tahun terbit harus diisi.',
        'kategori_id.required' => 'Kategori harus dipilih.',

    ]);

        $file = $request->file('gambar');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('storage/gambar/', $filename);
        $gambar = $filename;

      Buku::create([
            'judul' => $request->judul,
            'gambar' => $gambar,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahunTerbit' => $request->tahunTerbit,
            'kategori_id' => $request->kategori_id,
        ]);

        toastr('Buku berhasil ditambahkan!.');

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }


    public function edit(Buku $buku)
    {
        $kategoris = Kategori::all();
        return view('buku.edit', compact('buku','kategoris'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $update = Buku::findOrFail($id);

        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            unlink('storage/gambar/' . $update->gambar);
            $name = $file->getClientOriginalName();
            $path = 'storage/gambar/';
            $file->move($path, $name);
            $update['gambar'] = $name;
        }

        $update->judul = $request->judul;
        $update->penulis = $request->penulis;
        $update->penerbit = $request->penerbit;
        $update->tahunTerbit = $request->tahunTerbit;

        $update->update();

        toastr('Buku berhasil diubah!.');


        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        $gambar = $buku->gambar;
        unlink('storage/gambar/' . $gambar);
        $buku->delete();
        
        toastr('Buku berhasil dihapus!.');

        return redirect()->route('buku.index');
    }
}
