@extends('layouts.admin')

@section('title', 'Verifikasi Transaksi')

<link rel="stylesheet" href="{{ asset('css/verify.css') }}">


@section('content')
<div class="container-fluid">
    {{-- Header Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">Transaksi</h1>
    </div>

    {{-- Alert untuk Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card untuk Tabel Data dengan kelas kustom --}}
    <div class="card custom-card mb-4">
        <div class="card-header bg-transparent py-3">
            <h6 class="m-0 fw-bold text-primary">Riwayat Transaksi terbaru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="custom-header">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Paket</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $key => $trx)
                        <tr>
                            <td class="fw-semibold">{{ $key + 1 }}</td>
                            <td>{{ $trx->user->name ?? 'User Dihapus' }}</td>
                            <td>{{ $trx->paket->tipe ?? 'N/A' }}</td>
                            <td class="font-monospace">{{ $trx->order_id }}</td>
                            <td>
                                @if($trx->status == 'pending')
                                    <span class="status-badge pending"><i class="fas fa-clock me-1"></i> Pending</span>
                                @elseif($trx->status == 'failed' || $trx->status == 'cancel' || $trx->status == 'expire')
                                    <span class="status-badge failed"><i class="fas fa-times-circle me-1"></i> Gagal</span>
                                @elseif($trx->status == 'success' || $trx->status == 'settlement')
                                    <span class="status-badge success"><i class="fas fa-check-circle me-1"></i> Berhasil</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($trx->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $trx->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="fas fa-folder-open fa-2x mb-3"></i>
                                <p class="mb-0">Tidak ada data transaksi yang ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            
        </div>
    </div>
</div>
@endsection