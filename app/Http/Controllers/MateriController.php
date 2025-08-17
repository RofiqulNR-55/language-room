<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Transaction;
use App\Models\Modul;
use App\Models\Quiz;

class MateriController extends Controller
{
    /**
     * Menampilkan halaman materi berdasarkan paket yang dibeli pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 1. Dapatkan pengguna yang sedang login
        $user = auth()->user();

        // 2. Cari transaksi terakhir yang sukses dari pengguna
        $trx = Transaction::where('user_id', $user->id)
            ->where('status', 'success')
            ->with('paket') // Eager load relasi paket untuk efisiensi
            ->latest()
            ->first();

        // 3. Inisialisasi variabel untuk dikirim ke view
        $paket = null;
        $videos = [];
        $moduls = [];
        $quizzes = [];

        // 4. Jika transaksi dan paket ditemukan
        if ($trx && $trx->paket) {
            // Ambil nama jenjang dari kategori paket (misal: 'sd', 'smp', 'sma')
            $paket = strtolower($trx->paket->kategori);

            // Ambil semua data materi yang sesuai dengan jenjang paket
            $videos = Video::where('jenjang', $paket)->get();
            $moduls = Modul::where('jenjang', $paket)->get();
            $quizzes = Quiz::where('jenjang', $paket)->latest()->get();
        }

        // 5. Kirim semua data ke view 'materi.index'
        return view('materi.index', compact('paket', 'videos', 'moduls', 'quizzes'));
    }
}