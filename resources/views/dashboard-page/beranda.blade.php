@extends('layouts.admin.template')

@section('content')

    <div class="container py-4">
        <h1 class="h4 mb-4">Dashboard</h1>

        {{-- Informasi untuk Admin --}}
        @if (auth()->user()->role === 'admin')
            <div class="row g-4">
                <!-- Total Buku -->
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Buku</h5>
                            <p class="h2">{{ $totalBuku }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Pengguna -->
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Pengguna</h5>
                            <p class="h2">{{ $totalPengguna }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Peminjaman -->
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Peminjaman</h5>
                            <p class="h2">{{ $totalPeminjaman }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Pengembalian -->
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Pengembalian</h5>
                            <p class="h2">{{ $totalPengembalian }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Informasi untuk Petugas --}}
        @if (auth()->user()->role === 'petugas')
            <div class="row g-4">
                <!-- Daftar Buku Baru -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buku Baru Ditambahkan</h5>
                            <ul class="list-group">
                                @foreach ($bukuBaru as $buku)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $buku->judul }}
                                        <span
                                            class="badge bg-info text-dark">{{ $buku->created_at->diffForHumans() }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Daftar Buku yang belum dikembalikan -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Buku Belum Dikembalikan</h5>
                                <a href="{{ route('pengembalian.manual') }}" class="btn btn-success px-4">
                                    cek
                                </a>
                            </div>
                            <ul class="list-group list-group-flush">
                                @forelse ($BukuBelumdikembalikan as $belum)
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-bold me-2">#{{ $belum->id }}</span>
                                            <span class="flex-grow-1 ms-2">-{{ $belum->buku->judul }}</span>
                                        </div>
                                        <i class="text-muted d-block">{{ $belum->user->nama_lengkap }}</i>
                                        <div class="text-end">
                                            <span
                                                class="badge bg-info text-dark">{{ $belum->created_at->diffForHumans() }}</span>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center py-3">Tidak ada buku yang belum dikembalikan.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>


                <!-- Permintaan Peminjaman -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                               <h5 class="card-title">Permintaan Peminjaman
                            </h5> 
                            <a href="{{ route('list-permintaan') }}"
                            class="btn btn-success px-4">Cek </a>
                            </div>
                            
                            <ul class="list-group">
                                @forelse ($permintaanPeminjaman as $peminjaman)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $peminjaman->id }}</span>
                                        {{ $peminjaman->buku->judul }}
                                        <span class="">{{ $peminjaman->user->nama_lengkap }}</span>
                                    </li>
                                @empty
                                    <li class="list-group-item">Tidak ada permintaan peminjaman.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


@endsection
