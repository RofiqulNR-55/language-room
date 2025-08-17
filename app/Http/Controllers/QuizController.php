<?php

    namespace App\Http\Controllers;

    use App\Models\Quiz;
    use Illuminate\Http\Request;

    class QuizController extends Controller
    {
        /**
         * Menampilkan daftar kuis berdasarkan jenjang (paket) yang diakses.
         */
        public function index($paket)
        {
            // Ambil semua kuis yang sesuai dengan jenjang/paket
            $quizzes = Quiz::where('jenjang', $paket)->latest()->get();

            // Kirim data ke view
            return view('quiz.index', [
                'quizzes' => $quizzes,
                'paket' => $paket
            ]);
        }
    }
    
