<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Menampilkan daftar video pembelajaran berdasarkan jenjang (paket).
     *
     * @param  string  $paket
     * @return \Illuminate\View\View
     */
    public function index($paket)
    {
        // Ambil semua data video yang jenjangnya sesuai dengan paket yang diakses
        $videos = Video::where('jenjang', $paket)->latest()->get();

        // Kirim data ke view 'video.index'.
        // Variabel $paket dari URL dikirim ke view dengan nama 'jenjang'
        // agar sesuai dengan yang diharapkan oleh file view.
        return view('video.index', [
            'videos' => $videos,
            'jenjang' => $paket // <-- INI BAGIAN YANG DIPERBAIKI
        ]);
    }
}
