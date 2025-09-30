@extends('layouts.app')

@push('styles')
{{-- CSS Khusus untuk halaman ini --}}
<style>
    :root {
        --primary-color: #6f42c1;
        --secondary-color: #007bff;
        --success-color: #1cc88a;
        --warning-color: #f6c23e;
        --danger-color: #e74a3b;
        --light-color: #f8f9fa;
    } 

    .payment-container {
        background-color: var(--light-color);
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .payment-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        padding: 3rem;
        max-width: 550px;
        width: 100%;
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .payment-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
    }

    .icon-primary { color: var(--primary-color); }
    .icon-success { color: var(--success-color); }
    .icon-warning { color: var(--warning-color); }
    .icon-danger { color: var(--danger-color); }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #5a349a;
        border-color: #5a349a;
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid payment-container">
    <div class="text-center">
        <div id="payment-process" class="payment-card">
            <div class="spinner-border icon-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h2 class="mt-3">Memproses Pembayaran...</h2>
            <p class="text-muted">Anda akan diarahkan ke halaman pembayaran Midtrans. Mohon jangan tutup halaman ini.</p>
        </div>

        <div id="payment-result" class="payment-card" style="display: none;">
            <div id="payment-icon-container"></div>
            <h2 id="payment-title" class="mt-3"></h2>
            <p id="payment-message" class="text-muted"></p>
            <a href="{{ route('materi.index') }}" class="btn btn-primary mt-3" style="display: none;" id="btn-lanjut">Lanjutkan Belajar</a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3" style="display: none;" id="btn-dashboard">Kembali ke Beranda</a>
    </div>
</div>

{{-- Script Midtrans --}}
<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

<script type="text/javascript">
    // Fungsi untuk menampilkan hasil
    function showResult(status, title, message) {
        document.getElementById('payment-process').style.display = 'none';
        document.getElementById('payment-result').style.display = 'block';
        
        const iconContainer = document.getElementById('payment-icon-container');
        let iconHtml = '';

        switch(status) {
            case 'success':
                iconHtml = '<i class="fas fa-check-circle payment-icon icon-success"></i>';
                document.getElementById('btn-lanjut').style.display = 'inline-block';
                break;
            case 'pending':
                iconHtml = '<i class="fas fa-hourglass-half payment-icon icon-warning"></i>';
                document.getElementById('btn-dashboard').style.display = 'inline-block';
                break;
            case 'error':
                iconHtml = '<i class="fas fa-times-circle payment-icon icon-danger"></i>';
                document.getElementById('btn-dashboard').style.display = 'inline-block';
                break;
            case 'close':
                iconHtml = '<i class="fas fa-info-circle payment-icon icon-primary"></i>';
                document.getElementById('btn-dashboard').style.display = 'inline-block';
                break;
        }
        
        iconContainer.innerHTML = iconHtml;
        document.getElementById('payment-title').innerText = title;
        document.getElementById('payment-message').innerText = message;
    }

    // Panggil Snap Midtrans
    window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
            console.log(result);
            showResult('success', 'Pembayaran Berhasil!', 'Terima kasih! Pembayaran Anda telah kami terima. Anda sekarang memiliki akses ke materi pembelajaran.');
        },
        onPending: function(result) {
            console.log(result);
            showResult('pending', 'Pembayaran Tertunda', 'Kami menunggu pembayaran Anda. Silakan selesaikan pembayaran sebelum batas waktu berakhir.');
        },
        onError: function(result) {
            console.log(result);
            showResult('error', 'Pembayaran Gagal', 'Terjadi kesalahan saat memproses pembayaran Anda. Silakan coba lagi.');
        },
        onClose: function() {
            showResult('close', 'Pembayaran Dibatalkan', 'Anda menutup jendela pembayaran sebelum menyelesaikan transaksi.');
        }
    });
</script>
@endsection