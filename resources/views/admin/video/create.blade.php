@extends('layouts.admin')

@section('title', 'Tambah Video')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Video Pembelajaran</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.video.index') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Video</label>
                            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul video" required>
                        </div>

                        {{-- Jenjang --}}
                        <div class="mb-3">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <select name="jenjang" id="jenjang" class="form-select" required>
                                <option value="sd">SD</option>
                                <option value="smp">SMP</option>
                                <option value="sma">SMA</option>
                            </select>
                        </div>

                        {{-- Tipe --}}
                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe Video</label>
                            <select name="tipe" id="tipe" class="form-select" required onchange="toggleInput(this.value)">
                                <option value="link">Link YouTube</option>
                                <option value="file">Upload File</option>
                            </select>
                        </div>

                        {{-- Input Link --}}
                        <div class="mb-3" id="linkInput">
                            <label for="url" class="form-label">Link YouTube</label>
                            <input type="url" name="url" id="url" class="form-control" placeholder="Masukkan link YouTube">
                        </div>

                        {{-- Input File --}}
                        <div class="mb-3 d-none" id="fileInput">
                            <label for="file" class="form-label">Upload File Video (mp4)</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.video.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function toggleInput(value) {
    const linkInput = document.getElementById('linkInput');
    const fileInput = document.getElementById('fileInput');

    if (value === 'file') {
        linkInput.classList.add('d-none');
        fileInput.classList.remove('d-none');
    } else {
        linkInput.classList.remove('d-none');
        fileInput.classList.add('d-none');
    }
}
</script>
@endsection
