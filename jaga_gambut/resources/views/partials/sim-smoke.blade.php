<section id="simulator-asap" class="card-section">
  <div class="section-header">
    <h2>2. Simulator Sebaran Asap &amp; Kualitas Udara (ISPU)</h2>
    <p>Atur luas lahan gambut yang terbakar dan arah angin untuk melihat bagaimana kabut asap memengaruhi <strong>Indeks Standar Pencemar Udara (ISPU)</strong> di permukiman.</p>
  </div>
  <div class="sim-grid">
    <div class="svg-stage">
      <svg id="smokeSvg" viewBox="0 0 640 370" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <linearGradient id="smkSky" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#0f2e2b"/><stop offset="100%" stop-color="#1e4e48"/>
          </linearGradient>
        </defs>
        <rect x="0" y="0" width="640" height="370" fill="url(#smkSky)"/>
        <circle id="smkSun" cx="560" cy="70" r="30" fill="#fde68a"/>
        <rect x="0" y="270" width="640" height="100" fill="#261c1a"/>
        <rect x="0" y="270" width="230" height="100" fill="#3e2723"/>
        <ellipse id="smkFire" class="ember-glow" cx="115" cy="272" rx="40" ry="12" fill="#ea580c"/>
        <text x="16" y="330" fill="#a8a29e" font-size="12" font-weight="bold">Lahan Gambut Terbakar</text>
        <g id="smkHouses">
          <rect x="360" y="230" width="60" height="40" fill="#78716c"/><polygon points="354,230 390,205 426,230" fill="#9a3412"/>
          <rect x="450" y="238" width="50" height="32" fill="#a8a29e"/><polygon points="445,238 475,216 505,238" fill="#b45309"/>
          <rect x="530" y="228" width="64" height="42" fill="#78716c"/><polygon points="524,228 562,202 600,228" fill="#9a3412"/>
        </g>
        <text x="360" y="300" fill="#e7e5e4" font-size="12" font-weight="bold">Permukiman Warga</text>
        <g id="smkPuffs"></g>
        <rect id="smkHaze" x="0" y="0" width="640" height="370" fill="#78716c" opacity="0"/>
      </svg>
      <div id="smkBanner" class="status-banner status-safe">
        <span id="smkStatus">ISPU 0: BAIK</span>
        <span id="smkRisk">Risiko ISPA: RENDAH</span>
      </div>
    </div>

    <div class="sim-controls">
      <div>
        <div class="control-label">Arah &amp; Kecepatan Angin:</div>
        <div class="stage-buttons">
          <button class="btn-stage active" id="smkWindCalm" onclick="smkSetWind(false)">Angin Tenang</button>
          <button class="btn-stage" id="smkWindStrong" onclick="smkSetWind(true)">Angin Kencang</button>
        </div>
      </div>
      <div class="slider-box">
        <div class="slider-header">
          <span>Luas Gambut Terbakar:</span>
          <span id="smkHaText" style="color:var(--teal-light);">60 ha</span>
        </div>
        <input type="range" id="smkSlider" min="0" max="500" step="10" value="60" oninput="smkChange(this.value)" />
        <div class="slider-ticks"><span>0 ha</span><span style="color:#fbbf24;">250 ha</span><span style="color:#f87171;">500 ha</span></div>
      </div>
      <div class="action-row">
        <button class="btn-spark" onclick="smkAdd(100)">Tambah Titik Api (+100 ha)</button>
        <button class="btn-dam" onclick="smkAdd(-100)">Water Bombing (-100 ha)</button>
      </div>
      <div class="sim-narration" id="smkNarration"></div>
    </div>
  </div>
</section>
