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

        $fullPrompt = "Anda adalah LanguangeBot... (prompt lengkap Anda di sini)... Pesan dari pengguna: \"{$userPrompt}\"";

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $fullPrompt]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            $reply = $response->json('candidates.0.content.parts.0.text', "Maaf, saya tidak mengerti.");
            return response()->json(['reply' => $reply]);
        }

        return response()->json(['error' => 'Failed to get response from AI.'], $response->status());
    }
}