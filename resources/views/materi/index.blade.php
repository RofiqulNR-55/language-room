@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/media-pembelajaran.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .hero-materi {
        padding: 3rem 0;
        background: url('https://www.toptal.com/designers/subtlepatterns/uploads/fancy-deboss.png');
        border-bottom: 1px solid #eee;
    }
    .media-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
    }
    .media-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }
    .media-card .icon-wrapper {
        height: 80px;
        width: 80px;
        margin: 0 auto 1.5rem auto;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #fff;
    }
    .modul .icon-wrapper { background: linear-gradient(135deg, #22c55e, #4ade80); }
    .video .icon-wrapper { background: linear-gradient(135deg, #f97316, #fb923c); }
    .kuis .icon-wrapper { background: linear-gradient(135deg, #8b5cf6, #a78bfa); }
    .chatbot .icon-wrapper { background: linear-gradient(135deg, #3b82f6, #60a5fa); }
    .media-card .media-title { font-weight: 700; font-size: 1.25rem; }
    .media-card .media-desc { color: #6b7280; margin-bottom: 1.5rem; }
    .media-card .media-btn {
        display: block;
        width: 100%;
        text-decoration: none;
        padding: 0.75rem;
        border-radius: 0.5rem;
        font-weight: 600;
        color: #fff;
        transition: background-color 0.2s;
    }
    .modul .media-btn { background-color: #22c55e; }
    .video .media-btn { background-color: #f97316; }
    .kuis .media-btn { background-color: #8b5cf6; }
    .chatbot .media-btn { background-color: #3b82f6; }
    .media-btn:hover { color: #fff; opacity: 0.9; }
</style>

<div class="container-fluid hero-materi">
    <div class="container">
        <div class="text-center">
            <h1 class="fw-bold" style="font-size:2.5rem; color:#111827;">Pusat Pembelajaran</h1>
            <p class="lead" style="color:#4b5563;">Semua yang kamu butuhkan untuk jadi juara ada di sini. Ayo mulai petualangan belajarmu!</p>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    @if($paket)
        <div class="media-grid">
            <!-- Modul Pembelajaran Card -->
            <div class="media-card modul">
                <div class="icon-wrapper"><i class="fas fa-book-open"></i></div>
                <div class="media-title">Modul {{ strtoupper($paket) }}</div>
                <div class="media-desc">Kumpulan materi & bank soal lengkap untukmu.</div>
                <a href="{{ url('/modul/' . $paket) }}" class="media-btn">Buka Modul</a>
            </div>

            <!-- Video Pembelajaran Card -->
            <div class="media-card video">
                <div class="icon-wrapper"><i class="fas fa-video"></i></div>
                <div class="media-title">Video {{ strtoupper($paket) }}</div>
                <div class="media-desc">Tonton video penjelasan agar makin paham.</div>
                <a href="{{ url('/video/' . $paket) }}" class="media-btn">Lihat Video</a>
            </div>

            <!-- Kuis Interaktif Card -->
            <div class="media-card kuis">
                <div class="icon-wrapper"><i class="fas fa-puzzle-piece"></i></div>
                <div class="media-title">Kuis {{ strtoupper($paket) }}</div>
                <div class="media-desc">Uji pemahamanmu dengan kuis-kuis seru.</div>
                <a href="{{ route('quiz.list', ['paket' => $paket]) }}" class="media-btn">Mulai Kuis</a>
            </div>

            <!-- Chatbot Card -->
            <div class="media-card chatbot">
                <div class="icon-wrapper"><i class="fas fa-robot"></i></div>
                <div class="media-title">AI Chatbot Tutor</div>
                <div class="media-desc">Tanya apa saja seputar materi, kapan pun.</div>
                <a href="/chatbot" target="_blank" class="media-btn">Tanya AI</a>
            </div>
        </div>
    @else
        {{-- Tampilan jika tidak ada paket aktif --}}
        <div class="text-center p-5" style="background-color: #f8f9fa; border-radius: 15px;">
            <div style="font-size: 3rem;">⚠️</div>
            <h3 class="fw-bold mt-3">Anda Belum Memiliki Paket Aktif</h3>
            <p class="text-muted">Untuk mengakses semua modul, video, dan kuis interaktif, silakan pilih paket belajar yang sesuai untuk Anda.</p>
            <a href="{{ route('paket.online') }}" class="btn btn-primary btn-lg mt-3">Lihat Pilihan Paket</a>
        </div>
    @endif
</div>
@endsection
