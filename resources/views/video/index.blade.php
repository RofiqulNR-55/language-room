@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="text-center mb-5">
        <h1 class="fw-bolder">Video Pembelajaran Jenjang {{ strtoupper($jenjang) }}</h1>
        <p class="lead text-muted">Tonton video-video pilihan untuk membantumu belajar.</p>
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

    {{-- Jika folder dipilih, tampilkan video di dalamnya --}}
    @if($selectedFolder)
        <h4 class="mb-3"><i class="fas fa-folder-open me-2"></i> {{ $selectedFolder }}</h4>
        @if($videos->isNotEmpty())
            <div class="row gy-4">
                @foreach ($videos as $video)
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-3">{{ $video->judul }}</h5>
                                <div class="text-center my-3">
                                    @if (Str::startsWith($video->url, 'http'))
                                        <iframe width="100%" style="max-width:600px; height:340px;" src="{{ $video->url }}" class="mx-auto d-block rounded shadow" allowfullscreen></iframe>
                                    @else
                                        <video width="100%" style="max-width:600px; height:340px;" controls class="mx-auto d-block rounded shadow">
                                            <source src="{{ asset('storage/' . $video->url) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                </div>
                                <div class="mt-auto">
                                    @if(isset($video->tipe) && $video->tipe === 'file')
                                        <a href="{{ asset('storage/' . $video->url) }}" download class="btn btn-sm btn-primary">
                                            <i class="fas fa-download me-1"></i> Download Video
                                        </a>
                                    @else
                                        <a href="{{ $video->url }}" target="_blank" class="btn btn-sm btn-danger">
                                            <i class="fab fa-youtube me-1"></i> Tonton di YouTube
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Tidak ada video di folder ini.</p>
        @endif
    @else
        <p class="text-muted">Silakan pilih folder untuk melihat video di dalamnya.</p>
    @endif
</div>
@endsection