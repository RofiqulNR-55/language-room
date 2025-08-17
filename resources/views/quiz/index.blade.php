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
        }
        .quiz-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        .quiz-embed-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #f0f0f0;
            border-radius: 8px;
        }
        .quiz-embed-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <div class="container mt-5 mb-5">
        <div class="text-center quiz-header">
            <h1 class="fw-bold">🚀 Kuis Interaktif: {{ strtoupper($paket) }}</h1>
            <p class="lead mb-0">Uji dan asah pemahamanmu melalui kuis-kuis seru di bawah ini!</p>
        </div>

        @if($quizzes->isNotEmpty())
            <div class="row gy-4">
                @foreach($quizzes as $quiz)
                <div class="col-lg-12">
                    <div class="card quiz-card">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3"><i class="fas fa-puzzle-piece me-2" style="color:#8b5cf6;"></i>{{ $quiz->title }}</h5>
                            <div class="quiz-embed-container">
                                <iframe
                                    src="{{ $quiz->quiz_link }}"
                                    frameborder="0"
                                    allowfullscreen
                                ></iframe>
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
    