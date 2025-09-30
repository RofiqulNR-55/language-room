<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Transaction;

class SudahBayar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Ambil transaksi sukses terakhir
        $trx = Transaction::where('user_id', $user->id)
            ->where('status', 'success')
            ->latest()
            ->first();

        if (!$trx) {
            return redirect()->route('checkout.form')
                ->with('error', 'Anda harus melakukan pembayaran terlebih dahulu untuk mengakses halaman ini.');
        }

        // Cek expired
        if ($trx->expired_at && now()->greaterThan($trx->expired_at)) {
            return redirect()->route('checkout.form')
                ->with('error', 'Langganan Anda telah kedaluwarsa. Silakan perpanjang untuk mengakses konten.');
        }

        return $next($request);
    }
}
