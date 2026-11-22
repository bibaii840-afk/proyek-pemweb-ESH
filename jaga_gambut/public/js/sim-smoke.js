let smkHa = 60;
let smkStrong = false;

function smkIspu() {
  return Math.min(500, Math.round(30 + smkHa * (smkStrong ? 0.5 : 1.1)));
}

function smkCategory(v) {
  if (v <= 50) return ['BAIK', 'RENDAH', 'status-safe', 'Udara bersih. Aktivitas luar ruangan aman dilakukan.'];
  if (v <= 100) return ['SEDANG', 'RENDAH', 'status-safe', 'Kualitas udara dapat diterima, namun penderita asma sebaiknya tetap waspada.'];
  if (v <= 200) return ['TIDAK SEHAT', 'MENENGAH', 'status-warn', 'Kelompok sensitif (anak, lansia, penderita asma) perlu mengurangi aktivitas luar ruangan dan memakai masker.'];
  if (v <= 300) return ['SANGAT TIDAK SEHAT', 'TINGGI', 'status-fire', 'Semua orang berisiko mengalami ISPA. Batasi aktivitas luar ruangan, gunakan masker, dan pertimbangkan meliburkan sekolah.'];
  return ['BERBAHAYA', 'SANGAT TINGGI', 'status-fire', 'Kondisi darurat kesehatan. Tetap di dalam ruangan, gunakan masker saat terpaksa keluar, dan ikuti arahan BPBD.'];
}

function smkRender() {
  const v = smkIspu();
  document.getElementById('smkSlider').value = smkHa;
  document.getElementById('smkHaText').textContent = `${smkHa} ha`;

  const haze = Math.min(0.8, (v / 500) * 0.85);
  document.getElementById('smkHaze').setAttribute('opacity', haze);
  document.getElementById('smkSun').setAttribute('opacity', 1 - haze);
  const fire = document.getElementById('smkFire');
  fire.style.display = smkHa > 0 ? 'block' : 'none';
  fire.setAttribute('rx', 14 + smkHa / 10);

  const puffs = document.getElementById('smkPuffs');
  const n = Math.ceil(smkHa / 50);
  let html = '';
  for (let i = 0; i < Math.min(n, 10); i++) {
    const x = 90 + i * 42 + (smkStrong ? i * 20 : 0);
    const y = 235 - i * 12;
    html += `<circle class="smoke-puff" cx="${x}" cy="${y}" r="${18 + i * 3}" fill="${i % 2 ? '#cbd5e1' : '#94a3b8'}" opacity="0.65"/>`;
  }
  puffs.innerHTML = html;

  const [label, risk, cls, advice] = smkCategory(v);
  const banner = document.getElementById('smkBanner');
  banner.className = 'status-banner ' + cls;
  document.getElementById('smkStatus').textContent = `ISPU ${v}: ${label}`;
  document.getElementById('smkRisk').textContent = `Risiko ISPA: ${risk}`;
  document.getElementById('smkNarration').innerHTML =
    `<strong>${smkStrong ? 'Angin Kencang' : 'Angin Tenang'}:</strong> ${smkStrong
      ? 'Asap tersebar lebih luas dan terencerkan, tetapi dapat terbawa hingga ke wilayah yang jauh dari titik api.'
      : 'Asap menumpuk dan bertahan dekat permukiman sehingga konsentrasinya lebih pekat.'} ${advice}`;
}

function smkChange(val) { smkHa = Number(val); smkRender(); }
function smkAdd(d) { smkHa = Math.max(0, Math.min(500, smkHa + d)); smkRender(); }
function smkSetWind(strong) {
  smkStrong = strong;
  document.getElementById('smkWindCalm').classList.toggle('active', !strong);
  document.getElementById('smkWindStrong').classList.toggle('active', strong);
  smkRender();
}

document.addEventListener('DOMContentLoaded', smkRender);
