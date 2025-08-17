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
        
        // Check if user has successful payment
        $hasPaid = Transaction::userHasPaid($user->id);
        
        if (!$hasPaid) {
            return redirect()->route('checkout.form')
                           ->with('error', 'Anda harus melakukan pembayaran terlebih dahulu untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
