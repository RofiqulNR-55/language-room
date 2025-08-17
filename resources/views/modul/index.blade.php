@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Daftar Modul PDF untuk {{ strtoupper($jenjang) }}</h2>

    @if($moduls->isNotEmpty())
        <div class="list-group">
            @foreach ($moduls as $modul)
                @php
                    // 3. Ambil URL dari path file modul
                    $url = Storage::url($modul->file);
                @endphp
                <div class="mb-4 border p-3 rounded shadow-sm">
                    <h5>{{ $modul->judul }}</h5>
                    <iframe src="{{ $url }}" width="100%" height="400px" class="mb-2"></iframe>
                    <div>
                        <a href="{{ $url }}" download class="btn btn-sm btn-primary">Download</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Belum ada modul tersedia untuk jenjang {{ strtoupper($jenjang) }}.</p>
    @endif
</div>
@endsection