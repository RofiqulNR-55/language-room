@extends('layouts.app')

@section('content')
{{-- Untuk hasil terbaik, tambahkan link Google Fonts ini di dalam <head> pada file layouts/app.blade.php Anda --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}
{{-- Jangan lupa tambahkan juga link Font Awesome jika belum ada --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> --}}

<link rel="stylesheet" href="{{ asset('css/kontak.css') }}">

<div class="contact-header text-center">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p class="lead">Kami siap mendengar pertanyaan, saran, dan masukan dari Anda.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="contact-info-card">
                <h4 class="mb-4 fw-bold">Informasi Kontak</h4>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <strong>Alamat</strong>
                        <p class="mb-0">Jl. Pendidikan No. 123, Jakarta Selatan, Indonesia</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <strong>Email</strong>
                        <p class="mb-0">languangeroom@gmail.com</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <strong>Telepon</strong>
                        <p class="mb-0"> 0878-6392-2794</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="contact-form-card">
                 <h4 class="mb-4 fw-bold">Kirim Pesan</h4>
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="subjek" class="form-label">Subjek</label>
                        <input type="text" class="form-control" id="subjek" name="subjek" required>
                    </div>
                    <div class="mb-3">
                        <label for="pesan" class="form-label">Pesan Anda</label>
                        <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-submit w-100">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
@endsection