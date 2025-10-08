@extends('layouts.app')

@section('content')
{{-- Pastikan Font Awesome sudah terpasang di layouts/app.blade.php untuk ikon --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> --}}

{{-- Kita tambahkan sedikit CSS custom untuk sentuhan akhir --}}
<style>
    /* Sedikit style tambahan untuk mempercantik tampilan Bootstrap */
    .contact-hero {
        background: linear-gradient(45deg, #6f42c1, #2575fc);
        padding: 4rem 0;
        border-radius: .75rem;
    }
    .contact-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
        background-color: #e9ecef; /* Warna latar ikon yang soft */
        color: #6f42c1; /* Warna ikon utama */
    }
    .card-contact {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-contact:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
    }
    .map-container {
        border-radius: .75rem;
        overflow: hidden;
    }
</style>

<main class="container my-5">
    {{-- BAGIAN HEADER --}}
    <div class="contact-hero text-white text-center mb-5 shadow">
        <h1 class="display-4 fw-bold">Hubungi Kami</h1>
        <p class="lead">Kami selalu siap membantu. Temukan kami melalui informasi di bawah ini.</p>
    </div>

    <div class="row g-4">
        {{-- KOLOM KIRI - INFORMASI DETAIL --}}
        <div class="col-lg-6">
            <div class="card card-contact h-100 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title fw-bold mb-4">Detail Kontak</h3>
                    
                    {{-- Menggunakan List Group Bootstrap untuk tampilan rapi --}}
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center border-0 px-0">
                            <div class="contact-icon rounded-circle d-flex justify-content-center align-items-center me-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Alamat</h6>
                                <p class="mb-0 text-muted">jalan Darul Fahur, Pejarakan Karya, Ampenan</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center border-0 px-0 pt-3">
                            <div class="contact-icon rounded-circle d-flex justify-content-center align-items-center me-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Email</h6>
                                <a href="mailto:languangeroom@gmail.com" class="text-decoration-none">languangeroom@gmail.com</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center border-0 px-0 pt-3">
                            <div class="contact-icon rounded-circle d-flex justify-content-center align-items-center me-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">WhatsApp</h6>
                                <a href="https://wa.me/6287704720846" target="_blank" class="text-decoration-none">087704720846</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN - PETA LOKASI --}}
        <div class="col-lg-6">
            <div class="card card-contact h-100 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="card-title fw-bold mb-4">Lokasi Kami</h3>
                    <div class="map-container shadow-inner">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.323565261314!2d116.08271791478335!3d-8.583095393848135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbdc1d85b191b%3A0x6a12724497334181!2sJl.%20Darul%20Fahur%2C%20Pejarakan%20Karya%2C%20Kec.%20Ampenan%2C%20Kota%20Mataram%2C%20Nusa%20Tenggara%20Barat!5e0!3m2!1sen!2sid!4v1628109876543!5m2!1sen!2sid"
                            width="100%" 
                            height="340" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection 