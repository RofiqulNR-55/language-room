@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Modul</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.modul.update', $modul->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Modul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ $modul->judul }}" required>
        </div>

        <div class="mb-3">
            <label for="jenjang" class="form-label">Jenjang</label>
            <select name="jenjang" id="jenjang" class="form-control" required>
                <option value="sd" {{ $modul->jenjang == 'sd' ? 'selected' : '' }}>SD</option>
                <option value="smp" {{ $modul->jenjang == 'smp' ? 'selected' : '' }}>SMP</option>
                <option value="sma" {{ $modul->jenjang == 'sma' ? 'selected' : '' }}>SMA</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">File Modul (PDF)</label>
            <p>File saat ini: <a href="{{ Storage::url($modul->file) }}" target="_blank">Lihat File</a></p>
            <input type="file" name="file" id="file" class="form-control" accept=".pdf">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti file.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
