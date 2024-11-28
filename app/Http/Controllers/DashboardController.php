<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return view('dashboard-page.beranda', [
                'totalBuku' => Buku::count(),
                'totalPengguna' => User::count(),
                'totalPeminjaman' => Peminjaman::count(),
                'totalPengembalian' => Pengembalian::count(),
                'bukuStokRendah' => Buku::where('stok', '<', 5)->get(),
            ]);
        }

        if ($role === 'petugas') {
            return view('dashboard-page.beranda', [
                'bukuBaru' => Buku::latest()->take(5)->get(),
                'permintaanPeminjaman' => Peminjaman::where('status', 'menunggu')->get(),
                'BukuBelumdikembalikan' => Peminjaman::where('status', 'terima')->get(),
                'bukuSeringDipinjam' => Buku::withCount('peminjaman')->orderBy('peminjaman_count', 'desc')->take(5)->get(),
                'bukuJarangDipinjam' => Buku::withCount('peminjaman')->orderBy('peminjaman_count', 'asc')->take(5)->get(),
            ]);
        }
    }

    public function userTable()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('dashboard-page.userTable', compact('users'));
    }

    public function userCreate()
    {
        return view('dashboard-page.userCreate');
    }
    public function userStore(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'role' => $request->role
        ]);

        return redirect()->route('user.table')->with('success', 'User berhasil ditambahkan!');
    }

    public function userEdit()
    {
        return view('dashboard-page.userEdit');
    }

    public function userUpdate(Request $request, $id)
    {
        $update = User::findOrFail($id);

        $update->nama_lengkap = $request->nama_lengkap;
        $update->username = $request->username;
        $update->email = $request->email;
        $update->alamat = $request->alamat;
        $update->role = $request->role;

        $update->save();

        return redirect()->route('user.table')->with('success', 'User berhasil diupdate!');
    }

    public function userDelete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('user.table')->with('success', 'User berhasil dihapus!');
    }
}
