<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudySession;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function statistic()
    {
        $sessions = StudySession::where('user_id', Auth::id())->latest()->get();

        // Ambil total menit FOKUS langsung dari DB (ini sudah benar)
        $totalFocusMinutes = $sessions->sum('total_focus_minutes');

        // Inisialisasi penghitung durasi gangguan dalam detik
        $disruptionDurationCounts = [
            'tiduran' => 0,
            'menunduk' => 0,
            'keluar frame' => 0,
            'cell phone' => 0,
        ];

        foreach ($sessions as $session) {

            $log = json_decode($session->distraction_log, true);

            if (is_array($log)) {
                foreach ($log as $distractionType => $durationInSeconds) {
                    $key = strtolower(trim($distractionType));
                    if (array_key_exists($key, $disruptionDurationCounts)) {
                        $disruptionDurationCounts[$key] += $durationInSeconds;
                    }
                }
            }
        }

        $totalDisruptionSeconds = array_sum($disruptionDurationCounts);
        $totalDisruptionMinutes = $totalDisruptionSeconds / 60;

        $grandTotalDuration = $totalFocusMinutes + $totalDisruptionMinutes;
        $overallFocusScore = ($grandTotalDuration > 0) ? round(($totalFocusMinutes / $grandTotalDuration) * 100) : 0;

        $totalSessions = $sessions->count();
        $averageFocusPerSession = 0;
        if ($totalSessions > 0) {
            $sumOfSessionScores = $sessions->map(function ($session) {
                $sessionDuration = $session->total_focus_minutes + $session->total_distraction_minutes;
                return ($sessionDuration > 0) ? round(($session->total_focus_minutes / $sessionDuration) * 100) : 0;
            })->sum();
            $averageFocusPerSession = round($sumOfSessionScores / $totalSessions);
        }

        $disruptionChartData = [
            'labels' => array_keys($disruptionDurationCounts),
            'data' => array_map(fn($secs) => $secs / 60, array_values($disruptionDurationCounts)),
        ];

        $learningTimeChartData = [
            'labels' => $sessions->pluck('start_time')->map(fn($date) => Carbon::parse($date)->format('d M'))->reverse()->values()->toArray(),
            'data' => $sessions->pluck('total_focus_minutes')->reverse()->values()->toArray(),
        ];

        return view('statistic', [
            'effectiveFocusMinutes' => $totalFocusMinutes,
            'totalDisruptionMinutes' => $totalDisruptionMinutes,
            'overallFocusScore' => $overallFocusScore,
            'averageFocusPerSession' => $averageFocusPerSession,
            'learningTimeChartData' => $learningTimeChartData,
            'disruptionChartData' => $disruptionChartData,
            'sessions' => $sessions,
        ]);
    }
}
