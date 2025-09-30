<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class LanggananController extends Controller
{
    public function index()
    {
        $transaksis = Transaction::with(['user', 'paket'])
            ->orderByDesc('created_at')
            ->get();
        return view('admin.langganan', compact('transaksis'));
    }

    public function cancel($id)
    {
        $trx = Transaction::findOrFail($id);
        $trx->status = 'cancel';
        $trx->expired_at = now();
        $trx->save();
        return redirect()->route('admin.langganan.index')->with('success', 'Langganan berhasil dibatalkan.');
    }
}
