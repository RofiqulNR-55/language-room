@extends('layouts.admin')

@section('content')
<div class="container py-3">
    <h1 class="mb-4">Tambah Modul Baru</h1>

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9 col-12">
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
                    <label for="folder" class="form-label">Folder/Kategori Modul</label>
                    <select name="folder" id="folder" class="form-control" onchange="toggleFolderInput(this.value)">
                        <option value="">-- Pilih Folder/Kategori --</option>
                        @foreach($folders as $folder)
                            <option value="{{ $folder }}">{{ $folder }}</option>
                @endforeach
                <option value="__new__">+ Buat Folder Baru</option>
            </select>
                    <input type="text" name="folder_new" id="folder_new" class="form-control mt-2 d-none" placeholder="Nama folder baru">
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File Modul</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 mb-2 mb-md-0">
                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary w-100">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleFolderInput(val) {
    const input = document.getElementById('folder_new');
    if (val === '__new__') {
        input.classList.remove('d-none');
        input.required = true;
    } else {
        input.classList.add('d-none');
        input.required = false;
    }
}
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('folder').addEventListener('change', function() {
        toggleFolderInput(this.value);
    });
});
</script>
@endsection
