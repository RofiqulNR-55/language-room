<?php

    namespace App\Http\Controllers;

    use App\Models\Quiz;
    use Illuminate\Http\Request;

    class QuizController extends Controller
    {
        /**
         * Menampilkan daftar kuis berdasarkan jenjang (paket) yang diakses.
         */
        public function index($paket, Request $request)
        {
            // Ambil semua folder unik dari quiz jenjang tersebut
            $folders = Quiz::where('jenjang', $paket)
                ->whereNotNull('folder')
                ->pluck('folder')
                ->unique();

            // Jika ada folder dipilih, tampilkan quiz di folder itu
            $selectedFolder = $request->query('folder');
            $quizzes = collect();
            if ($selectedFolder) {
                $quizzes = Quiz::where('jenjang', $paket)
                    ->where('folder', $selectedFolder)
                    ->get();
            }

            return view('quiz.index', [
                'quizzes' => $quizzes,
                'paket' => $paket,
                'folders' => $folders,
                'selectedFolder' => $selectedFolder,
            ]);
        }
    }

