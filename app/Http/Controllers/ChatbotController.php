<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate(['prompt' => 'required|string']);

        $userPrompt = $request->input('prompt');
        $apiKey = config('services.gemini.api_key');

        if (!$apiKey) {
            return response()->json(['error' => 'API Key for Gemini is not configured.'], 500);
        }

        // Ambil histori dari session, atau mulai dengan array kosong jika belum ada
        $history = $request->session()->get('chat_history', []);

        // Tambahkan pesan baru dari pengguna ke histori
        $history[] = ['role' => 'user', 'parts' => [['text' => $userPrompt]]];

        // Prompt Sistem untuk mendefinisikan peran dan batasan AI
        $systemPrompt = "Anda adalah LanguangeBot, asisten AI yang ramah dan membantu di platform LanguangeRoom. Tugas utama Anda adalah membantu pengguna belajar bahasa asing. Anda harus:
1. Menjawab pertanyaan terkait tata bahasa, kosakata, dan budaya yang berhubungan dengan bahasa.
2. Memberikan contoh kalimat dan terjemahan.
3. Mengoreksi kesalahan tata bahasa pengguna dengan sopan.
4. Menolak dengan sopan untuk menjawab pertanyaan yang tidak berhubungan dengan pembelajaran bahasa.
5. Selalu berkomunikasi dengan gaya yang positif, mendukung, dan edukatif.
Jangan pernah keluar dari peran Anda sebagai asisten belajar bahasa.";

        // Gabungkan prompt sistem dengan histori percakapan
        $contents = array_merge(
            [['role' => 'user', 'parts' => [['text' => $systemPrompt]]]],
            [['role' => 'model', 'parts' => [['text' => 'Tentu, saya siap membantu Anda belajar bahasa! Ada yang bisa saya bantu?']]]],
            $history
        );

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
            'contents' => $contents,
            // Pengaturan keamanan untuk membatasi konten yang tidak pantas
            'safetySettings' => [
                ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 1000,
            ]
        ]);

        if ($response->successful()) {
            $reply = $response->json('candidates.0.content.parts.0.text', "Maaf, saya tidak mengerti. Bisakah Anda bertanya dengan cara lain?");
            
            // Tambahkan balasan dari model ke histori
            $history[] = ['role' => 'model', 'parts' => [['text' => $reply]]];
            
            // Simpan histori yang sudah diperbarui ke session
            $request->session()->put('chat_history', $history);

            return response()->json(['reply' => $reply]);
        }

        // Penanganan error yang lebih informatif
        $errorBody = $response->json();
        $errorMsg = $errorBody['error']['message'] ?? json_encode($errorBody);
        
        // Untuk produksi, Anda mungkin ingin mencatat error ini daripada menampilkannya ke pengguna
        // \Log::error('Gemini API Error: ' . $errorMsg, ['body' => $errorBody]);

        return response()->json([
            'reply' => 'Maaf, terjadi kesalahan saat mencoba menghubungi asisten AI. Silakan coba lagi nanti.',
            'error_detail' => $errorMsg // Hanya untuk debug, bisa dihapus di produksi
        ], $response->status());
    }

    /**
     * Fungsi untuk mereset histori percakapan chatbot.
     */
    public function resetChat(Request $request)
    {
        $request->session()->forget('chat_history');
        return response()->json(['message' => 'Chat history has been reset.']);
    }

    public function listAvailableModels()
{
    $apiKey = config('services.gemini.api_key');

    if (!$apiKey) {
        return response()->json(['error' => 'API Key for Gemini is not configured.'], 500);
    }

    $response = Http::get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");

    if ($response->successful()) {
        return response()->json($response->json());
    }

    return response()->json([
        'error' => 'Failed to retrieve model list.',
        'status' => $response->status(),
        'body' => $response->json()
    ], $response->status());
}
}