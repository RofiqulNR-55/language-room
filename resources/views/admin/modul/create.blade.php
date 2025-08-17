@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Modul Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.modul.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Modul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="jenjang" class="form-label">Jenjang</label>
            <select name="jenjang" id="jenjang" class="form-control" required>
                <option value="">-- Pilih Jenjang --</option>
                <option value="sd" {{ old('jenjang') == 'sd' ? 'selected' : '' }}>SD</option>
                <option value="smp" {{ old('jenjang') == 'smp' ? 'selected' : '' }}>SMP</option>
                <option value="sma" {{ old('jenjang') == 'sma' ? 'selected' : '' }}>SMA</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">File Modul (PDF)</label>
            <input type="file" name="file" id="file" class="form-control" accept=".pdf" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
