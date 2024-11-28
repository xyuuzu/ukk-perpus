@include('layouts.home.header')

<body>

    @include('layouts.home.nav')

    <section class="bg-light py-8 px-4 mx-auto max-w-screen-xl">
        <div class="text-center mb-8">
            <h2 class="mb-4 text-4xl font-extrabold text-dark">List Buku Berdasarkan Kategori</h2>
            <p class="font-light text-muted">Baca Buku Sesuai Kategori Kesukaanmu</p>
        </div>

        @forelse ($kategori as $item)
            <div class="my-5 text-center">
                <h3 class="display-6 text-dark fw-bold">{{ $item->nama }}</h3>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @forelse ($item->bukus as $bukuItem)
                    <div class="col">
                        <div class="card shadow-sm rounded-3 border-light">
                            <img src="{{ asset('/storage/gambar/' . $bukuItem->gambar) }}"  class="card-img-top img-fluid" alt="" style="height: 200px; object-fit: cover;" alt="{{ $bukuItem->judul }}">
                            <div class="card-body">
                                <h5 class="card-title text-center text-dark">{{ $bukuItem->judul }}</h5>
                                <p class="card-text text-muted text-center">Penulis: {{ $bukuItem->penulis }}</p>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('detail-buku', $bukuItem->id) }}" class="btn btn-primary btn-lg px-4 py-2">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada buku yang ditemukan.</p>
                @endforelse
            </div>

        @empty
            <div class="text-center my-5">
                <h2 class="text-muted">Tidak Ada Kategori</h2>
            </div>
        @endforelse
    </section>

    {{-- Flowbite JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"
        integrity="sha512-eNB1lPVKSAW5mXqnboj6QX9kTZKEq4t2f2c5ytUhb+QzPudY3imnjHyXYhIXavZo9e3slCjhDpOJhuMm9uSwzw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
