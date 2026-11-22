@extends('layouts.app')
@section('title', 'Leaderboard - Jaga Gambut')

@section('content')
<section class="card-section">
  <div class="section-header">
    <h2>Leaderboard</h2>
    <p>Peringkat berdasarkan skor terbaik Misi Drag &amp; Drop ditambah skor terbaik Kuis 3R.</p>
  </div>
  <div class="table-wrap">
    <table class="data-table">
      <thead><tr><th>#</th><th>Nama</th><th>Drag &amp; Drop</th><th>Kuis</th><th>Total</th></tr></thead>
      <tbody>
        @forelse($rows as $r)
          <tr class="{{ auth()->id() == $r['user_id'] ? 'lb-me' : '' }}">
            <td>{{ $loop->iteration }}</td><td>{{ $r['name'] }}</td><td>{{ $r['dragdrop'] }}</td><td>{{ $r['quiz'] }}</td><td><strong>{{ $r['total'] }}</strong></td>
          </tr>
        @empty
          <tr><td colspan="5" style="text-align:center;color:var(--text-soft);">Belum ada skor. Jadilah yang pertama!</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @guest
    <p class="compare-desc" style="margin-top:1rem;"><a class="btn-link" href="{{ route('login') }}">Masuk</a> atau <a class="btn-link" href="{{ route('register') }}">daftar</a> agar skormu tercatat.</p>
  @endguest
</section>
@endsection
