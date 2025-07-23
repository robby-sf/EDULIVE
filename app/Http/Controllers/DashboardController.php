<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudySession; // <-- Import model StudySession
use Illuminate\Support\Facades\Auth; // <-- Import fasad Auth
use Illuminate\Support\Carbon; // <-- Import Carbon untuk manipulasi tanggal

class DashboardController extends Controller
{
    public function statistic()
    {
        // 1. Ambil semua sesi belajar milik user yang sedang login
        $sessions = StudySession::where('user_id', Auth::id())
            ->orderBy('start_time', 'desc') // Urutkan dari yang terbaru
            ->get();

        // 2. Hitung statistik ringkasan
        $totalFocusMinutes = $sessions->sum('total_focus_minutes');
        $totalDistractionMinutes = $sessions->sum('total_distraction_minutes');
        $totalSessions = $sessions->count();
        $totalDisruptions = $sessions->sum(function ($session) {
            return count($session->distraction_log ?? []);
        });

        // Format durasi fokus agar lebih mudah dibaca (contoh: 1 jam 45 menit)
        $formattedFocusTime = floor($totalFocusMinutes / 60) . ' jam ' . ($totalFocusMinutes % 60) . ' menit';

        // Hitung skor fokus (contoh sederhana)
        $totalDuration = $totalFocusMinutes + $totalDistractionMinutes;
        $overallFocusScore = ($totalDuration > 0) ? round(($totalFocusMinutes / $totalDuration) * 100) : 0;

        // 3. Siapkan data untuk grafik (contoh tren 7 hari terakhir)
        $learningTimeLabels = [];
        $learningTimeData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $learningTimeLabels[] = $date->format('D'); // Format hari (Sun, Mon, Tue)

            $minutesOnDay = $sessions->where('start_time', '>=', $date->startOfDay())
                ->where('start_time', '<=', $date->endOfDay())
                ->sum('total_focus_minutes');
            $learningTimeData[] = $minutesOnDay;
        }

        // 4. Kirim semua data yang sudah diolah ke view
        return view('statistic', [
            'sessions' => $sessions,
            'formattedFocusTime' => $formattedFocusTime,
            'totalDisruptions' => $totalDisruptions,
            'overallFocusScore' => $overallFocusScore,
            'averageFocusScore' => $totalSessions > 0 ? round($sessions->avg('total_focus_minutes') / ($sessions->avg('total_focus_minutes') + $sessions->avg('total_distraction_minutes')) * 100) : 0,
            'learningTimeLabels' => $learningTimeLabels,
            'learningTimeData' => $learningTimeData,
            // Anda bisa menambahkan data untuk grafik gangguan di sini
        ]);
    }
}
