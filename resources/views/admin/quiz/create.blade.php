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
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection