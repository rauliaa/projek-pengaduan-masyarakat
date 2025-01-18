<!-- resources/views/partials/header.blade.php -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('quick/assets/img/logo.png') }}" alt="">
            <h1 class="sitename">PRIMA</h1>
        </a>

        <a class="btn-getstarted" href="{{ url('#about') }}">Masuk</a>

    </div>
</header>