<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudySession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\log;


class StudyController extends Controller
{
    public function store(Request $request)
    {
        Log::info('📥 StudySession POST diterima!');
        Log::info('User ID: ' . Auth::id());
        Log::info($request->all());
        
        $data = $request->validate([
            'started_at' => 'required|date',
            'ended_at' => 'required|date',
            'focus_duration' => 'required|numeric',
            'distraction_duration' => 'required|numeric',
            'distraction_log' => 'required|array',
        ]);

        $session = StudySession::create([
            'user_id' => Auth::id(),
            'start_time' => $data['started_at'],
            'end_time' => $data['ended_at'],
            'total_focus_minutes' => $data['focus_duration'],
            'total_distraction_minutes' => $data['distraction_duration'],
            'distraction_log' => $data['distraction_log']
        ]);

        return response()->json([
            'success' => true,
            'data' => $session
        ]);
    }
}

