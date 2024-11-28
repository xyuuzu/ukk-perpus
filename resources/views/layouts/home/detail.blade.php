@include('layouts.home.header')

<body class="bg-light">
    @include('layouts.home.nav')

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="position-sticky top-0">
                    <img src="{{ asset('storage/gambar/' . $buku->gambar) }}" alt="{{ $buku->judul }}"
                        class="img-fluid rounded-4 shadow-lg object-fit-cover" style="max-height: 500px; width: 100%;">
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h2 mb-3 text-primary">{{ $buku->judul }}</h1>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="bg-light-subtle p-3 rounded-3">
                                    <h6 class="text-muted mb-2">Penulis</h6>
                                    <p class="mb-0 fw-bold">{{ $buku->penulis }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light-subtle p-3 rounded-3">
                                    <h6 class="text-muted mb-2">Penerbit</h6>
                                    <p class="mb-0 fw-bold">{{ $buku->penerbit }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light-subtle p-3 rounded-3">
                                    <h6 class="text-muted mb-2">Tahun Terbit</h6>
                                    <p class="mb-0 fw-bold">{{ $buku->tahunTerbit }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <p class="fw-bold">
                                    Total Rating: {{ number_format($averageRating, 1) }} / 5
                                </p>


                                {{-- Menampilkan bintang --}}
                                @php
                                    $fullStars = floor($averageRating);
                                    $halfStar = $averageRating - $fullStars >= 0.5;
                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                @endphp

                                {{-- Full stars --}}
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <span class="text-warning">⭐</span>
                                @endfor

                                {{-- Half star --}}
                                @if ($halfStar)
                                    <span class="text-warning">🌟</span>
                                @endif

                                {{-- Empty stars --}}
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <span class="text-secondary">☆</span>
                                @endfor

                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Rating dan Ulasan</h5>
                                {{-- Periksa apakah peminjaman ada --}}
                                @if (!$buku->peminjaman || $buku->peminjaman->status == null)
                                    <div class="alert alert-info text-center" role="alert">
                                        Anda belum meminjam buku ini.
                                    </div>
                                @else
                                    {{-- Jika sudah meminjam, cek apakah ulasan sudah diberikan --}}
                                    @if ($buku->ulasans->where('user_id', auth()->id())->isEmpty())
                                        <div class="card border-primary">
                                            <div class="card-body">
                                                <form action="{{ route('ulasans.store', $buku->id) }}" method="POST">
                                                    @csrf
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label for="rating" class="form-label">Rating</label>
                                                            <select name="rating" id="rating" class="form-select" required>
                                                                <option value="">Pilih Rating</option>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="ulasan" class="form-label">Ulasan Anda</label>
                                                            <textarea name="ulasan" id="ulasan" class="form-control" rows="4" required></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-info" role="alert">
                                            Anda sudah memberikan ulasan untuk buku ini.
                                        </div>
                                    @endif
                                @endif
                            </div>
                            

                        </div>

                        @if (Auth::check() && Auth::user()->role == 'peminjam')
                            <div class="d-flex gap-3 align-items-center">
                                <form action="{{ route('koleksi.toggle', $buku->id) }}" method="POST"
                                    class="m-0">
                                    @csrf
                                    <button type="submit"
                                        class="btn {{ Auth::user()->koleksi()->where('buku_id', $buku->id)->exists()? 'btn-danger': 'btn-outline-secondary' }}">
                                        <i
                                            class="bi {{ Auth::user()->koleksi()->where('buku_id', $buku->id)->exists()? 'bi-heart-fill': 'bi-heart' }} me-2"></i>
                                        {{ Auth::user()->koleksi()->where('buku_id', $buku->id)->exists()? 'Hapus Dari Koleksi': 'Tambah Ke Koleksi' }}
                                    </button>
                                </form>

                                <div>
                                    @if ($buku->peminjaman)
                                        @switch($buku->peminjaman->status)
                                            @case('menunggu')
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-clock me-2"></i>Menunggu Konfirmasi
                                                </span>
                                            @break

                                            @case('tolak')
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-x-circle me-2"></i>Ditolak
                                                </span>
                                                <form action="{{ route('pinjam-buku', $buku->id) }}" method="POST"
                                                    class="mt-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="bi bi-book me-2"></i>Pinjam Ulang Buku
                                                    </button>
                                                </form>
                                            @break

                                            @case('terima')
                                                <a href="{{ route('buku-anda') }}" class="badge bg-success">
                                                    <i class="bi bi-check-circle me-2"></i>Dipinjamkan
                                                </a>
                                            @break

                                            @case('dikembalikan')
                                                <form action="{{ route('pinjam-buku', $buku->id) }}" method="POST"
                                                    class="mt-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="bi bi-book me-2"></i>Pinjam Ulang Buku
                                                    </button>
                                                </form>
                                            @break
                                        @endswitch
                                    @else
                                        <form action="{{ route('pinjam-buku', $buku->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-book me-2"></i>Pinjam Buku
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        {{-- @elseif (Auth::user()->role == 'petugas' || Auth::user()->role == 'admin')
                        <div class="alert alert-danger text-center" role="alert">
                            Hanya peminjam yang bisa meminjam buku!.
                        </div> --}}
                        @else
                            <div class="alert alert-danger text-center" role="alert">
                                Login untuk bisa meminjam buku ini!.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h4 mb-4 text-primary">Ulasan Buku</h2>
                        @forelse ($buku->ulasans as $ulasan)
                            <div class="card mb-3 border-0 bg-light-subtle">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <b>{{ $ulasan->user->nama_lengkap }}</b>

                                        </div>
                                        <div class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="bi {{ $i <= $ulasan->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                            @endfor
                                            <div>
                                                <h6 class="mb-0">{{ $ulasan->user->name }}</h6>
                                                <small
                                                    class="text-muted">{{ $ulasan->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-muted">{{ $ulasan->ulasan }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">
                                Belum ada ulasan untuk buku ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.home.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
