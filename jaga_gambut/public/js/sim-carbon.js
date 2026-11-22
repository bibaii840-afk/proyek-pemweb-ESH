const CRB_T_PER_HA_CM = 18; // estimasi edukatif ton CO2 per ha per cm gambut
const CRB_CAR_T_YEAR = 4.6;

function crbFmt(n) { return Math.round(n).toLocaleString('id-ID'); }

function crbChange() {
  document.querySelectorAll('#simulator-karbon .btn-stage').forEach(b => b.classList.remove('active'));
  crbRender();
}

function crbPreset(ha, cm, btn) {
  document.getElementById('crbHaSlider').value = ha;
  document.getElementById('crbDepthSlider').value = cm;
  document.querySelectorAll('#simulator-karbon .btn-stage').forEach(b => b.classList.remove('active'));
  if (btn) btn.classList.add("active");
  crbRender();
}

function crbRender() {
  const ha = Number(document.getElementById('crbHaSlider').value);
  const cm = Number(document.getElementById('crbDepthSlider').value);
  const co2 = ha * cm * CRB_T_PER_HA_CM;
  const max = 1000 * 60 * CRB_T_PER_HA_CM;

  document.getElementById('crbHaText').textContent = `${ha} ha`;
  document.getElementById('crbDepthText').textContent = `${cm} cm`;

  const burnH = (cm / 60) * 270;
  document.getElementById('crbBurned').setAttribute('height', burnH);
  document.getElementById('crbGlow').setAttribute('y', 50 + burnH - 6);
  document.getElementById('crbDepthLabel').textContent = `Terbakar: ${cm} cm`;
  document.getElementById('crbDepthLabel').setAttribute('y', 50 + Math.max(16, burnH / 2));

  document.getElementById('crbBar').setAttribute('width', Math.max(10, (co2 / max) * 320));
  document.getElementById('crbEmission').textContent = `${crbFmt(co2)} ton CO\u2082`;
  document.getElementById('crbCars').textContent = `\u2248 emisi ${crbFmt(co2 / CRB_CAR_T_YEAR)} mobil selama 1 tahun`;
  document.getElementById('crbArea').textContent = `Luas terbakar: ${crbFmt(ha)} ha (\u2248 ${crbFmt(ha * 1.4)} lapangan sepak bola)`;

  const banner = document.getElementById('crbBanner');
  let cls = 'status-safe', label = 'DAMPAK KECIL', risk = 'Emisi: RENDAH';
  if (co2 >= 100000) { cls = 'status-fire'; label = 'DAMPAK SANGAT BESAR'; risk = 'Emisi: EKSTREM'; }
  else if (co2 >= 20000) { cls = 'status-warn'; label = 'DAMPAK BESAR'; risk = 'Emisi: TINGGI'; }
  banner.className = 'status-banner ' + cls;
  document.getElementById('crbStatus').textContent = `${label} (${cm} cm gambut hilang)`;
  document.getElementById('crbRisk').textContent = risk;
}

document.addEventListener('DOMContentLoaded', crbRender);
