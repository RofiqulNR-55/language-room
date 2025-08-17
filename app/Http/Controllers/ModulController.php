<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModulController extends Controller
{
    /**
     * Menampilkan daftar modul berdasarkan jenjang untuk pengguna.
     *
     * @param string $jenjang
     * @return View
     */
    public function index(string $jenjang): View
    {
        // Validasi untuk memastikan jenjang yang dimasukkan adalah salah satu dari sd, smp, atau sma.
        if (!in_array($jenjang, ['sd', 'smp', 'sma'])) {
            abort(404); // Tampilkan halaman not found jika jenjang tidak valid
        }

        // Ambil semua data modul dari database yang sesuai dengan jenjang.
        $moduls = Modul::where('jenjang', $jenjang)->get();

        // Kirim data 'moduls' dan 'jenjang' ke view 'modul.index'.
        return view('modul.index', compact('moduls', 'jenjang'));
    }
}