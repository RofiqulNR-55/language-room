@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Video Pembelajaran</h3>
        </div>

        <form action="{{ route('admin.video.update', $video->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $video->judul) }}" required>
                </div>

                <div class="form-group">
                    <label for="jenjang">Jenjang</label>
                    <select name="jenjang" id="jenjang" class="form-control" required>
                        <option value="sd" {{ $video->jenjang === 'sd' ? 'selected' : '' }}>SD</option>
                        <option value="smp" {{ $video->jenjang === 'smp' ? 'selected' : '' }}>SMP</option>
                        <option value="sma" {{ $video->jenjang === 'sma' ? 'selected' : '' }}>SMA</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="folder">Folder/Kategori Video</label>
                    <select name="folder" id="folder" class="form-control" onchange="toggleFolderInput(this.value)">
                        <option value="">-- Pilih Folder/Kategori --</option>
                        @foreach($folders as $folder)
                            <option value="{{ $folder }}" {{ $video->folder == $folder ? 'selected' : '' }}>{{ $folder }}</option>
                        @endforeach
                        <option value="__new__">+ Buat Folder Baru</option>
                    </select>
                    <input type="text" name="folder_new" id="folder_new" class="form-control mt-2 d-none" placeholder="Nama folder baru">
                </div>

                <div class="form-group">
                    <label for="tipe">Tipe Video</label>
                    <select name="tipe" id="tipe" class="form-control" onchange="toggleInput()" required>
                        <option value="link" {{ $video->tipe === 'link' ? 'selected' : '' }}>Link YouTube</option>
                        <option value="file" {{ $video->tipe === 'file' ? 'selected' : '' }}>Upload File</option>
                    </select>
                </div>

                <div class="form-group" id="linkInput" style="{{ $video->tipe === 'link' }}">
                    <label for="url">URL Video YouTube</label>
                    <input type="url" name="url" id="url" class="form-control" value="{{ old('url', $video->tipe === 'link' ? $video->url : '') }}">
                </div>

                <div class="form-group" id="fileInput" style="{{ $video->tipe === 'file' ? '' : 'display: none;' }}">
                    <label for="file">Upload Video Baru</label>
                    <input type="file" name="file" id="file" class="form-control" accept="video/mp4">
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>

                    @if($video->tipe === 'file' && $video->url)
                        <br><a href="{{ asset('storage/' . $video->url) }}" target="_blank" class="btn btn-sm btn-outline-info mt-2">Lihat Video Lama</a>
                    @endif
                </div>
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('admin.video.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleInput() {
        const tipe = document.getElementById('tipe').value;
        document.getElementById('linkInput').style.display = (tipe === 'link') ? '' : 'none';
        document.getElementById('fileInput').style.display = (tipe === 'file') ? '' : 'none';
    }
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
        toggleInput();
        document.getElementById('folder').addEventListener('change', function() {
            toggleFolderInput(this.value);
        });
    });
</script>
@endsection
