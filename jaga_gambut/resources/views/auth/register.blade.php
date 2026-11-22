@extends('layouts.app')
@section('title', 'Daftar - Jaga Gambut')

@section('content')
<section class="card-section auth-box">
  <div class="section-header"><h2>Daftar</h2><p>Buat akun gratis untuk mencatat skor dan masuk leaderboard.</p></div>
  @if ($errors->any())
    <div class="game-feedback error">{{ $errors->first() }}</div>
  @endif
  <form method="POST" action="{{ route('register') }}" class="auth-form">
    @csrf
      <label>Nama<input type="text" name="name" value="{{ old('name') }}" required autofocus></label>
      <label>Email<input type="email" name="email" value="{{ old('email') }}" required></label>
      <label>Kata Sandi (min. 6 karakter)<input type="password" name="password" required></label>
      <label>Ulangi Kata Sandi<input type="password" name="password_confirmation" required></label>
    <button type="submit" class="btn-spark">Buat Akun</button>
  </form>
  <p class="compare-desc" style="margin-top:1rem;">Sudah punya akun? <a class="btn-link" href="{{ route('login') }}">Masuk</a></p>
</section>
@endsection
