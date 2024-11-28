@extends('layouts.admin.template')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-header bg-white py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Data Pengguna</h5>
                <a href="{{ route('user.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Pengguna
                </a>
            </div>
        </div>
            <div class="card-body">
                    <table class="table table-hover align-middle table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->nama_lengkap }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="d-flex mt-3 justify-content-center" style="gap: 10px;">
                                        <form action="{{route('user.delete', $user)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
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
