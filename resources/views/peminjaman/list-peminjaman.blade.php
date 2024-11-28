@extends('layouts.admin.template')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-header bg-white py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">Daftar Peminjaman</h5>
                {{-- <a href="{{ route('laporan.peminjaman') }}" class="btn btn-success px-4">
                    <i class="bi bi-file-earmark-text me-2"></i>Cetak Laporan
                </a> --}}
            </div>
        </div>
        <div class="card-body">
                <table class="table table-hover table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Buku</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjaman as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->user->nama_lengkap) }}&background=random" 
                                             class="rounded-circle me-3"
                                             width="48" height="48"
                                             alt="{{ $item->user->nama_lengkap }}">
                                        <div>
                                            <h6 class="mb-1 fw-semibold">{{ $item->user->nama_lengkap }}</h6>
                                            <small class="text-muted">ID: {{ $item->user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="ps-2">
                                        <h6 class="mb-1 fw-semibold">{{ $item->buku->judul }}</h6>
                                        <small class="text-muted">ID Buku: {{ $item->buku->id }}</small>
                                    </div>
                                </td>
                                <td>
                                    @switch($item->status)
                                        @case('menunggu')
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                <i class="bi bi-clock me-2"></i>Menunggu Konfirmasi
                                            </span>
                                            @break
                                        @case('tolak')
                                            <span class="badge bg-danger px-3 py-2">
                                                <i class="bi bi-x-circle me-2"></i>Ditolak
                                            </span>
                                            @break
                                        @case('terima')
                                            <span class="badge bg-success px-3 py-2">
                                                <i class="bi bi-check-circle me-2"></i>Dipinjamkan
                                            </span>
                                            @break
                                        @case('dikembalikan')
                                            <span class="badge bg-info px-3 py-2">
                                                <i class="bi bi-arrow-return-left me-2"></i>Dikembalikan
                                            </span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    @if ($item->status == 'dikembalikan')    
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button class="btn btn-outline-primary px-3"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#infoModal"
                                                data-user="{{ $item->user->nama_lengkap }}"
                                                data-status="{{ ucfirst($item->status) }}"
                                                data-tanggal-pinjam="{{ \Carbon\Carbon::parse($item->tanggalPinjam)->format('d M Y') }}"
                                                data-tanggal-kembali="{{ \Carbon\Carbon::parse($item->tanggalKembali)->format('d M Y') }}"
                                                data-buku="{{ $item->buku->judul }}">
                                            <i class="bi bi-info-circle me-2"></i>Detail
                                        </button>
                                    @else
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button class="btn btn-outline-primary px-3"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#infoModal"
                                                data-user="{{ $item->user->nama_lengkap }}"
                                                data-status="{{ ucfirst($item->status) }}"
                                                data-tanggal-pinjam="{{ \Carbon\Carbon::parse($item->tanggalPinjam)->format('d M Y') }}"
                                                data-tanggal-kembali="{{ \Carbon\Carbon::parse($item->tanggalKembali)->format('d M Y') }}"
                                                data-buku="{{ $item->buku->judul }}">
                                            <i class="bi bi-info-circle me-2"></i>Detail
                                        </button>
                                    @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-inbox display-4 d-block mb-3 text-muted"></i>
                                    <p class="text-muted mb-0">Belum ada data peminjaman</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

       {{-- modal --}}

<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Informasi Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Peminjam:</strong> <span id="modalUser"></span></p>
                <p><strong>Buku:</strong> <span id="modalBuku"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                <p><strong>Tanggal Pinjam:</strong> <span id="modalTanggalPinjam"></span></p>
                <p><strong>Tanggal Kembali:</strong> <span id="modalTanggalKembali"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    const infoModal = document.getElementById('infoModal');
    infoModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang men-trigger modal
  
        // Ambil data dari atribut tombol
        const user = button.getAttribute('data-user');
        const buku = button.getAttribute('data-buku');
        const status = button.getAttribute('data-status');
        const tanggalPinjam = button.getAttribute('data-tanggal-pinjam');
        const tanggalKembali = button.getAttribute('data-tanggal-kembali');
  
        // Masukkan data ke elemen modal
        document.getElementById('modalUser').textContent = user;
        document.getElementById('modalBuku').textContent = buku;
        document.getElementById('modalStatus').textContent = status;
        document.getElementById('modalTanggalPinjam').textContent = tanggalPinjam;
        document.getElementById('modalTanggalKembali').textContent = tanggalKembali;
    });
  </script>
@endsection