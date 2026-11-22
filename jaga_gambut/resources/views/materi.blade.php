@extends('layouts.app')
@section('title', 'Materi - Jaga Gambut')

@section('content')
<section class="card-section">
  <div class="section-header">
    <h2>Materi Pembelajaran Gambut</h2>
    <p>Pelajari dasar-dasar ekosistem gambut sebelum mencoba simulator, misi, dan kuis.</p>
  </div>
  <div class="tabs-bar">
    @foreach($materi as $m)
      <button class="tab-btn {{ $loop->first ? 'active' : '' }}" onclick="switchMateri('{{ $m['key'] }}', this)">{{ $m['title'] }}</button>
    @endforeach
  </div>
  @foreach($materi as $m)
    <div class="materi-panel {{ $loop->first ? 'active' : '' }}" id="materi-{{ $m['key'] }}">
      <p class="compare-desc" style="margin-bottom:1.1rem;">{{ $m['intro'] }}</p>
      <div class="materi-grid">
        @foreach($m['points'] as $p)
          <div class="compare-box compare-healthy">
            <h3>{{ $p[0] }}</h3>
            <p class="compare-desc">{{ $p[1] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach
  <div style="margin-top:1.4rem;"><a class="btn-link" href="{{ route('home') }}#simulator">Coba Simulator &rarr;</a></div>
</section>
@endsection

@push('scripts')
<script>
  function switchMateri(key, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.materi-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('materi-' + key).classList.add('active');
  }
</script>
@endpush
