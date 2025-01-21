@extends('layouts.apps')

@section('title', 'Home')

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center" style="
    background: url('{{ asset('assets/img/banner_prima.png') }}') no-repeat center center;
    background-size: cover;
    background-attachment: fixed;
    width: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
    text-align: left;">
    <div class="container" style="max-width: 600px; position: absolute; left: 5%;">
        <h1>Pengaduan Rakyat</h1>
        <h1>Interaktif,&nbsp;Mudah,&nbsp;AMAN</h1>
        <a href="{{ route('pengaduan')}}" class="btn-get-started scrollto">Buat Pengaduan</a>
    </div>
</section>

<div style="height: 80px;"></div>

<!-- About Section -->
<section id="about" class="about section">
  <div class="container section-title text-center" data-aos="fade-up" style="padding-bottom: 20px;"> <!-- Sesuaikan padding bawah -->
    <h2 style="margin-bottom: 15px;">Pengaduan Rakyat Interaktif, Mudah, Aman ( PRIMA )</h2> <!-- Sesuaikan margin bawah -->
    <p class="text-muted" style="margin-bottom: 10px; font-size: 1.1rem; line-height: 1.6;">
      PRIMA hadir sebagai solusi modern untuk mempermudah masyarakat dalam menyampaikan keluhan, aspirasi, dan laporan dengan lebih 
      <span style="font-weight: bold; color: #007bff;">interaktif</span>, 
      <span style="font-weight: bold; color: #28a745;">mudah</span>, dan 
      <span style="font-weight: bold; color: #dc3545;">aman</span>.
    </p>
    <p class="text-muted" style="margin-bottom: 30px; font-size: 1.1rem; line-height: 1.6;">
      Kami percaya bahwa setiap suara berharga dan harus ditindaklanjuti dengan transparansi serta tanggung jawab. 
      <span style="font-style: italic; color: #6c757d;">Dengan PRIMA, masyarakat memiliki akses ke sistem pengaduan yang lebih efektif dan efisien.</span>
    </p>

  </div>

  <div class="container">
    <div class="row align-items-center gy-4">
      <!-- Konten kiri -->
      <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
        <ul class="list-unstyled" style="margin-top: 0;">
          <li class="d-flex align-items-start mb-3">
            <i class="bi bi-check-circle-fill text-primary me-2"></i> 
            <span>
              <strong>Interaktif</strong> – PRIMA mendukung komunikasi dua arah antara masyarakat dan pihak terkait, 
              memastikan bahwa setiap pengaduan mendapat respon yang cepat dan tepat.
            </span>
          </li>
          <li class="d-flex align-items-start mb-3">
            <i class="bi bi-check-circle-fill text-success me-2"></i> 
            <span>
              <strong>Mudah</strong> – Dengan antarmuka yang sederhana dan user-friendly, PRIMA dapat diakses kapan saja dan di mana saja melalui perangkat digital.
            </span>
          </li>
          <li class="d-flex align-items-start">
            <i class="bi bi-check-circle-fill text-danger me-2"></i> 
            <span>
              <strong>Aman</strong> – Keamanan data pengguna adalah prioritas kami. PRIMA memastikan laporan tetap terlindungi dengan sistem keamanan yang kuat.
            </span>
          </li>
        </ul>
      </div>

      <!-- Konten kanan (Gambar) -->
      <div class="col-lg-6 text-center" data-aos="zoom-in" data-aos-delay="200">
        <img src="{{ asset('quick/assets/img/logo.png') }}" alt="About PRIMA" class="img-fluid" style="max-width: 50%; height: auto;">
      </div>
    </div>
  </div>
</section>



<main id="main">

<!-- ======= Why Us Section ======= -->
<section id="why-us" class="why-us">
  <div class="container">

    <div class="row justify-content-center">


    <div id="features" class="features section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="features-content">
              <div class="row">
                <div class="col-lg-3">
                  <div class="features-item first-feature wow fadeInUp" data-wow-duration="1s" data-wow-delay="0s">
                    <div class="first-number number">
                      <h6>01</h6>
                    </div>
                    <div class="bx bxs-pencil" style="font-size: 40px;"></div> <!-- Perbesar ikon -->
                    <h4>Tulis Pengaduan</h4>
                    <div class="line-dec"></div>
                    <p>Pengguna membuat laporan pengaduan dengan mengisi formulir yang tersedia.</p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="features-item second-feature wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="second-number number">
                      <h6>02</h6>
                    </div>
                    <div class="bx bx-search" style="font-size: 40px;"></div> <!-- Perbesar ikon -->
                    <h4>Proses Verifikasi</h4>
                    <div class="line-dec"></div>
                    <p>Pengaduan diverifikasi untuk memastikan kebenaran dan kelayakannya.</p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="features-item first-feature wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
                    <div class="third-number number">
                      <h6>03</h6>
                    </div>
                    <div class="bx bx-cog" style="font-size: 40px;"></div> <!-- Perbesar ikon -->
                    <h4>Tindak Lanjut</h4>
                    <div class="line-dec"></div>
                    <p>Pengaduan ditindaklanjuti dengan langkah-langkah sesuai kategori masalah.</p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="features-item second-feature last-features-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                    <div class="fourth-number number">
                      <h6>04</h6>
                    </div>
                    <div class="bx bx-check-circle" style="font-size: 40px;"></div> <!-- Perbesar ikon -->
                    <h4>Selesai</h4>
                    <div class="line-dec"></div>
                    <p>Pengaduan yang ditangani dinyatakan selesai dan pengguna diberitahu.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</section><!-- End Why Us Section -->

</main><!-- End #main -->
@endsection
