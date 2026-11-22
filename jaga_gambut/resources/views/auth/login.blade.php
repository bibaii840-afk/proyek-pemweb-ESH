@extends('layouts.app')
@section('title', 'Masuk - Jaga Gambut')

@section('content')
<section class="card-section auth-box">
  <div class="section-header"><h2>Masuk</h2><p>Masuk untuk menyimpan skor ke leaderboard.</p></div>
  @if ($errors->any())
    <div class="game-feedback error">{{ $errors->first() }}</div>
  @endif
  <form method="POST" action="{{ route('login') }}" class="auth-form">
    @csrf
      <label>Email<input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
      <label>Kata Sandi<input type="password" name="password" required></label>
      <label class="check"><input type="checkbox" name="remember"> Ingat saya</label>
    <button type="submit" class="btn-spark">Masuk</button>
  </form>
  <p class="compare-desc" style="margin-top:1rem;">Belum punya akun? <a class="btn-link" href="{{ route('register') }}">Daftar</a></p>
</section>
@endsection
