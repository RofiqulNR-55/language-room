<?php

use App\Http\Controllers\Admin\ModulController as AdminModulController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\VerifikasiTransaksiController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing.index');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Utama
Route::get('/', function () {
    return view('landing.index');
});

// Rute Auth (Login, Register, Logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Tampilan Paket untuk Pengguna
Route::get('/paket-online', [PaketController::class, 'online'])->name('paket.online');
Route::get('/paket-offline', [PaketController::class, 'offline'])->name('paket.offline');

// --- GRUP UNTUK PENGGUNA YANG SUDAH LOGIN ---
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    Route::get('/checkout/{id}', [CheckoutController::class, 'form'])->name('checkout.form');
    Route::post('/checkout/bayar', [CheckoutController::class, 'bayar'])->name('checkout.bayar');
    Route::get('/payment/{id}', [CheckoutController::class, 'payment'])->name('checkout.payment');

    // Rute Materi (dilindungi middleware 'sudah.bayar')
    Route::middleware(['sudah.bayar'])->group(function () {
        Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
        Route::get('/modul/{paket}', [ModulController::class, 'index'])->name('modul.index');
        Route::get('/video/{paket}', [VideoController::class, 'index'])->name('video.index');
        Route::get('/quiz/{paket}', [QuizController::class, 'index'])->name('quiz.list');
    });

    Route::get('/chatbot', function () {
    return view('chatbot.index');
})->name('chatbot.index');
});

// --- GRUP KHUSUS UNTUK ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Rute Admin
    Route::get('/verifikasi', [VerifikasiTransaksiController::class, 'index'])->name('verifikasi.index');
    Route::post('/verifikasi/{id}/verify', [VerifikasiTransaksiController::class, 'verify'])->name('verifikasi.verify');
    Route::post('/verifikasi/{id}/reject', [VerifikasiTransaksiController::class, 'reject'])->name('verifikasi.reject');
    Route::delete('/verifikasi/{id}', [VerifikasiTransaksiController::class, 'destroy'])->name('verifikasi.destroy');
    
    // Perbaikan ada di sini: HANYA SATU DEFINISI resource paket
    Route::resource('paket', PaketController::class);
    Route::resource('modul', AdminModulController::class);
    Route::resource('video', AdminVideoController::class);
    Route::resource('quiz', AdminQuizController::class)->except(['show']);
    Route::get('langganan', [\App\Http\Controllers\Admin\LanggananController::class, 'index'])->name('langganan.index');
    Route::post('langganan/{id}/cancel', [\App\Http\Controllers\Admin\LanggananController::class, 'cancel'])->name('langganan.cancel');
});

Route::post('/midtrans/callback', [MidtransCallbackController::class, 'callback'])->name('midtrans.callback');

//kontak 
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');

Route::post('/ai-tutor/chat', [ChatbotController::class, 'chat'])->name('chatbot.chat');

// Ganti atau tambahkan rute ini
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak/send', [ContactController::class, 'send'])->name('kontak.send');

Route::get('/list-models', [ChatbotController::class, 'listAvailableModels']);