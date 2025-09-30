@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <!-- Manajemen Paket -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Manajemen Paket</h5>
                        <p class="card-text small text-muted">Kelola paket bimbel online dan offline.</p>
                    </div>
                    <a href="{{ route('admin.paket.index') }}" class="btn btn-outline-primary">Kelola</a>
                </div>
            </div>
        </div>

         <!-- Manajemen Paket -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">daftar langganan siswa</h5>
                        <p class="card-text small text-muted">Kelola paket bimbel online dan offline.</p>
                    </div>
                    <a href="{{ route('admin.langganan.index') }}" class="btn btn-outline-primary">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Verifikasi Pembayaran -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Riwayat Transaksi</h5>
                        <p class="card-text small text-muted">Lihat dan verifikasi transaksi pembayaran.</p>
                    </div>
                    <a href="{{ route('admin.verifikasi.index') }}" class="btn btn-outline-primary">kelola</a>
                </div>
            </div>
        </div>

        <!-- Manajemen Modul -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Manajemen Modul</h5>
                        <p class="card-text small text-muted">Kelola semua modul pembelajaran.</p>
                    </div>
                    <a href="{{ route('admin.modul.index') }}" class="btn btn-outline-primary">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Manajemen Video -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Manajemen Video</h5>
                        <p class="card-text small text-muted">Kelola semua video pembelajaran.</p>
                    </div>
                    <a href="{{ route('admin.video.index') }}" class="btn btn-outline-primary">Kelola</a>
                </div>
            </div>
        </div>

        <!-- Manajemen Video -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Manajemen Quiz</h5>
                        <p class="card-text small text-muted">Kelola semua quiz.</p>
                    </div>
                    <a href="{{ route('admin.quiz.index') }}" class="btn btn-outline-primary">Kelola</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
