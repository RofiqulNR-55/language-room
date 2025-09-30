<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log; // Import Log facade

class MidtransCallbackController extends Controller
{
    public function callback(Request $request)
    {
        // 1. Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            // 2. Buat instance notifikasi Midtrans
            $notification = new Notification();

            // 3. Ambil data notifikasi
            $status = $notification->transaction_status;
            $type = $notification->payment_type;
            $order_id = $notification->order_id;
            $fraud = $notification->fraud_status;

            // Log notifikasi untuk debugging
            Log::info("Midtrans Notification Received. Order ID: {$order_id}, Status: {$status}");

            // 4. Cari transaksi berdasarkan order_id
            $transaction = Transaction::where('order_id', $order_id)->first();

            // 5. Lakukan update status transaksi
            if ($transaction) {
                if ($status == 'capture' || $status == 'settlement') {
                    $transaction->status = 'success';
                    // Set tanggal mulai dan expired jika belum ada
                    if (!$transaction->start_at || !$transaction->expired_at) {
                        $transaction->start_at = now();
                        // Ambil durasi dari paket (default 30 hari jika null)
                        $durasi = $transaction->paket && $transaction->paket->durasi ? $transaction->paket->durasi : 30;
                        $transaction->expired_at = now()->addDays($durasi);
                    }
                } elseif ($status == 'pending') {
                    $transaction->status = 'pending';
                } elseif ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
                    $transaction->status = 'failed';
                }
                $transaction->save();
            }

            // Beri respons OK ke Midtrans
            return response()->json(['message' => 'Notification handled successfully.']);

        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error("Midtrans Callback Error: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}