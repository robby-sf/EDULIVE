<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudySession;
use Illuminate\Support\Facades\Auth;

class StudyController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'started_at' => 'required|date',
            'ended_at' => 'required|date',
            'focus_duration' => 'required|numeric',
            'distraction_duration' => 'required|numeric',
            'distractions' => 'required|array',
        ]);

        $session = StudySession::create([
            'user_id' => Auth::id(),
            'start_time' => $data['started_at'],
            'end_time' => $data['ended_at'],
            'total_focus_minutes' => $data['focus_duration'],
            'total_distraction_minutes' => $data['distraction_duration'],
            'distraction_log' => $data['distractions']
        ]);

        return response()->json([
            'success' => true,
            'data' => $session
        ]);
    }
}

