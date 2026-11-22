<section id="perbandingan" class="card-section">
      <div class="section-header">
        <h2>5. Perbandingan Kondisi: Gambut Sehat vs Gambut Terbakar</h2>
        <p>Klik kategori di bawah untuk membandingkan dampak ekologis dan sosial-ekonomi secara langsung.</p>
      </div>

      <div class="tabs-bar">
        <button class="tab-btn active" onclick="switchCompare('karbon', this)">Simpanan Karbon</button>
        <button class="tab-btn" onclick="switchCompare('udara', this)">Kualitas Udara &amp; ISPA</button>
        <button class="tab-btn" onclick="switchCompare('satwa', this)">Habitat Satwa Rawa</button>
        <button class="tab-btn" onclick="switchCompare('ekonomi', this)">Sosial &amp; Ekonomi</button>
      </div>

      <div class="compare-grid">
        <div class="compare-box compare-healthy">
          <h3>Ekosistem Gambut Sehat (Basah)</h3>
          <div class="compare-metric" id="healthyMetric">Penyerap &amp; Penyimpan Karbon</div>
          <p id="healthyDesc" class="compare-desc">
            Kondisi tergenang air memperlambat pembusukan sisa tumbuhan selama ribuan tahun, mengunci jutaan ton karbon agar tidak lepas ke atmosfer.
          </p>
        </div>

        <div class="compare-box compare-burned">
          <h3>Ekosistem Gambut Terbakar (Kering)</h3>
          <div class="compare-metric" id="burnedMetric">Emisi Gas Rumah Kaca Masif</div>
          <p id="burnedDesc" class="compare-desc">
            Satu kali kebakaran besar di lahan gambut melepaskan karbon yang tersimpan ratusan tahun dalam hitungan minggu, mempercepat pemanasan global.
          </p>
        </div>
      </div>
    </section>
