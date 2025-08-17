@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Modul</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.modul.create') }}" class="btn btn-primary mb-3">Tambah Modul</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Judul Modul</th>
                <th>Jenjang</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($moduls as $index => $modul)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $modul->judul }}</td>
                    <td>{{ strtoupper($modul->jenjang) }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $modul->file) }}" target="_blank">Lihat PDF</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.modul.edit', $modul->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.modul.destroy', $modul->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus modul ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada modul.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
