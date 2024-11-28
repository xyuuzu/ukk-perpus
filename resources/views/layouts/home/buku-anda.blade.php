@include('layouts.home.header')

<body>
    @include('layouts.home.nav')
    <section class="py-4 bg-light">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Peminjaman Buku Anda</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Buku</th>
                                <th>Cover</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $item)
                                <tr>
                                    <td>{{ $item->user->nama_lengkap }}</td>
                                    <td>{{ $item->buku->judul }}</td>
                                    <td><img src="{{ asset('storage/gambar/' . $item->buku->gambar) }}"
                                            alt="{{ $item->buku->judul }}" width="50px" /></td>
                                    <td>
                                        @if ($item->status === 'menunggu')
                                            <i class="btn btn-warning bi bi-clock"> Menunggu Konfirmasi</i>
                                        @elseif ($item->status === 'tolak')
                                            <i class="btn btn-danger bi bi-x-circle"> Ditolak</i>
                                        @elseif ($item->status === 'terima')
                                            <i class="btn btn-success bi bi-check-circle"> Dipinjamkan</i>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#infoModal" data-user="{{ $item->user->nama_lengkap }}"
                                            data-status="{{ ucfirst($item->status) }}"
                                            data-tanggal-pinjam="{{ $item->tanggalPinjam }}"
                                            data-tanggal-kembali="{{ $item->tanggalKembali }}"
                                            data-buku="{{ $item->buku->judul }}">
                                            Lihat Informasi
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
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
                    <p class="text-danger"><strong></strong><span>*HARAP KEMBALIKAN BUKU PADA TANGGAL TERSEBUT JIKA TIDAK INGIN TERKENA DENDA 1K PERHARI!</span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const infoModal = document.getElementById('infoModal');
        infoModal.addEventListener('show.bs.modal', function(event) {
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



    @include('layouts.home.footer')
</body>
