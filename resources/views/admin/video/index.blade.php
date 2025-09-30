@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Video Pembelajaran</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.video.create') }}" class="btn btn-success mb-3">Tambah Video</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Jenjang</th>
                <th>Folder</th>
                <th>Tipe</th>
                <th>Preview</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($videos as $index => $video)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $video->judul }}</td>
                    <td>{{ strtoupper($video->jenjang) }}</td>
                    <td>{{ $video->folder }}</td>
                    <td>{{ ucfirst($video->tipe) }}</td>
                    <td style="max-width: 300px;">
                        @if (Str::startsWith($video->url, 'http'))
                            <iframe width="560" height="315" src="{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        @else
                            <video width="100%" height="150" controls>
                                <source src="{{ asset('storage/' . $video->url) }}" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.video.edit', $video->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.video.destroy', $video->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada video.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
