@extends('layouts.admin')

@section('title', 'Manajemen Langganan Siswa')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Daftar Langganan Siswa</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Paket</th>
                    <th>Tipe</th>
                    <th>Durasi Paket</th>
                    <th>Durasi Aktif</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Kedaluwarsa</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $trx)
                <tr>
                    <td>{{ $trx->user->name }}</td>
                    <td>{{ $trx->paket->nama }}</td>
                    <td>{{ $trx->paket->tipe }}</td>
                    <td>
                        {{ $trx->paket->durasi ?? '-' }} hari
                    </td>
                    <td>
                        @if($trx->start_at && $trx->expired_at)
                            {{ $trx->start_at->diffForHumans($trx->expired_at, true) }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $trx->start_at ? $trx->start_at->format('d-m-Y H:i') : '-' }}</td>
                    <td>{{ $trx->expired_at ? $trx->expired_at->format('d-m-Y H:i') : '-' }}</td>
                    <td>
                        @if($trx->expired_at && $trx->expired_at->isPast())
                            <span class="badge bg-danger">Expired</span>
                        @elseif($trx->status === 'success')
                            <span class="badge bg-success">Aktif</span>
                            <form action="{{ route('admin.langganan.cancel', $trx->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin membatalkan langganan ini?')">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ms-2">Batalkan</button>
                            </form>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($trx->status) }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
