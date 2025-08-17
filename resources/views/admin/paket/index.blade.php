@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="modern-title">Manajemen <span class="title-highlight">Paket</span></h2>
        <a href="{{ route('admin.paket.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Paket Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pakets as $index => $paket)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $paket->nama }}</td>
                                <td>{{ ucfirst($paket->tipe) }}</td>
                                <td>Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                                <td>{{ Str::limit($paket->deskripsi, 50) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.paket.edit', $paket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.paket.destroy', $paket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada data paket.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection