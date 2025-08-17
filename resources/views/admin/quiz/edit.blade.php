{{-- resources/views/admin/quiz/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Kuis</h1>

    <form action="{{ route('admin.quiz.update', $quiz) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul Kuis</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $quiz->title }}" required>
        </div>
        <div class="mb-3">
            <label for="quiz_link" class="form-label">Link Embed Quizizz</label>
            <input type="url" class="form-control" id="quiz_link" name="quiz_link" value="{{ $quiz->quiz_link }}" required>
        </div>
        <div class="mb-3">
            <label for="jenjang" class="form-label">Jenjang</label>
            <select class="form-control" id="jenjang" name="jenjang" required>
                <option value="sd" @if($quiz->jenjang == 'sd') selected @endif>SD</option>
                <option value="smp" @if($quiz->jenjang == 'smp') selected @endif>SMP</option>
                <option value="sma" @if($quiz->jenjang == 'sma') selected @endif>SMA</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection