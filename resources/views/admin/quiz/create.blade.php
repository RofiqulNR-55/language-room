{{-- resources/views/admin/quiz/create.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Kuis Baru</h1>

    <form action="{{ route('admin.quiz.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Kuis</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="quiz_link" class="form-label">Link Embed Quizizz</label>
            <input type="url" class="form-control" id="quiz_link" name="quiz_link" placeholder="https://quizizz.com/embed/quiz/..." required>
        </div>
        <div class="mb-3">
            <label for="jenjang" class="form-label">Jenjang</label>
            <select class="form-control" id="jenjang" name="jenjang" required>
                <option value="sd">SD</option>
                <option value="smp">SMP</option>
                <option value="sma">SMA</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="folder" class="form-label">Folder/Kategori Kuis</label>
            <select name="folder" id="folder" class="form-control" onchange="toggleFolderInput(this.value)">
                <option value="">-- Pilih Folder/Kategori --</option>
                @foreach($folders as $folder)
                    <option value="{{ $folder }}">{{ $folder }}</option>
                @endforeach
                <option value="__new__">+ Buat Folder Baru</option>
            </select>
            <input type="text" name="folder_new" id="folder_new" class="form-control mt-2 d-none" placeholder="Nama folder baru">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
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