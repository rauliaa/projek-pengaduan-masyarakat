@extends('layouts.app')

@section('title', 'Pengaduan')

@section('content')
<main id="main" class="martop">

    <section class="inner-page">
        <div class="container">
            <div class="row gy-4 justify-content-between features-item">
                <!-- Kolom Data Pelapor -->
                <div class="col-lg-5 d-flex align-items-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="content">
                        <h5><b>Data Pelapor</b></h5>
                        <p>
                            {{ $pengaduan->user->name }} <br>
                            {{ Carbon\Carbon::parse($pengaduan->tgl_kejadian)->format('d F Y') }} <br>
                        </p>
                    </div>
                </div>

                <!-- Kolom Gambar dan Laporan -->
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="card card-responsive p-4 border-0 shadow rounded mx-auto text-center">
                        <img src="{{ $pengaduan->foto }}" class="img-fluid" alt="">
                        <h3>{{ $pengaduan->judul_laporan }}</h3>
                        <p>
                            @if($pengaduan->status == '0')
                                <span class="text-sm text-white p-1 bg-danger">Pending</span>
                            @elseif($pengaduan->status == 'proses')
                                <span class="text-sm text-white p-1 bg-warning">Proses</span>
                            @else
                                <span class="text-sm text-white p-1 bg-success">Selesai</span>
                            @endif
                        </p>
                        <p>{{ $pengaduan->isi_laporan }}</p>
                        <span class="text-sm badge badge-warning">Proses</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
