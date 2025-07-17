<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\log;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');

        $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ])->post(env('OPENAI_API_BASE', 'https://api.openai.com/v1') . '/chat/completions', [
                'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),
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
}
