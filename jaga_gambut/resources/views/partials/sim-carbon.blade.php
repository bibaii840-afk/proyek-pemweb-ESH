<section id="simulator-karbon" class="card-section">
  <div class="section-header">
    <h2>3. Simulator Emisi Karbon Gambut</h2>
    <p>Hitung perkiraan karbon dioksida yang terlepas ketika gambut terbakar, berdasarkan <strong>luas</strong> dan <strong>kedalaman lapisan yang terbakar</strong>. Angka bersifat estimasi edukatif.</p>
  </div>
  <div class="sim-grid">
    <div class="svg-stage">
      <svg id="carbonSvg" viewBox="0 0 640 370" xmlns="http://www.w3.org/2000/svg">
        <rect x="0" y="0" width="640" height="370" fill="#141916"/>
        <text x="40" y="38" fill="#a8a29e" font-size="12" font-weight="bold">Penampang Gambut (60 cm)</text>
        <rect x="40" y="50" width="200" height="270" fill="#3e2723"/>
        <rect id="crbBurned" x="40" y="50" width="200" height="60" fill="#1c100d"/>
        <rect id="crbGlow" x="40" y="104" width="200" height="6" fill="#ea580c" class="ember-glow"/>
        <text id="crbDepthLabel" x="250" y="90" fill="#fed7aa" font-size="12" font-weight="bold">Terbakar: 20 cm</text>
        <text x="40" y="342" fill="#a8a29e" font-size="12" font-weight="bold">Dasar: tanah mineral</text>
        <text x="300" y="38" fill="#a8a29e" font-size="12" font-weight="bold">Perkiraan Emisi CO&#8322;</text>
        <rect x="300" y="52" width="320" height="26" rx="6" fill="#1e2520" stroke="#3c483f"/>
        <rect id="crbBar" x="300" y="52" width="10" height="26" rx="6" fill="#d45d2a"/>
        <text id="crbEmission" x="300" y="112" fill="#f4f1e8" font-size="20" font-weight="bold"></text>
        <text id="crbCars" x="300" y="146" fill="#cbd5e1" font-size="13"></text>
        <text id="crbArea" x="300" y="172" fill="#cbd5e1" font-size="13"></text>
      </svg>
      <div id="crbBanner" class="status-banner status-warn">
        <span id="crbStatus"></span>
        <span id="crbRisk"></span>
      </div>
    </div>

    <div class="sim-controls">
      <div>
        <div class="control-label">Skenario Cepat:</div>
        <div class="stage-buttons">
          <button class="btn-stage" onclick="crbPreset(20,10,this)">Kecil (20 ha, 10 cm)</button>
          <button class="btn-stage active" onclick="crbPreset(100,20,this)">Sedang (100 ha, 20 cm)</button>
          <button class="btn-stage" onclick="crbPreset(500,40,this)">Besar (500 ha, 40 cm)</button>
          <button class="btn-stage" onclick="crbPreset(1000,60,this)">Ekstrem (1000 ha, 60 cm)</button>
        </div>
      </div>
      <div class="slider-box">
        <div class="slider-header"><span>Luas Terbakar:</span><span id="crbHaText" style="color:var(--teal-light);">100 ha</span></div>
        <input type="range" id="crbHaSlider" min="10" max="1000" step="10" value="100" oninput="crbChange()" />
        <div class="slider-ticks"><span>10 ha</span><span>1000 ha</span></div>
      </div>
      <div class="slider-box">
        <div class="slider-header"><span>Kedalaman Terbakar:</span><span id="crbDepthText" style="color:var(--teal-light);">20 cm</span></div>
        <input type="range" id="crbDepthSlider" min="5" max="60" step="5" value="20" oninput="crbChange()" />
        <div class="slider-ticks"><span>5 cm</span><span>60 cm</span></div>
      </div>
      <div class="sim-narration" id="crbNarration">
        <strong>Cara menghitung:</strong> perkiraan emisi = luas (ha) &times; kedalaman (cm) &times; &plusmn;18 ton CO&#8322; per ha per cm. Satu mobil dianggap menghasilkan &plusmn;4,6 ton CO&#8322; per tahun.
      </div>
    </div>
  </div>
</section>
