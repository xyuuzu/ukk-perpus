@extends('layouts.admin.template')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-header bg-white py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Daftar Permintaan Peminjaman</h5>
            </div>
        </div>
        <div class="card-body">
                <table class="table table-hover table-striped mt-3" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">User </th>
                            <th scope="col">Buku</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permintaan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->nama_lengkap }}</td>
                                <td>{{ $item->buku->judul }}</td>
                                <td>{{ ucfirst($item->status) }}</td>
                                <td class="text-center">
                                    <form action="{{ route('terima-peminjaman', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Terima</button>
                                    </form>
                                    <form action="{{ route('tolak-peminjaman', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-inbox display-4 d-block mb-3 text-muted"></i>
                                    <p class="text-muted mb-0">Belum ada permintaan peminjaman</p>
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