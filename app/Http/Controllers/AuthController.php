<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    /**
     * Menampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('Auth.register');
    }

    /**
     * Memproses data login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Logika redirect setelah login
            if (auth()->user()->role === 'admin') {
                // Jika admin, arahkan ke dashboard admin
                return redirect()->route('admin.dashboard');
            } else {
                // Jika user biasa, arahkan ke halaman utama
                return redirect('/');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    /**
     * Memproses data registrasi.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user' // PERUBAHAN: Role default diubah menjadi 'user' untuk keamanan
        ]);

        // Auth::login($user); // DIHAPUS: Login otomatis dihilangkan

        // PERUBAHAN: Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk dengan akun Anda.');
    }

    /**
     * Memproses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
