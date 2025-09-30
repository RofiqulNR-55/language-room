@extends('layouts.app')

@section('content')
{{-- Pastikan Anda sudah menambahkan link Google Fonts di layouts/app.blade.php jika belum --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}

<link rel="stylesheet" href="{{ asset('css/paket.css') }}">
{{-- Link Font Awesome untuk ikon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                <div class="card-paket h-100 d-flex flex-column shadow-sm border-0">
                    <div class="card-body p-4 d-flex flex-column h-100">
                        <div class="text-center mb-3">
                            <i class="fas fa-chalkboard-teacher paket-icon"></i>
                        </div>
                        <h5 class="fw-bold text-center">{{ $paket->nama }}</h5>
                        <span class="badge bg-primary mb-3 mx-auto">{{ $paket->kategori }}</span>
                        
                        {{-- Menggunakan list untuk deskripsi yang lebih rapi --}}
                        <ul class="list-unstyled flex-grow-1">
                            @php
                                // Asumsi deskripsi dipisahkan oleh titik
                                $deskripsiPoin = explode('.', $paket->deskripsi);
                            @endphp
                            @foreach($deskripsiPoin as $poin)
                                @if(trim($poin) != '')
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="fas fa-check-circle text-primary me-2 mt-1"></i>
                                        <span class="text-muted text-start">{{ trim($poin) }}.</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        
                        <div class="text-center mb-2">
                            <span class="badge bg-info">Durasi: {{ $paket->durasi }} hari</span>
                        </div>
                        <h4 class="fw-bold my-3 mt-auto text-center">Rp {{ number_format($paket->harga, 0, ',', '.') }}</h4>
                        <a href="{{ route('checkout.form', ['id' => $paket->id]) }}" class="btn btn-primary btn-block">Pesan Sekarang</a>
                    </div>
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