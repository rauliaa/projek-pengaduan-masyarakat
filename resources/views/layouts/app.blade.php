<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') | PRIMA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <style>
      header {
            width: 100%;
            padding: 0;
            background-color: white;
            display: flex;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
            max-width: 100%;
            margin-bottom: 0;
        }
        header .logo h1 {
            color: #4553E9;
            font-size: 20px;
            margin-left: 10px;
        }
        header .logo {
            display: flex;
            align-items: center;
        }
        header .logo img {
            width: 85px;
            height: auto;
        }
  </style>
</head>

<body>
   <!-- ======= Header ======= -->
   <header id="header" class="fixed-top">
      <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
            <img src="{{ asset('quick/assets/img/logo.png') }}" alt="PRIMA Logo">
            <a href="{{ url('/') }}" style="text-decoration: none;">
                <h1>PRIMA</h1>
            </a>
        </div>

        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul class="d-flex justify-content-end">
            <li><a class="nav-link scrollto {{ (request()->is('/pengaduan')) ? 'active' : '' }}" href="{{ route('pengaduan')}}">Buat Pengaduan</a></li>
            <li><a class="nav-link scrollto {{ (request()->is('pengaduan.laporan')) ? 'active' : '' }}" href="{{ route('pengaduan.laporan', 'saya')}}">Pengaduan Saya</a></li>
          </ul>
        </nav><!-- .navbar -->

        <div class="auth-buttons">
          @auth('masyarakat')
            <a href="{{ route('user.logout')}}" class="appointment-btn scrollto">Logout</a>
          @else
            <a href="{{ url('login')}}" class="appointment-btn scrollto">Login</a>
          @endauth
        </div>
      </div>
    </header><!-- End Header -->


  @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container d-md-flex py-4">

      <div class="me-md-auto my-auto text-center text-md-start">
        <div class="copyright">
          &copy; 2025 <strong><span><a href="" target="_blank">PRIMA</a></span></strong>. Rahma Aulia Mangundap
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://github.com/rauliaa" class="github"><i class="bx bxl-github"></i></a>
        <a href="https://www.linkedin.com/in/rahma-aulia-mangundap/" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @stack('prepend-script')
  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  @stack('addon-script')

</body>

</html>
