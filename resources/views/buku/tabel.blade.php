@extends('layouts.admin.template')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-header bg-white py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Tabel Buku</h5>
                <a href="{{ route('buku.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Buku
                </a>
            </div>
        </div>
        <div class="card-body">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Cover</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Kategori</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bukus as $buku)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>
                                    <img src="{{ asset('storage/gambar/' . $buku->gambar) }}" alt="{{ $buku->judul }}" width="50px" class="">
                                </td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ $buku->penerbit }}</td>
                                <td>{{ $buku->kategori->nama }}</td>
                                <td class="d-flex mt-3 justify-content-center" style="gap: 10px;">
                                    <a href="{{ route('buku.edit', $buku) }}" class="btn btn-outline-primary px-3">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </a>
                                
                                    <form action="{{ route('buku.destroy', $buku) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger px-3">
                                            <i class="bi bi-trash me-2"></i>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-inbox display-4 d-block mb-3 text-muted"></i>
                                    <p class="text-muted mb-0">Belum ada data buku</p>
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