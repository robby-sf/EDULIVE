{{-- Menggunakan layout utama dari aplikasi Anda --}}
@extends('layouts.app')

{{-- Judul Halaman --}}
@section('title', 'Learning Statistics - EDULIVE')

{{-- Konten Utama --}}
@section('content')
<div class="bg-slate-50 text-gray-800">
    <div class="container mx-auto p-4 md:p-8">
        <main>
            <div class="text-center mb-8">
                <h2 class="text-4xl font-bold mb-3 text-gray-800">Learning Statistics</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-md flex flex-col gap-4">
                    <div class="flex justify-between items-start">
                        <span class="text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($effectiveFocusMinutes, 1, ',', '.') }} minute</p>
                        <p class="text-sm text-gray-500">Effective Focus Duration</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md flex flex-col gap-4">
                    <div class="flex justify-between items-start">
                        <span class="text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-1.414 1.414M5.636 18.364l-1.414 1.414M12 18.364V21m0-18.364V3m5.636 0l1.414 1.414M5.636 5.636L4.222 4.222m15.556 10.142h-2.72m-12.858 0H3" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($totalDisruptionMinutes, 1, ',', '.') }} minute</p>
                        <p class="text-sm text-gray-500">Total Minute of disruptions</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md flex flex-col gap-4">
                    <div class="flex justify-between items-start">
                        <span class="text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">{{ $overallFocusScore }}/100</p>
                        <p class="text-sm text-gray-500">Overall Focus Score</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md flex flex-col gap-4">
                    <div class="flex justify-between items-start">
                        <span class="text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
                            </svg>
                        </span>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">{{ $averageFocusPerSession }}%</p>
                        <p class="text-sm text-gray-500">Average Focus per Session</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">
                <div class="lg:col-span-3 bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Learning Time Trends</h3>
                    <canvas id="learningTimeChart"></canvas>
                </div>
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Duration of some disturbances</h3>
                    <canvas id="disruptionChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Learning Session History</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">Tanggal</th>
                                <th scope="col" class="py-3 px-6">Durasi Belajar</th>
                                <th scope="col" class="py-3 px-6">Durasi Fokus</th>
                                <th scope="col" class="py-3 px-6">Durasi Gangguan</th>
                                <th scope="col" class="py-3 px-6">Skor Fokus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sessions as $session)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="py-4 px-6 font-medium">
                                    {{ \Carbon\Carbon::parse($session->start_time)->format('d M Y, H:i') }}
                                </td>

                                <td class="py-4 px-6">
                                    @php
                                    $totalBelajarMinutes = $session->total_focus_minutes + $session->total_distraction_minutes;
                                    $menitBelajar = floor($totalBelajarMinutes);
                                    $detikBelajar = round(($totalBelajarMinutes - $menitBelajar) * 60);
                                    @endphp
                                    {{ $menitBelajar }} menit
                                    @if($detikBelajar > 0)
                                    {{ $detikBelajar }} detik
                                    @endif
                                </td>

                                <td class="py-4 px-6">
                                    @php
                                    $totalFokusMinutes = $session->total_focus_minutes;
                                    $menitFokus = floor($totalFokusMinutes);
                                    $detikFokus = round(($totalFokusMinutes - $menitFokus) * 60);
                                    @endphp
                                    {{ $menitFokus }} menit
                                    @if($detikFokus > 0)
                                    {{ $detikFokus }} detik
                                    @endif
                                </td>

                                <td class="py-4 px-6">
                                    @php
                                    $totalGangguanMinutes = $session->total_distraction_minutes;
                                    $menitGangguan = floor($totalGangguanMinutes);
                                    $detikGangguan = round(($totalGangguanMinutes - $menitGangguan) * 60);
                                    @endphp
                                    {{ $menitGangguan }} menit
                                    @if($detikGangguan > 0)
                                    {{ $detikGangguan }} detik
                                    @endif
                                </td>

                                <td class="py-4 px-6">
                                    @php
                                    $totalDuration = $session->total_focus_minutes + $session->total_distraction_minutes;
                                    $focusScore = $totalDuration > 0 ? round(($session->total_focus_minutes / $totalDuration) * 100) : 0;
                                    @endphp
                                    <div class="flex items-center gap-2">
                                        <span class="h-2.5 w-2.5 {{ $focusScore >= 75 ? 'bg-green-500' : ($focusScore >= 50 ? 'bg-yellow-500' : 'bg-red-500') }} rounded-full"></span>
                                        {{ $focusScore }}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white border-b">
                                <td colspan="5" class="py-4 px-6 text-center text-gray-500">
                                    Belum ada riwayat sesi belajar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data Dummy untuk Grafik
        const learningTimeData = {
            labels: @json($learningTimeChartData['labels']),
            datasets: [{
                label: 'Waktu Belajar (menit)',
                data: @json($learningTimeChartData['data']),
                borderColor: '#8b5cf6',
                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                tension: 0.4,
                fill: true,
            }]
        };
        const disruptionData = {
            labels: @json($disruptionChartData['labels']),
            datasets: [{
                label: 'Jumlah Gangguan',
                data: @json($disruptionChartData['data']),
                backgroundColor: [
                    'rgba(99, 102, 241, 0.7)',
                    'rgba(139, 92, 246, 0.7)',
                    'rgba(167, 139, 250, 0.7)',
                    'rgba(239, 68, 68, 0.7)'
                ],
                borderColor: [
                    '#6366f1',
                    '#8b5cf6',
                    '#a78bfa',
                ],
                borderWidth: 1
            }]
        };

        // Inisialisasi Chart
        new Chart(document.getElementById('learningTimeChart'), {
            type: 'line',
            data: learningTimeData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        new Chart(document.getElementById('disruptionChart'), {
            type: 'bar',
            data: disruptionData,
            options: {
                responsive: true,
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
