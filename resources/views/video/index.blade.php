{{-- Impor helper di bagian atas file --}}
@php
    use App\Helpers\YouTubeHelper;
@endphp

@extends('layouts.admin')

@section('title', 'Manajemen Video')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Video</h1>
        <a href="{{ route('admin.video.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Video Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Jenjang</th>
                            <th>Tipe</th>
                            <th>Preview</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($videos as $video)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $video->judul }}</td>
                                <td>{{ strtoupper($video->jenjang) }}</td>
                                <td>{{ ucfirst($video->tipe) }}</td>
                                <td style="width: 250px;">
                                    @if ($video->tipe === 'youtube' && $video->link_youtube)
                                        @php
                                            $embedUrl = YouTubeHelper::getEmbedUrl($video->link_youtube);
                                        @endphp
                                        @if($embedUrl)
                                            <iframe width="100%" height="150" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                                        @else
                                            <span class="text-danger">Link YouTube tidak valid.</span>
                                        @endif
                                    @elseif ($video->tipe === 'file' && $video->path)
                                        <video width="100%" height="150" controls>
                                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                            Browser Anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.video.destroy', $video->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada video yang ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection