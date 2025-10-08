@extends('layouts.app')

@section('content')
{{-- Untuk hasil terbaik, tambahkan link Google Fonts ini di file layouts/app.blade.php Anda, di dalam tag <head> --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}

{{-- <link rel="stylesheet" href="{{ asset('css/landing.css') }}"> --}}
@vite(['public/css/landing.css'])

<div class="container-fluid hero-section d-flex align-items-center justify-content-center">
    <div class="row w-100 align-items-center">
        <div class="col-md-6 hero-content text-center text-md-start mb-4 mb-md-0 fade-in">
            <h1 class="display-4 mb-3">Selamat Datang di <span style="color:#ffe066;">LanguangeRoom</span></h1>
            <p class="lead mb-4">Wujudkan impianmu menguasai Bahasa Inggris! Belajar jadi lebih seru dan efektif dengan metode modern dan komunitas belajar yang suportif.</p>
            <a href="{{ url('/register') }}" class="cta-btn">Daftar Sekarang</a>
        </div>
        <div class="col-md-6 text-center fade-in">
            <img src="https://wirahadie.com/wp-content/uploads/2021/08/Kids-Learning-English.jpg" alt="Belajar Online" class="hero-illustration">
        </div>
    </div>
</div>

<div class="container mt-5 py-5">
    <h2 class="text-center section-title fade-in">Pilih Jenis Paket Belajar</h2>
    <div class="row justify-content-center">
        <div class="col-md-5 mb-4 fade-in">
            <div class="card h-100 shadow-sm paket-card">
                <div class="card-body text-center">
                    <div class="paket-icon mb-3">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h5 class="card-title fw-bold">Paket Private</h5>
                    <p class="card-text">Belajar langsung di lokasi bersama pengajar berpengalaman.</p>
                    <a href="{{ route('paket.offline') }}" class="btn btn-paket mt-3">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-4 fade-in">
            <div class="card h-100 shadow-sm paket-card">
                <div class="card-body text-center">
                    <div class="paket-icon mb-3">
                        <i class="fas fa-laptop-house"></i>
                    </div>
                    <h5 class="card-title fw-bold">Paket Online</h5>
                    <p class="card-text">Belajar dari rumah dengan kelas live dan materi online interaktif.</p>
                    <a href="{{ route('paket.online') }}" class="btn btn-paket mt-3">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container about-section fade-in">
    <div class="row align-items-center">
        <div class="col-md-2 text-center mb-4 mb-md-0">
            <span class="about-icon"><i class="fas fa-users"></i></span>
        </div>
        <div class="col-md-10">
            <h2 class="section-title mb-3 text-start" style="--bs-text-align: start;">Tentang Kami</h2>
            <p class="mb-0 text-muted">
    Di LanguangeRoom, kami percaya setiap siswa unik. Oleh karena itu, kami memberikan Anda kebebasan untuk memilih cara belajar yang paling efektif: apakah melalui sesi <strong>privat tatap muka</strong> di rumah Anda, atau melalui <strong>platform online modern</strong> kami yang fleksibel.
    <br><br>
    Apapun pilihan Anda, kami berkomitmen untuk memberikan pengalaman belajar yang personal dan suportif untuk mencapai hasil terbaik.
</p>
        </div>
    </div>
</div>

<div class="container-fluid gallery-section mt-5">
    <div class="container">
        <h2 class="text-center section-title fade-in">Galeri Kegiatan Kami</h2>
        
        <div class="gallery-container">
            <div class="gallery-item item-potrait fade-in">
                <img src="{{ asset('images/gambar1.jpg') }}" alt="Kegiatan Belajar 1">
                <div class="overlay"><div class="overlay-title">Pembelajaran</div></div>
            </div>

            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gambar4.jpg') }}" alt="Kegiatan Belajar 2">
                <div class="overlay"><div class="overlay-title"></div></div>
            </div>
            
            <div class="gallery-item item-potrait video-item fade-in">
                <video autoplay muted loop playsinline controls>
                    <source src="{{ asset('videos/video1.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung tag video.
                </video>
            </div>
            
            <div class="gallery-item fade-in">
                <img src="{{ asset('images/gambar5.jpg') }}" alt="Kegiatan Belajar 4">
                <div class="overlay"><div class="overlay-title">kolaborasi</div></div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 py-5">
    <h2 class="text-center section-title fade-in">Kenapa Memilih Kami?</h2>
    <div class="row text-center g-4">
        
        <div class="col-md-3 col-6 fade-in">
            <div class="p-3 keunggulan-item">
                <i class="fas fa-sitemap fa-3x mb-3"></i>
                <h6 class="fw-bold">Kurikulum Terstruktur</h6>
                <p class="small text-muted">Materi dirancang berjenjang untuk memastikan pemahaman mendalam.</p>
            </div>
        </div>
        
        <div class="col-md-3 col-6 fade-in">
            <div class="p-3 keunggulan-item">
                <i class="fas fa-clock fa-3x mb-3"></i>
                <h6 class="fw-bold">Jadwal Fleksibel</h6>
                <p class="small text-muted">Belajar bisa disesuaikan dengan waktu luangmu.</p>
            </div>
        </div>
        
        <div class="col-md-3 col-6 fade-in">
            <div class="p-3 keunggulan-item">
                <i class="fas fa-puzzle-piece fa-3x mb-3"></i>
                <h6 class="fw-bold">Belajar Jadi Asik & Mudah</h6>
                <p class="small text-muted">Materi disajikan lewat video, modul interaktif, dan kuis seru yang jauh dari kata bosan.</p>
            </div>
        </div>
        
        <div class="col-md-3 col-6 fade-in">
            <div class="p-3 keunggulan-item">
                <i class="fas fa-laptop-code fa-3x mb-3"></i>
                <h6 class="fw-bold">Media Interaktif</h6>
                <p class="small text-muted">Akses modul, video pembahasan, dan kuis online kapan saja.</p>
            </div>
        </div>

    </div>
</div>

<div class="container mt-5 fade-in" style="animation-delay:0.25s;animation-duration:1.2s;">
    <h2 class="text-center section-title">FAQ</h2>
    <div class="accordion" id="faqAccordion">       
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                    Apa saja media pembelajaran yang didapat dan tahapannya?
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Anda akan mendapatkan akses ke berbagai media pembelajaran eksklusif, termasuk modul PDF interaktif, video pembahasan, dan kuis untuk setiap topik. Tahapannya dimulai dari pendaftaran, pembayaran, lalu Anda akan langsung mendapatkan akses penuh ke semua materi sesuai paket yang Anda pilih.
                </div>
            </div>
        </div>
        {{-- AKHIR PERUBAHAN --}}

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                    Bagaimana cara pembayaran?
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Pembayaran bisa melalui transfer bank, e-wallet.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 fade-in text-center">
    <div class="final-cta shadow">
        <h2 class="mb-4">Siap Bergabung dan Tingkatkan Skill Bahasa Inggrismu?</h2>
        <a href="{{ url('/register') }}" class="cta-btn">Gabung Sekarang</a>
    </div>
</div>

<script>
// Script sederhana untuk trigger animasi saat elemen masuk ke viewport
document.addEventListener("DOMContentLoaded", function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection