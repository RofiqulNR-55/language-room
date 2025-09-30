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
    public function index($paket, Request $request)
    {
        // Ambil semua folder unik dari video jenjang tersebut
        $folders = Video::where('jenjang', $paket)
            ->whereNotNull('folder')
            ->pluck('folder')
            ->unique();

        // Jika ada folder dipilih, tampilkan video di folder itu
        $selectedFolder = $request->query('folder');
        $videos = collect();
        if ($selectedFolder) {
            $videos = Video::where('jenjang', $paket)
                ->where('folder', $selectedFolder)
                ->get();
        } else {
            // Ambil semua data video yang jenjangnya sesuai dengan paket yang diakses
            $videos = Video::where('jenjang', $paket)->latest()->get();
        }

        return view('video.index', [
            'videos' => $videos,
            'jenjang' => $paket,
            'folders' => $folders,
            'selectedFolder' => $selectedFolder,
        ]);
    }
}
