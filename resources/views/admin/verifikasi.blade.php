@extends('layouts.admin')

@section('title', 'Verifikasi Transaksi')

@section('content')
<link rel="stylesheet" href="{{ asset('css/verifikasi.css') }}">

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi & Tinjau Transaksi</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 card-table">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Tertunda</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Paket</th>
                                    <th>Order ID</th>
                                    <th>Status</th>
                                    <th style="width: 25%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksis as $key => $trx)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $trx->user->name }}</td>
                                    <td>{{ $trx->paket->tipe ?? 'N/A' }}</td>
                                    <td>{{ $trx->order_id }}</td>
                                    <td>
                                        @if($trx->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($trx->status == 'failed')
                                            <span class="badge bg-danger">Gagal</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($trx->status == 'pending')
                                            {{-- Tombol untuk Menyetujui --}}
                                            <form action="{{ route('admin.verifikasi.verify', $trx->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm">Setujui</button>
                                            </form>

                                            {{-- Tombol untuk Menolak --}}
                                            <form action="{{ route('admin.verifikasi.reject', $trx->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-secondary btn-sm">Tolak</button>
                                            </form>
                                        @endif

                                        @if($trx->status == 'failed')
                                             {{-- Tombol untuk Menghapus --}}
                                             <form action="{{ route('admin.verifikasi.destroy', $trx->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada transaksi yang perlu ditinjau.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection