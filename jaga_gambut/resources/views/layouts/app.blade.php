<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title', 'Jaga Gambut: Mengapa Lahan Basah Bisa Terbakar?')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/extra.css') }}" />
</head>
<body>

  <nav>
    <div class="nav-inner">
      <a class="brand" href="{{ route('home') }}" style="text-decoration:none;">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#5eead4" stroke-width="2.2">
          <path d="M12 2C7 8 5 11.5 5 15a7 7 0 0 0 14 0c0-3.5-2-7-7-13z"/>
          <path d="M12 10v8M9 14l3-2 3 2"/>
        </svg>
        <span>Jaga Gambut</span>
      </a>
      <div class="nav-links">
        <a href="{{ route('home') }}#simulator">Simulator</a>
        <a href="{{ route('home') }}#dragdrop">Misi Drag &amp; Drop</a>
        <a href="{{ route('home') }}#perbandingan">Dampak Ekosistem</a>
        <a href="{{ route('home') }}#kuis">Kuis Aksi 3R</a>
        <a href="{{ route('materi') }}">Materi</a>
        <a href="{{ route('leaderboard') }}">Leaderboard</a>
        @auth
          <a href="{{ route('dashboard') }}">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Keluar ({{ \Illuminate\Support\Str::limit(auth()->user()->name, 12) }})</button></form>
        @else
          <a href="{{ route('login') }}">Masuk</a>
          <a href="{{ route('register') }}">Daftar</a>
        @endauth
      </div>
    </div>
  </nav>

  <main class="container">
    @yield('content')
  </main>

  <footer>
    Media Edukasi Interaktif Ekosistem Lahan Basah &bull; Pencegahan Kebakaran Hutan &amp; Lahan Gambut
  </footer>

  <script>
    window.APP = {
      auth: @json(auth()->check()),
      scoreUrl: @json(route('score.store')),
      loginUrl: @json(route('login')),
      csrf: document.querySelector('meta[name="csrf-token"]').content
    };
  </script>
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
