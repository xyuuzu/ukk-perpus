@extends('layouts.admin.template')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-header bg-white py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Daftar Pengembalian</h5>
                <a href="{{ route('laporan.pengembalian') }}" class="btn btn-success px-4">
                    <i class="bi bi-file-earmark-text me-2"></i>Cetak Laporan
                </a>
            </div>
        </div>
        <div class="card-body">
                <table class="table table-hover  table-striped mt-3">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Buku</th>
                            <th scope="col">Tanggal Pengembalian</th>
                            <th scope="col">Status</th>
                            <th scope="col">Kondisi Buku</th>
                            <th scope="col">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengembalian as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->peminjaman->user->nama_lengkap }}</td>
                                <td>{{ $item->peminjaman->buku->judul }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d M Y') }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->kondisi_buku }}</td>
                                <td>{{ $item->denda ? 'Rp ' . number_format($item->denda, 0, ',', '.') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-inbox display-4 d-block mb-3 text-muted"></i>
                                    <p class="text-muted mb-0">Belum ada data pengembalian</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection