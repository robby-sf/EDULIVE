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
            'startTime' => 'required|date',
            'endTime' => 'required|date',
            'focusDuration' => 'required|numeric',
            'distractionDuration' => 'required|numeric',
            'distractionLog' => 'required|array',
        ]);

        $session = StudySession::create([
            'user_id' => Auth::id(), 
            'start_time' => $data['startTime'],
            'end_time' => $data['endTime'],
            'total_focus_minutes' => $data['focusDuration'],
            'total_distraction_minutes' => $data['distractionDuration'],
            'distraction_log' => $data['distractionLog'], 
        ]);

        return response()->json([
            'success' => true,
            'data' => $session
        ]);
    }
}

