@extends('layouts.admin') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
<div class="container">
    <h1>Manajemen Kuis</h1>
    <a href="{{ route('admin.quiz.create') }}" class="btn btn-primary mb-3">Tambah Kuis Baru</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Jenjang</th>
                <th>Folder</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizzes as $quiz)
            <tr>
                <td>{{ $quiz->title }}</td>
                <td>{{ strtoupper($quiz->jenjang) }}</td>
                <td>{{ $quiz->folder }}</td>
                <td>
                    <a href="{{ route('admin.quiz.edit', $quiz) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.quiz.destroy', $quiz) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection