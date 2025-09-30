@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Daftar Modul PDF untuk {{ strtoupper($jenjang) }}</h2>

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
            <div class="list-group">
                @foreach ($moduls as $modul)
                    @php
                        $url = Storage::url($modul->file);
                    @endphp
                    <div class="mb-4 border p-3 rounded shadow-sm">
                        <h5><i class="fas fa-file-pdf me-2 text-danger"></i>{{ $modul->judul }}</h5>
                        <iframe src="{{ $url }}" width="100%" height="400px" class="mb-2"></iframe>
                        <div>
                            <a href="{{ $url }}" download class="btn btn-sm btn-primary">Download</a>
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