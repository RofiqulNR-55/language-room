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
    public function index(string $jenjang, Request $request): View
    {
        // Validasi untuk memastikan jenjang yang dimasukkan adalah salah satu dari sd, smp, atau sma.
        if (!in_array($jenjang, ['sd', 'smp', 'sma'])) {
            abort(404); // Tampilkan halaman not found jika jenjang tidak valid
        }

        // Ambil semua folder unik dari modul jenjang tersebut
        $folders = Modul::where('jenjang', $jenjang)
            ->whereNotNull('folder')
            ->pluck('folder')
            ->unique();

        // Jika ada folder dipilih, tampilkan file di folder itu
        $selectedFolder = $request->query('folder');
        $moduls = collect();
        if ($selectedFolder) {
            $moduls = Modul::where('jenjang', $jenjang)
                ->where('folder', $selectedFolder)
                ->get();
        }

        // Kirim data 'moduls', 'jenjang', 'folders', dan 'selectedFolder' ke view 'modul.index'.
        return view('modul.index', compact('moduls', 'jenjang', 'folders', 'selectedFolder'));
    }
}