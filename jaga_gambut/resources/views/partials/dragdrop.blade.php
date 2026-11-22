@php $cards = config('gambut.cards'); $total = count($cards); $danger = collect($cards)->where('target','zona-larangan')->count(); @endphp
<section id="dragdrop" class="card-section">
      <div class="section-header">
        <h2>4. Misi Penyelamatan Lahan Gambut (Drag &amp; Drop)</h2>
        <p>Seret (<em>drag &amp; drop</em>) setiap kartu tindakan ke zona lapangan yang tepat—atau <strong>ketuk kartu lalu ketuk zona tujuan</strong> jika memakai layar sentuh.</p>
      </div>

      <div class="game-topbar">
        <div class="score-pills">
          <div class="pill">Skor: <span id="gameScore" style="color:var(--teal-light);">0</span></div>
          <div class="pill">Terselesaikan: <span id="gameProgressText" style="color:#6ee7b7;">0 / {{ $total }}</span></div>
          <div class="progress-wrap">
            <div class="progress-fill" id="gameProgressBar"></div>
          </div>
        </div>
        <button class="btn-reset" onclick="resetGame()">Reset Misi</button>
      </div>

      <div id="gameFeedback" class="game-feedback">
        Petunjuk: Tempatkan {{ $total - $danger }} aksi restorasi ke zona lahan yang sesuai, dan blokir {{ $danger }} tindakan berbahaya ke Zona Larangan!
      </div>

      <!-- Kartu Tindakan -->
      <div class="cards-deck" id="cardsDeck">
        @foreach($cards as $c)
        <div class="action-card" draggable="true" data-id="{{ $c['id'] }}" data-target="{{ $c['target'] }}" data-exp="{{ $c['exp'] }}" onclick="selectCard(this)">
          <div class="card-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="{{ $c['color'] }}" stroke-width="2.2">{!! $c['icon'] !!}</svg></div>
          <h4>{{ $c['title'] }}</h4>
          <p>{{ $c['desc'] }}</p>
        </div>
        @endforeach
      </div>

      <div class="zones-grid">
        <div class="drop-zone" id="zona-kanal" data-zone="zona-kanal" onclick="tapZone(this)">
          <div>
            <div class="zone-header">
              <span class="zone-title">Kanal Drainase Kering</span>
              <span class="zone-tag">Rewetting</span>
            </div>
            <p class="zone-desc">Air gambut terus mengalir keluar sehingga TMA turun di bawah -40 cm. Butuh penghambat aliran air.</p>
          </div>
          <div class="zone-dropped-list" id="list-zona-kanal"></div>
        </div>

        <div class="drop-zone" id="zona-rawan" data-zone="zona-rawan" onclick="tapZone(this)">
          <div>
            <div class="zone-header">
              <span class="zone-title">Lahan Gambut Rawan Api</span>
              <span class="zone-tag">Pencegahan</span>
            </div>
            <p class="zone-desc">Warga ingin menyiapkan lahan pertanian secara aman tanpa menyulut api di lapisan organik.</p>
          </div>
          <div class="zone-dropped-list" id="list-zona-rawan"></div>
        </div>

        <div class="drop-zone" id="zona-bekas" data-zone="zona-bekas" onclick="tapZone(this)">
          <div>
            <div class="zone-header">
              <span class="zone-title">Lahan Bekas Terbakar</span>
              <span class="zone-tag">Revegetation</span>
            </div>
            <p class="zone-desc">Tutupan vegetasi hilang pascakarhutla dan perlu dipulihkan dengan tanaman endemik rawa gambut.</p>
          </div>
          <div class="zone-dropped-list" id="list-zona-bekas"></div>
        </div>

        <div class="drop-zone zone-danger" id="zona-larangan" data-zone="zona-larangan" onclick="tapZone(this)">
          <div>
            <div class="zone-header">
              <span class="zone-title">Zona Larangan (Blokir Aksi)</span>
              <span class="zone-tag">{{ $danger }} Pemicu Karhutla</span>
            </div>
            <p class="zone-desc">Seret semua aktivitas manusia yang memicu kekeringan ekstrem dan kebakaran bawah tanah ke sini.</p>
          </div>
          <div class="zone-dropped-list" id="list-zona-larangan"></div>
        </div>
      </div>

      <div class="victory-banner" id="victoryBanner">
        Misi Tuntas! Kamu berhasil memulihkan hidrologi gambut, melindungi tutupan lahan, dan memblokir seluruh pemicu karhutla. <span id="victoryNote"></span>
      </div>
    </section>
