@extends('layouts.app')
@section('title', 'Dashboard - Jaga Gambut')

@section('content')
<section class="card-section">
  <div class="section-header">
    <h2>Dashboard {{ auth()->user()->name }}</h2>
    <p>Ringkasan progres belajarmu di Jaga Gambut.</p>
  </div>
  <div class="facts-grid">
    <div class="fact-card"><div class="fact-num teal">{{ $dragdrop }} / {{ $maxDrag }}</div><h3>Skor Terbaik Drag &amp; Drop</h3><p>Selesaikan semua kartu tanpa salah zona untuk skor penuh.</p></div>
    <div class="fact-card"><div class="fact-num amber">{{ $quiz }} / {{ $maxQuiz }}</div><h3>Skor Terbaik Kuis 3R</h3><p>Setiap jawaban benar bernilai 100 poin.</p></div>
    <div class="fact-card"><div class="fact-num orange">{{ $rank ? '#'.$rank : '-' }}</div><h3>Peringkat</h3><p>{{ $rank ? "Dari {$players} pemain di leaderboard." : 'Mainkan misi atau kuis untuk masuk peringkat.' }}</p></div>
    <div class="fact-card"><div class="fact-num teal">{{ $plays }}</div><h3>Total Percobaan</h3><p>Jumlah misi dan kuis yang sudah kamu selesaikan.</p></div>
  </div>
</section>

<section class="card-section">
  <div class="section-header"><h2>Riwayat Terakhir</h2><p>10 percobaan terbaru.</p></div>
  <div class="table-wrap">
    <table class="data-table">
      <thead><tr><th>Waktu</th><th>Aktivitas</th><th>Skor</th></tr></thead>
      <tbody>
        @forelse($history as $h)
          <tr><td>{{ $h->created_at->format('d M Y H:i') }}</td><td>{{ $h->type === 'quiz' ? 'Kuis 3R' : 'Misi Drag & Drop' }}</td><td>{{ $h->points }} / {{ $h->max_points }}</td></tr>
        @empty
          <tr><td colspan="3" style="text-align:center;color:var(--text-soft);">Belum ada riwayat.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div style="margin-top:1.2rem;display:flex;gap:.8rem;flex-wrap:wrap;">
    <a class="btn-link" href="{{ route('materi') }}">Buka Materi</a>
    <a class="btn-link" href="{{ route('home') }}#dragdrop">Main Misi</a>
    <a class="btn-link" href="{{ route('home') }}#kuis">Kerjakan Kuis</a>
  </div>
</section>
@endsection
