@include('layouts.home.header')

<body>

    @include('layouts.home.nav')

    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="text-center mb-4">
                        <a href="#" class="d-inline-flex align-items-center text-dark text-decoration-none">
                            <img src="{{ asset('assets/images/bulung antu.png') }}" alt="Perpus Online Logo"
                                class="me-2" style="height: 50px;">
                            <span class="h4 fw-bold">Pustaka Online</span>
                        </a>
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="h4 mb-3 fw-bold">Buat Akun</h1>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label"> Username </label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Fadil" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label"> Email </label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="name@gmail.com" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label"> Nama Lengkap </label>
                                    <input type="text" name="nama_lengkap" id="fullname" class="form-control"
                                        placeholder="Fadli Rahman" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label"> Alamat </label>
                                    <input type="text" name="alamat" id="address" class="form-control"
                                        placeholder="Pilubang" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="••••••••" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Buat Akun</button>
                            </form>
                            <p class="mt-3 text-center">Sudah punya akun? <a href="{{ route('login') }}"
                                    class="text-primary">Masuk disini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
