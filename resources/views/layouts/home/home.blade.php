@include('layouts.home.header')

<body>

    {{-- NAV --}}
    @include('layouts.home.nav')

    <section class="bg-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-4 fw-bold">Perpustakaan <br>Berbasis Website.</h1>
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('list-buku') }}" class="btn btn-outline-dark">
                            <i class="fa-solid fa-book"></i> Lihat Daftar Buku
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <img src="{{ asset('assets/images/orgbacahebat.png') }}" class="img-fluid" alt="hero image">
                </div>
            </div>
        </div>
    </section>

    {{-- Description --}}
    <section class="bg-light">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">Tentang Kami</h2>
                    <p class="text-muted">Website Perpustakaan yang Membantu anda dalam mencari dan meminjam buku dengan mudah tanpa perlu datang ke perpustakaan untuk melihat buku yang ingin di pinjam.</p>
                    <ul class="list-unstyled mt-4">
                        <li class="d-flex align-items-start mb-3">
                            <i class="bi bi-check-circle-fill text-primary me-3"></i>
                            <span>Mudah Digunakan</span>
                        </li>
                        <li class="d-flex align-items-start mb-3">
                            <i class="bi bi-check-circle-fill text-primary me-3"></i>
                            <span>Banyak Buku Menarik</span>
                        </li>
                        <li class="d-flex align-items-start mb-3">
                            <i class="bi bi-check-circle-fill text-primary me-3"></i>
                            <span>Peminjaman Online</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('assets/images/hp.png') }}" class="img-fluid rounded" alt="dashboard feature image">
                </div>
            </div>
        </div>
    </section>

    {{-- List Buku --}}
    <section class="bg-white">
        <div class="container py-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Buku Buku Menarik</h2>
            </div>
            <div class="d-flex align-items-center">
                <button id="prev" class="btn btn-primary">
                    &lt;
                </button>
                <div class="flex-grow-1 overflow-hidden">
                    <div class="d-flex transition-transform justify-content-center" id="book-slider">
                        @forelse ($bukus as $buku)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ asset('storage/gambar/'.$buku->gambar) }}" class="card-img-top img-fluid" alt="" style="height: 200px; object-fit: cover;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $buku->judul }}</h5>
                                    <p class="card-text">Penulis : {{ $buku->penulis }}</p>
                                    <a href="{{ route('detail-buku', $buku->id) }}" class="btn btn-primary">Lihat</a>
                                </div>
                            </div>
                        </div>
                       @empty
                        <p class="text-center">Data Buku Kosong</p>
                         @endforelse
                    </div>
                </div>
                <button id="next" class="btn btn-primary">
                    &gt;
                </button>
            </div>
        </div>
    </section>

    {{-- Ajakan --}}
    <section class="bg-light">
        <div class="container py-5 text-center">
            <h2 class="fw-bold">Eksplorasi Sekarang! 📚</h2>
            <p class="text-muted">Silahkan cari buku yang anda inginkan</p>
            <a href="{{ route('list-buku') }}" class="btn btn-primary">Lihat Sekarang</a>
        </div>
    </section>

    @include('layouts.home.footer')
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
  <script>
      const slider = document.getElementById('book-slider');
      const totalBooks = {{ count($bukus) }}; // Jumlah total buku
      const booksToShow = 3; // Jumlah buku yang ditampilkan sekaligus
      let currentIndex = 0;
  
      function updateSlider() {
          const slideWidth = slider.clientWidth / booksToShow; 
          slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`; // Geser tampilan
      }
  
      function autoScroll() {
          currentIndex = (currentIndex + 1) % Math.ceil(totalBooks / booksToShow); // Menghitung indeks selanjutnya
          updateSlider();
      }
  
      document.getElementById('next').addEventListener('click', function() {
          currentIndex = (currentIndex + 1) % Math.ceil(totalBooks / booksToShow);
          updateSlider();
      });
  
      document.getElementById('prev').addEventListener('click', function() {
          currentIndex = (currentIndex - 1 + Math.ceil(totalBooks / booksToShow)) % Math.ceil(totalBooks / booksToShow);
          updateSlider();
      });
  
  </script>
</body>

</html>
