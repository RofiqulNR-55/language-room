@extends('layouts.app')

@section('title', 'Daftar Kuis Interaktif')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .quiz-header {
        background: linear-gradient(135deg, #8b5cf6, #6366f1);
        color: white;
        padding: 3rem 0;
        border-radius: 15px;
        margin-bottom: 2.5rem;
    }
    .quiz-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
    }
    .quiz-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }
    .quiz-embed-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* 16:9 */
        height: 0;
        overflow: hidden;
        border-radius: 12px;
        background: #f0f0f0;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    }
    .quiz-embed-container iframe {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%; border: none;
    }
    .quiz-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #4f46e5;
        margin-bottom: 0.5rem;
    }
</style>

<div class="container-fluid mt-5 mb-5">
    <div class="text-center quiz-header">
        <h1 class="fw-bold">🚀 Kuis Interaktif: {{ strtoupper($paket) }}</h1>
        <p class="lead mb-0">Uji dan asah pemahamanmu melalui kuis-kuis seru di bawah ini!</p>
    </div>

    {{-- Tampilkan daftar folder/kategori --}}
    <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
            @foreach($folders as $folder)
                <a href="?folder={{ urlencode($folder) }}" class="btn btn-outline-primary d-flex align-items-center" style="min-width:150px;">
                    <i class="fas fa-folder fa-lg me-2"></i> {{ $folder }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Jika folder dipilih, tampilkan quiz di dalamnya --}}
    @if($selectedFolder)
        <h4 class="mb-3"><i class="fas fa-folder-open me-2"></i> {{ $selectedFolder }}</h4>
        @if($quizzes->isNotEmpty())
            <div class="row gy-4">
                @foreach($quizzes as $quiz)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card quiz-card h-100">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="quiz-title mb-2"><i class="fas fa-puzzle-piece me-2" style="color:#8b5cf6;"></i>{{ $quiz->title }}</div>
                            <div class="quiz-embed-container mb-3">
                                <iframe src="{{ $quiz->quiz_link }}" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p>Tidak ada quiz di folder ini.</p>
        @endif
    @else
        <p class="text-muted">Silakan pilih folder untuk melihat quiz di dalamnya.</p>
    @endif

    @if($quizzes->isNotEmpty() && !$selectedFolder)
        <div class="row gy-4">
            @foreach($quizzes as $quiz)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card quiz-card h-100">
                    <div class="card-body d-flex flex-column p-4">
                        <div class="quiz-title mb-2"><i class="fas fa-puzzle-piece me-2" style="color:#8b5cf6;"></i>{{ $quiz->title }}</div>
                        <div class="quiz-embed-container mb-3">
                            <iframe src="{{ $quiz->quiz_link }}" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center p-5" style="background-color: #f8f9fa; border-radius: 15px;">
            <div style="font-size: 3rem;">😅</div>
            <h3 class="fw-bold mt-3">Oops! Belum Ada Kuis</h3>
            <p class="text-muted">Saat ini belum ada kuis yang tersedia untuk jenjang ini. Cek kembali nanti ya!</p>
            <a href="{{ route('materi.index') }}" class="btn btn-primary mt-3">Kembali ke Materi</a>
        </div>
    @endif
</div>
@endsection
