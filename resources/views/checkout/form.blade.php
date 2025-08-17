@extends('layouts.app')

@push('styles')
{{-- CSS Khusus untuk halaman ini --}}
<style>
    :root {
        --primary-color: #6f42c1;
        --secondary-color: #007bff;
        --light-color: #f8f9fa;
    }

    .auth-bg {
        background-color: var(--light-color);
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .checkout-card {
        background-color: #ffffff;
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .modern-title {
        font-weight: 700;
        color: #343a40;
    }

    .title-highlight {
        color: var(--primary-color);
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.85rem 1.1rem;
        border: 1px solid #ced4da;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
    }

    .btn-primary {
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border: none;
        font-weight: 600;
        padding: 0.85rem 1rem;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
    }
</style>
@endpush

@section('content')
<div class="auth-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="text-center mb-4" data-aos="fade-up">
                    <h2 class="modern-title">Formulir <span class="title-highlight">Pembayaran</span></h2>
                    <p class="text-muted">Selesaikan pesanan Anda untuk memulai petualangan belajar.</p>
                </div>

                <div class="card checkout-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('checkout.bayar') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium">Nama Lengkap</label>
                                <input type="text" id="name" class="form-control" value="{{ auth()->user()->name }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium">Email</label>
                                <input type="email" id="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-medium">Nomor Telepon (Aktif)</label>
                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Contoh: 081234567890" required>
                            </div>

                            <div class="mb-4">
                                <label for="paket_id" class="form-label fw-medium">Pilihan Paket</label>
                                <select name="paket_id" id="paket_id" class="form-select" required>
                                    <option value="" disabled {{ !$paketTerpilih ? 'selected' : '' }}>-- Pilih Paket --</option>
                                    @foreach ($pakets as $paket)
                                        <option value="{{ $paket->id }}"
                                            {{-- Logika untuk memilih paket secara otomatis --}}
                                            @if($paketTerpilih && $paketTerpilih->id == $paket->id) selected @endif>
                                            {{ $paket->nama }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Lanjutkan ke Pembayaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection