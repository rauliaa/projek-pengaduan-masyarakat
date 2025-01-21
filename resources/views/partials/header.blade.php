<!-- resources/views/partials/header.blade.php -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('quick/assets/img/logo.png') }}" alt="" style="width: 85px; height: auto;">
            <h1 class="sitename">PRIMA</h1>
        </a>

        {{-- <nav id="navbar" class="navbar order-last order-lg-0 ">
            <ul>
            <li><a class="nav-link scrollto {{ (request()->is('/')) ? 'active' : '' }}" href="/">Home</a></li>
            <li><a class="nav-link scrollto {{ (request()->is('tentang')) ? 'active' : '' }}" href="{{ url('tentang')}}">Tentang</a></li>
            <li><a class="nav-link scrollto {{ (request()->is('pengaduan.laporan')) ? 'active' : '' }}" href="{{ route('pengaduan.laporan', 'saya')}}">Pengaduan</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar --> --}}

        @auth('masyarakat')
            <a href="{{ route('user.logout')}}" class="appointment-btn scrollto">Logout</a>
        @else
            <a href="{{ url('login')}}" class="appointment-btn scrollto">Login</a>
        @endauth

    </div>
</header>