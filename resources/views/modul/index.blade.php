@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="mb-3">Daftar Modul untuk {{ strtoupper($jenjang) }}</h2>

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

    {{-- Jika folder dipilih, tampilkan file di dalamnya --}}
    @if($selectedFolder)
        <h4 class="mb-3"><i class="fas fa-folder-open me-2"></i> {{ $selectedFolder }}</h4>
        @if($moduls->isNotEmpty())
            <div class="row gy-4">
                @foreach ($moduls as $modul)
                    @php
                        $url = Storage::url($modul->file);
                        $ext = pathinfo($modul->file, PATHINFO_EXTENSION);
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-3"><i class="fas fa-file-{{ $ext == 'pdf' ? 'pdf text-danger' : 'alt text-primary' }} me-2"></i>{{ $modul->judul }}</h5>
                                <div class="text-center my-3">
                                    @if($ext == 'pdf')
                                        <iframe src="{{ asset('storage/' . $modul->file) }}" width="100%" style="max-width:400px; height:300px;" class="mx-auto d-block rounded shadow"></iframe>
                                    @else
                                        <a href="{{ $url }}" target="_blank" class="btn btn-outline-secondary">Lihat File</a>
                                    @endif
                                </div>
                                <a href="{{ $url }}" class="btn btn-primary btn-sm w-100 mt-auto" download>Download</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Tidak ada file di folder ini.</p>
        @endif
    @else
        <p class="text-muted">Silakan pilih folder untuk melihat file modul di dalamnya.</p>
    @endif
</div>
@endsection