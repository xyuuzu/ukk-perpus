<header class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/bulung antu.png') }}" alt="Logo" class="me-2" style="height: 30px;">
                <span class="fw-bold text-primary">Pustaka Online</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list-buku') }}">List Buku</a>
                    </li>
                    @if (Auth::user() && Auth::user()->role == 'peminjam')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('koleksi.index') }}">Koleksi Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('buku-anda') }}">Informasi Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ 'info-pengembalian' }}">Informasi pengembalian</a>
                        </li>
                    @endif
                </ul>
                <div class="d-flex align-items-center">
                    @if (Auth::user() && Auth::user()->role !== 'peminjam')
                        <a href="{{ route('admin') }}" class="btn btn-outline-primary me-2">
                            <i class="fa-solid fa-user"></i>&nbsp;{{ Auth::user()->username }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
                            @csrf
                        </form>
                        <a href=""
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn btn-primary">Keluar</a>
                    @elseif (Auth::user() && Auth::user()->role === 'peminjam')
                        <a href="#" class="btn btn-outline-primary me-2">
                            <i class="fa-solid fa-user"></i>&nbsp;{{ Auth::user()->username }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
                            @csrf
                        </form>
                        <a href=""
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn btn-primary">Keluar</a>
                    @else
                        <a href="{{ route('login.form') }}" class="btn btn-primary">Masuk</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
    body {
        padding-top: 70px;
        /* Memberikan jarak agar konten tidak tertutup navbar */
    }

    header {
        transition: background-color 0.3s, box-shadow 0.3s;
        /* Efek transisi untuk smooth scrolling */
    }

    header.scrolled {
        background-color: rgba(255, 255, 255, 0.9);
        /* Transparan saat scroll */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Tambahkan bayangan untuk fokus */
    }
</style>

<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('header');
        if (window.scrollY > 0) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
