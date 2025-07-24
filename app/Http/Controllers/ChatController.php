<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post(env('OPENAI_API_BASE', 'https://api.openai.com/v1') . '/chat/completions', [
            'model' => env('OPENAI_MODEL', 'gpt-4o'),
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $message],
            ],
        ]);

        if ($response->failed()) {
            Log::error('OpenAI API failed', ['response' => $response->body()]);
            return response()->json([
                'error' => 'Gagal menghubungi OpenAI',
                'detail' => $response->body(),
            ], 500);
        }

        Log::info('OpenAI response:', $response->json());

        return response()->json($response->json());
    }

    public function speak(Request $request)
    {
        $text = $request->input('text');

        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->post('https://api.openai.com/v1/audio/speech', [
                'model' => 'tts-1',
                'input' => $text,
                'voice' => 'nova',
            ]);

        if ($response->failed()) {
            Log::error('TTS error:', ['response' => $response->body()]);
            return response()->json(['error' => 'TTS gagal'], 500);
        }

        return response($response->body(), 200)
            ->header('Content-Type', 'audio/mpeg');
    }

public function chatWithImage(Request $request)
{
    Log::info("Masuk chatWithImage()");

    // Validasi input
    $request->validate([
        'image' => 'required|image|max:5120', // max 5MB
    ]);

    // Konversi gambar ke base64
    $image = $request->file('image');
    $imageData = base64_encode(file_get_contents($image->getRealPath()));
    $base64Image = 'data:' . $image->getMimeType() . ';base64,' . $imageData;
    Log::info("Gambar dikonversi ke base64");

    // Kirim ke OpenAI (multimodal content)
    $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-4o',
        'messages' => [
            [
                'role' => 'user',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Tolong analisis isi gambar ini, apa yang kamu lihat? Jelaskan.'
                    ],
                    [
                        'type' => 'image_url',
                        'image_url' => [
                            'url' => $base64Image
                        ]
                    ]
                ]
            ]
        ],
        'max_tokens' => 800,
    ]);

    if ($response->successful()) {
        $result = $response->json();
        Log::info('OpenAI response: ' . json_encode($result));

        return response()->json([
            'message' => $result['choices'][0]['message']['content'] ?? 'Tidak ada respon.',
        ]);
    } else {
        Log::error('OpenAI Error: ' . $response->body());
        return response()->json(['error' => 'Gagal mendapatkan respon dari OpenAI.'], 500);
    }
}


}
