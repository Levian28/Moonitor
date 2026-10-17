@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="welcome">
    <div>
        <h2>Selamat datang, Peternak!</h2>
        <p>Berikut adalah kondisi kandang sapi Anda secara real-time.</p>
    </div>
    <div class="date-time">
        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
        <span class="clock" id="clock">{{ now()->format('H.i') }} WIB</span>
    </div>
</div>

<div class="cards">
    <div class="card">
        <small>Suhu Kandang</small>
        <div class="value">🌡️ {{ $data['suhu'] }} <span>°C</span></div>
        <em class="normal">Normal</em>
    </div>
    <div class="card">
        <small>Kelembaban</small>
        <div class="value">💧 {{ $data['kelembaban'] }} <span>%</span></div>
        <em class="normal">Normal</em>
    </div>
    <div class="card">
        <small>Amonia (NH₃)</small>
        <div class="value">☁️ {{ $data['amonia'] }} <span>ppm</span></div>
        <em class="normal">Normal</em>
    </div>
    <div class="card">
        <small>Hidrogen Sulfida (H₂S)</small>
        <div class="value">☁️ {{ $data['h2s'] }} <span>ppm</span></div>
        <em class="normal">Normal</em>
    </div>
    <div class="card">
        <small>Status Kandang</small>
        <div class="value status">✅ {{ $data['status'] }}</div>
        <p>Semua sistem normal</p>
    </div>
</div>

<div class="grid-bottom">
    <div class="card">
        <h3>Grafik Kondisi Kandang <small>(24 Jam Terakhir)</small></h3>
        <canvas id="kondisiChart"></canvas>
    </div>

    <div class="card">
        <h3>Kondisi Kandang <span class="live">LIVE</span></h3>
        <img src="{{ asset('images/kamera1.jpg') }}" class="camera" alt="Kamera 1">
        <div class="camera-nav">&lt; Kamera 1 &gt;</div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('kondisiChart'), {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [
                { label: 'Suhu (°C)',       data: @json($chart['suhu']),       borderColor: '#4caf20', tension: .3 },
                { label: 'Kelembaban (%)',  data: @json($chart['kelembaban']), borderColor: '#38bdf8', tension: .3 },
                { label: 'NH₃ (ppm)',       data: @json($chart['nh3']),        borderColor: '#facc15', tension: .3 },
                { label: 'H₂S (ppm)',       data: @json($chart['h2s']),        borderColor: '#a855f7', tension: .3 },
            ]
        },
        options: {
            scales: {
                y: { min: 0, max: 100, ticks: { color: '#aaa' }, grid: { color: '#0e1f3a' } },
                x: { ticks: { color: '#aaa' }, grid: { display: false } }
            },
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });
</script>
@endpush