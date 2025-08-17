@extends('layouts.app')

@section('content')
{{-- Pastikan Anda sudah menambahkan link Google Fonts di layouts/app.blade.php jika belum --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}

<link rel="stylesheet" href="{{ asset('css/paket.css') }}">

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="modern-title">Paket Belajar <span class="title-highlight">Private</span></h2>
        <p class="text-muted">Pilih paket belajar tatap muka yang paling sesuai untukmu.</p>
        <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm mt-2">
            &larr; Kembali ke Beranda
        </a>
    </div>

    <div class="row justify-content-center">
        @forelse ($pakets as $paket)
            <div class="col-md-4 mb-4">
                <div class="card-paket h-100 d-flex flex-column">
                    <div class="paket-icon mb-3"><i class="fas fa-chalkboard-teacher"></i></div>
                    <h5 class="fw-bold">{{ $paket->nama }}</h5>
                    <span class="badge bg-primary mb-3 align-self-center">{{ $paket->kategori }}</span>
                    <p class="text-muted">{{ $paket->deskripsi }}</p>
                    <h4 class="fw-bold my-3">Rp {{ number_format($paket->harga, 0, ',', '.') }}</h4>

                    {{-- PERBAIKAN DI SINI: 'paket_id' diubah menjadi 'id' --}}
                    <a href="{{ route('checkout.form', ['id' => $paket->id]) }}" class="btn btn-paket mt-auto">Pesan Sekarang</a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Belum ada paket private yang tersedia saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection