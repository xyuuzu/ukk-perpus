<nav class="navbar navbar-header navbar-expand-lg">
    <div class="container-fluid">
        
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=random"
                        class="rounded-circle me-3" width="36"
                        alt="{{ Auth::user()->nama_lengkap }}"><span>{{ Auth::user()->nama_lengkap }}</span></span> </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <div class="user-box">
                            <div class="u-img"><img
                                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=random"
                                    alt="{{ Auth::user()->nama_lengkap }}"></div>
                            <div class="u-text">
                                <h4>{{ Auth::user()->nama_lengkap }}</h4>
                                <p class="text-muted">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </li>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('post')
                        <button type="submit" class="dropdown-item"><i class="fa fa-power-off"></i> LogOut</button>
                    </form>
                </ul>
                <!-- /.dropdown-user -->
            </li>
        </ul>
    </div>
</nav>
