@include('layouts.home.header')

<body class="bg-light">
    @include('layouts.home.nav')

    <section class="py-4 bg-white">
        <div class="container">
            <h2 class="h4 text-dark mb-4">Koleksi Buku Anda</h2>
            @if($koleksi->isEmpty())
                <p class="text-muted text-center">Anda belum memiliki buku dalam koleksi.</p>
            @else
                <div class="row g-4">
                    @foreach ($koleksi as $koleksiItem)
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <img src="{{ asset('storage/gambar/' . $koleksiItem->buku->gambar) }}" alt="{{ $koleksiItem->buku->judul }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $koleksiItem->buku->judul }}</h5>
                                    <p class="card-text"><strong>Penulis:</strong> {{ $koleksiItem->buku->penulis }}</p>
                                    <p class="card-text"><strong>Penerbit:</strong> {{ $koleksiItem->buku->penerbit }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('detail-buku', $koleksiItem->buku->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                                        <form action="{{ route('koleksi.toggle', $koleksiItem->buku->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-heart-fill"></i> Hapus Dari Koleksi
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @include('layouts.home.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
