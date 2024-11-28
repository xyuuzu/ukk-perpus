<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Buku;
use App\Models\User;

class LaporanController extends Controller
{
    public function pengembalian(){
        $returns = Pengembalian::all();
        $returnsCount = Pengembalian::count();
        $data = [
            'title' => "Laporan Pengembalian",
            'date' => date('d-m-Y'),
            'returns' => $returns,
            'returnCount' => $returnsCount,
        ];
        $date = date('d-m-Y');
        $pdf = PDF::loadView('laporan.pengembalian-pdf',$data);
        return $pdf->stream('pengembalian-report-'.$date.'.pdf');
    }

    public function peminjaman(){
        $pinjam = Peminjaman::all();
        $pinjamCount = Peminjaman::count();
        $data = [
            'title' => "Laporan Peminjaman",
            'date' => date('d-m-Y'),
            'pinjam' => $pinjam,
            'pinjamCount' => $pinjamCount,
        ];
        $date = date('d-m-Y');
        $pdf = PDF::loadView('laporan.peminjaman-pdf',$data);
        return $pdf->stream('peminjaman-report-'.$date.'.pdf');
    }
}
