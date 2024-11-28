<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_lengkap) }}&background=random" 
                class="rounded-circle me-3"
                width="48" height="48"
                alt="{{ Auth::user()->nama_lengkap}}">
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        {{Auth::user()->nama_lengkap}}
                        <span class="user-level">{{Auth::user()->role}}</span>
                        
                    </span>
                </a>
            </div>
        </div>
        <ul class="nav">
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                <li class="nav-item">
                    <a href="{{route('admin')}}">
                        <i class="la la-university"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                  <li class="nav-item">
                    <a href="{{route('user.table')}}">
                        <i class="la la-user"></i>
                        <p>Data User</p>
                    </a>
                </li>  
                @endif
                
                <li class="nav-item">
                    <a href="{{route('buku.index')}}">
                        <i class="la la-book"></i>
                        <p>Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('kategori.index')}}">
                        <i class="la la-plus"></i>
                        <p>Kategori</p>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a data-toggle="collapse" href="#peminjaman">
                    <i class="la la-envelope"></i>
                    <p>Peminjaman</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="peminjaman">
                    <ul class="nav nav-collapse">
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                            <li>
                                <a href="{{route('list-peminjaman')}}">
                                    <span class="sub-item">Daftar Peminjaman</span>
                                </a>
                            </li>
                        

                            <li>
                                <a href="{{route('list-permintaan')}}">
                                    <span class="sub-item">Daftar permintaan</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('manual-peminjaman')}}">
                                <span class="sub-item">Tambah Peminjaman</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-toggle="collapse" href="#pengembalian">
                    <i class="la la-mail-reply"></i>
                    <p>Pengembalian</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="pengembalian">
                    <ul class="nav nav-collapse">
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                            <li>
                                <a href="{{route('pengembalian.index')}}">
                                    <span class="sub-item">Daftar Pengembalian</span>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{route('pengembalian.manual')}}">
                                <span class="sub-item">tambah Pengembalian</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
