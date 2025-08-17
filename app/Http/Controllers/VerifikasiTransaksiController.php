<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class VerifikasiTransaksiController extends Controller
{
    /**
     * Menampilkan daftar transaksi untuk admin.
     * Tampilkan transaksi yang masih pending atau yang sudah gagal untuk ditinjau.
     */
    public function index()
    {
        $transaksis = Transaction::with(['user', 'paket'])
                                  // Menampilkan transaksi yang perlu perhatian: pending atau failed
                                  ->whereIn('status', ['pending', 'failed'])
                                  ->latest() // Mengurutkan dari yang terbaru
                                  ->get();
                                  
        return view('admin.verifikasi', compact('transaksis'));
    }

    /**
     * Memproses verifikasi (menyetujui) transaksi secara manual.
     * Ini berguna jika notifikasi Midtrans gagal karena suatu alasan.
     */
    public function verify($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $transaksi->status = 'success'; // Ubah status menjadi success
        $transaksi->save();

        return redirect()->route('admin.verifikasi.index')->with('success', 'Transaksi berhasil diverifikasi manual!');
    }

    /**
     * Menolak transaksi secara manual.
     */
    public function reject($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $transaksi->status = 'failed'; // Ubah status menjadi 'failed'
        $transaksi->save();

        // Perbaikan: route name yang benar adalah 'admin.verifikasi.index'
        return redirect()->route('admin.verifikasi.index')->with('success', 'Transaksi berhasil ditolak.');
    }

    /**
     * Menghapus data transaksi dari database.
     * Gunakan ini untuk membersihkan data transaksi yang gagal atau salah.
     */
    public function destroy($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('admin.verifikasi.index')->with('success', 'Transaksi berhasil dihapus permanen.');
    }
}