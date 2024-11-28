@include('layouts.home.header')

<body>
    @include('layouts.home.nav')
    <section class="py-4 bg-light">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Pengembalian</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Peminjam</th>
                                <th>Buku</th>
                                <th>Gambar</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Kondisi Buku</th>
                                <th>status</th>
                                <th>Denda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengembalian as $item)
                                <tr>
                                    <td>{{ $item->peminjaman->user->nama_lengkap }}</td>
                                    <td>{{ $item->peminjaman->buku->judul }}</td>
                                    <td><img src="{{ asset('storage/gambar/' . $item->peminjaman->buku->gambar) }}"
                                        alt="{{ $item->peminjaman->buku->judul }}" width="50px" />
                                    </td>
                                    <td>{{ $item->tanggal_pengembalian }}</td>
                                    <td>{{ $item->kondisi_buku }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->denda ? 'Rp ' . number_format($item->denda, 0, ',', '.') : '-' }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#infoModal" data-user="{{ $item->peminjaman->user->nama_lengkap }}"
                                        data-status="{{ ucfirst($item->status) }}"
                                        data-tanggal-pinjam="{{ $item->peminjaman->tanggalPinjam }}"
                                        data-tanggal-kembali="{{ $item->tanggal_pengembalian }}"
                                        data-buku="{{ $item->peminjaman->buku->judul }}"
                                        data-denda="{{ $item->denda ? 'Rp ' . number_format($item->denda, 0, ',', '.') : '-' }}">
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
                        <p><strong>Jumlah Denda:</strong> <span id="modalDenda"></span></p>
                        <p class="text-danger"><strong></strong><span>Terimakasi sudah mengembalikan buku nya</span>
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
                const denda = button.getAttribute('data-denda');
                const status = button.getAttribute('data-status');
                const tanggalPinjam = button.getAttribute('data-tanggal-pinjam');
                const tanggalKembali = button.getAttribute('data-tanggal-kembali');
    
                // Masukkan data ke elemen modal
                document.getElementById('modalUser').textContent = user;
                document.getElementById('modalBuku').textContent = buku;
                document.getElementById('modalDenda').textContent = denda;
                document.getElementById('modalStatus').textContent = status;
                document.getElementById('modalTanggalPinjam').textContent = tanggalPinjam;
                document.getElementById('modalTanggalKembali').textContent = tanggalKembali;
            });
        </script>
    @include('layouts.home.footer')