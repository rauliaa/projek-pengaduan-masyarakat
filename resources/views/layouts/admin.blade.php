<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>@yield('title') | Pengaduan Masyarakat</title>

  @stack('prepend-style')
  @include('partials.style')
  @stack('addon-style')

</head>

<body>
  <!-- Sidenav -->
  @include('partials.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')
  </div>
  @stack('prepend-script')
  @include('partials.script')
  @stack('addon-script')
  @include('sweetalert::alert')
</body>

</html>
