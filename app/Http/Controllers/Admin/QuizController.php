<?php

// app/Http/Controllers/Admin/QuizController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::latest()->get();
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quiz.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'quiz_link' => 'required|url',
            'jenjang' => 'required|in:sd,smp,sma',
        ]);

        Quiz::create($request->all());

        return redirect()->route('quiz.index')->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz)
    {
        return view('admin.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'quiz_link' => 'required|url',
            'jenjang' => 'required|in:sd,smp,sma',
        ]);

        $quiz->update($request->all());

        return redirect()->route('admin.quiz.index')->with('success', 'Kuis berhasil diperbarui.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quiz.index')->with('success', 'Kuis berhasil dihapus.');
    }
}