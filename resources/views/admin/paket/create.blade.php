@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h2 class="modern-title fs-5 mb-0">Tambah <span class="title-highlight">Paket Baru</span></h2>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.paket.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Paket</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <select name="tipe" id="tipe" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Tipe --</option>
                                <option value="online" {{ old('tipe') == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="offline" {{ old('tipe') == 'offline' ? 'selected' : '' }}>Offline</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="SD" {{ old('kategori') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('kategori') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('kategori') == 'SMA' ? 'selected' : '' }}>SMA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga (Rp)</label>
                            <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.paket.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection