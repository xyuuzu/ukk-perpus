@extends('layouts.admin.template')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-header bg-white py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Tabel Buku</h5>
                <a href="{{ route('kategori.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Kategori
                </a>
            </div>
        </div>
            <div class="card-body">
                    <table class="table table-hover table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategoris as $kategori)
                                <tr class="border-bottom">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->nama }}</td>
                                    <td class="d-flex mt-3 justify-content-center" style="gap: 10px;">
                                        <a href="{{ route('kategori.edit', $kategori) }}"
                                            class="btn btn-outline-primary px-3">
                                            <i class="bi bi-pencil me-2"></i>Edit
                                        </a>
                                        <form action="{{route('kategori.destroy', $kategori)}}" method="POST">
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
                                    <td colspan="2" class="text-center py-5">
                                        <i class="bi bi-inbox display-4 d-block mb-3 text-muted"></i>
                                        <p class="text-muted mb-0">Belum ada kategori</p>
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
