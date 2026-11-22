<section id="simulator" class="card-section">
      <div class="section-header">
        <h2>1. Simulator Penampang Lahan Gambut (Cross-Section)</h2>
        <p>Pilih tahapan kronologi atau geser Tinggi Muka Air (TMA) secara manual, lalu uji coba <strong>Sulut Percikan Api</strong> untuk melihat reaksi tanah gambut.</p>
      </div>

      <div class="sim-grid">
        <div class="svg-stage">
          <svg id="peatSvg" viewBox="0 0 640 370" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="skyGrad" x1="0" y1="0" x2="0" y2="1">
                <stop id="skyTop" offset="0%" stop-color="#0f2e2b"/>
                <stop id="skyBot" offset="100%" stop-color="#1e4e48"/>
              </linearGradient>
              <linearGradient id="waterGrad" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.72"/>
                <stop offset="100%" stop-color="#0284c7" stop-opacity="0.88"/>
              </linearGradient>
            </defs>

            <rect x="0" y="0" width="640" height="145" fill="url(#skyGrad)"/>

            <g id="smokeGroup" style="display:none;">
              <circle class="smoke-puff" cx="150" cy="115" r="24" fill="#94a3b8"/>
              <circle class="smoke-puff" cx="255" cy="105" r="30" fill="#cbd5e1"/>
              <circle class="smoke-puff" cx="355" cy="118" r="26" fill="#94a3b8"/>
            </g>

            <g id="treesGroup">
              <rect x="92" y="88" width="10" height="57" fill="#5c4033"/>
              <circle id="canopy1" cx="97" cy="76" r="28" fill="#10b981"/>
              <rect x="215" y="78" width="12" height="67" fill="#5c4033"/>
              <circle id="canopy2" cx="221" cy="64" r="34" fill="#059669"/>
              <path id="grass1" d="M310 145 L304 118 M315 145 L315 112 M320 145 L327 119" stroke="#34d399" stroke-width="3.5" stroke-linecap="round"/>
              <path id="grass2" d="M385 145 L379 120 M390 145 L390 114 M395 145 L402 121" stroke="#34d399" stroke-width="3.5" stroke-linecap="round"/>
            </g>

            <rect id="peatUpper" x="0" y="145" width="465" height="145" fill="#3e2723"/>
            <rect x="0" y="290" width="640" height="80" fill="#261c1a"/>
            <text x="16" y="348" fill="#a8a29e" font-size="12" font-weight="bold">Lapisan Tanah Mineral Dasar (Subsoil)</text>

            <g id="soilCracks" stroke="#1c100d" stroke-width="2.5" fill="none" style="display:none;">
              <path d="M65 145 L72 168 L62 188"/>
              <path d="M175 145 L168 174 L180 198"/>
              <path d="M295 145 L305 170 L292 195"/>
              <path d="M405 145 L396 172 L408 192"/>
            </g>

            <rect id="peatWater" x="0" y="160" width="465" height="130" fill="url(#waterGrad)"/>
            <line id="waterLine" x1="0" y1="160" x2="465" y2="160" stroke="#7dd3fc" stroke-width="2.5" stroke-dasharray="6 4"/>
            <text id="tmaLabel" x="14" y="180" fill="#e0f2fe" font-size="12" font-weight="bold">Muka Air Tanah (TMA): -10 cm</text>

            <rect x="465" y="145" width="175" height="145" fill="#182220"/>
            <rect id="canalWater" x="465" y="165" width="175" height="125" fill="url(#waterGrad)"/>
            <text x="480" y="162" fill="#99f6e4" font-size="12" font-weight="bold">Kanal Drainase</text>

            <g id="canalDam" style="display:none;">
              <rect x="472" y="150" width="18" height="140" rx="3" fill="#b45309" stroke="#fde68a" stroke-width="1.5"/>
              <line x1="472" y1="175" x2="490" y2="175" stroke="#78350f" stroke-width="2"/>
              <line x1="472" y1="205" x2="490" y2="205" stroke="#78350f" stroke-width="2"/>
              <line x1="472" y1="235" x2="490" y2="235" stroke="#78350f" stroke-width="2"/>
              <line x1="472" y1="265" x2="490" y2="265" stroke="#78350f" stroke-width="2"/>
              <rect x="496" y="174" width="134" height="24" rx="6" fill="#065f46" stroke="#34d399"/>
              <text x="563" y="190" text-anchor="middle" fill="#ecfdf5" font-size="11" font-weight="bold">SEKAT KANAL AKTIF</text>
            </g>

            <g id="fireGroup" style="display:none;">
              <ellipse class="ember-glow" cx="145" cy="182" rx="36" ry="15" fill="#ea580c"/>
              <ellipse class="ember-glow" cx="145" cy="182" rx="20" ry="8" fill="#fde047"/>
              <ellipse class="ember-glow" cx="265" cy="195" rx="44" ry="17" fill="#dc2626"/>
              <ellipse class="ember-glow" cx="265" cy="195" rx="24" ry="9" fill="#facc15"/>
              <ellipse class="ember-glow" cx="370" cy="178" rx="30" ry="13" fill="#ea580c"/>
              <text x="155" y="226" fill="#fed7aa" font-size="12" font-weight="bold">BARA API BAWAH TANAH (SMOLDERING)</text>
            </g>

            <g id="sparkSizzle" style="display:none;">
              <rect x="68" y="95" width="330" height="36" rx="10" fill="#0f766e" stroke="#5eead4" stroke-width="1.5"/>
              <text x="233" y="117" text-anchor="middle" fill="#ffffff" font-size="12" font-weight="bold">Percikan api mendesis padam! Gambut basah.</text>
            </g>
          </svg>

          <div id="simStatusBanner" class="status-banner status-safe">
            <span id="statusText">STATUS: AMAN &amp; BASAH (TMA -10 cm)</span>
            <span id="riskBadge">Risiko Kebakaran: RENDAH</span>
          </div>
        </div>

        <div class="sim-controls">
          <div>
            <div class="control-label">Pilih Kronologi Tahapan:</div>
            <div class="stage-buttons">
              <button class="btn-stage active" data-stage="1" onclick="setStage(1)">Tahap 1: Gambut Sehat</button>
              <button class="btn-stage" data-stage="2" onclick="setStage(2)">Tahap 2: Kanal Dibuka</button>
              <button class="btn-stage" data-stage="3" onclick="setStage(3)">Tahap 3: Api Bawah Tanah</button>
              <button class="btn-stage" data-stage="4" onclick="setStage(4)">Tahap 4: Sekat Kanal (3R)</button>
            </div>
          </div>

          <div class="slider-box">
            <div class="slider-header">
              <span>Tinggi Muka Air (TMA):</span>
              <span id="sliderValText" style="color:var(--teal-light);">-10 cm</span>
            </div>
            <input type="range" id="tmaSlider" min="0" max="90" value="10" oninput="onSliderChange(this.value)" />
            <div class="slider-ticks">
              <span>0 cm (Basah)</span>
              <span style="color:#fbbf24;">-40 cm (Batas Kritis)</span>
              <span style="color:#f87171;">-90 cm (Kering)</span>
            </div>
          </div>

          <div class="action-row">
            <button class="btn-spark" onclick="igniteSpark()">Sulut Percikan Api</button>
            <button class="btn-dam" id="btnToggleDam" onclick="toggleDam()">Pasang Sekat Kanal</button>
          </div>

          <div class="sim-narration" id="simNarration">
            <strong>Kondisi Alami:</strong> Tinggi muka air berada di -10 cm. Pori-pori tanah gambut jenuh air sehingga kebun dan hutan rawa tahan terhadap percikan api.
          </div>
        </div>
      </div>
    </section>
