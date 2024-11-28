@include('layouts.home.header')

<body>

    @include('layouts.home.nav')

    <section class="bg-light d-flex align-items-center" style="min-height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center mb-4">
                        <a href="#" class="d-inline-flex align-items-center text-dark text-decoration-none">
                            <img src="{{ asset('assets/images/bulung antu.png') }}" alt="Perpus Online Logo"
                                class="me-2" style="height: 50px;">
                            <span class="h4 fw-bold">Pustaka Online</span>
                        </a>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h1 class="h4 mb-3 fw-bold">Masuk ke Akun Anda</h1>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="name@company.com" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="••••••••" required>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>
                                    <a href="#" class="text-primary">Forgot password?</a>
                                </div>
                                <div>
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                @endif
                                <br>
                                <button type="submit" class="btn btn-primary w-100">Sign in</button>
                            </form>
                            <p class="mt-3 text-center">belum punya akun?
                                <a href="{{ route('register') }}" class="text-primary">Daftar</a>
                            </p>
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
