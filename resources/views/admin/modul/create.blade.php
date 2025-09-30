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
                    <input type="text" name="folder" id="folder" class="form-control" list="folderList" placeholder="Ketik atau pilih folder" required>
                    <datalist id="folderList">
                        @foreach($folders as $folder)
                            <option value="{{ $folder }}">
                        @endforeach
                    </datalist>
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File Modul</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                    <small class="form-text text-muted">Bisa upload PDF, DOC, DOCX, PPT, dll.</small>
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
document.addEventListener('DOMContentLoaded', function() {
    const folderInput = document.getElementById('folder');
    folderInput.addEventListener('input', function() {
        const value = this.value;
        const dataList = document.getElementById('folderList');
        let optionExists = false;

        for (let i = 0; i < dataList.options.length; i++) {
            if (dataList.options[i].value === value) {
                optionExists = true;
                break;
            }
        }

        if (!optionExists) {
            const newOption = document.createElement('option');
            newOption.value = value;
            dataList.appendChild(newOption);
        }
    });
});
</script>
@endsection
