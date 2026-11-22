const compareData = {
  karbon: {
    hMetric: 'Penyerap & Penyimpan Karbon',
    hDesc: 'Kondisi tergenang air memperlambat pembusukan sisa tumbuhan selama ribuan tahun, mengunci jutaan ton karbon agar tidak lepas ke atmosfer.',
    bMetric: 'Emisi Gas Rumah Kaca Masif',
    bDesc: 'Satu kali kebakaran besar di lahan gambut melepaskan karbon yang tersimpan ratusan tahun dalam hitungan minggu, mempercepat pemanasan global.'
  },
  udara: {
    hMetric: 'Udara Bersih & Iklim Mikro Sejuk',
    hDesc: 'Kelembapan tinggi menjaga suhu lokal tetap sejuk dan menyaring partikel polutan udara di sekitar kawasan permukiman.',
    bMetric: 'Kabut Asap Pekat & Lonjakan ISPA',
    bDesc: 'Pembakaran tidak sempurna (smoldering) menghasilkan partikel halus PM2.5 beracun yang memicu infeksi saluran pernapasan akut (ISPA).'
  },
  satwa: {
    hMetric: 'Habitat Keanekaragaman Hayati',
    hDesc: 'Menjadi rumah bagi ikan rawa (gabus, papuyu, toman), burung air, serta primata dilindungi seperti orangutan dan bekantan.',
    bMetric: 'Hilangnya Ruang Hidup Satwa',
    bDesc: 'Pohon sarang musnah dan perairan rawa menjadi asam serta tercemar abu pembakaran, mengancam populasi ikan dan satwa endemik.'
  },
  ekonomi: {
    hMetric: 'Sumber Pangan & Paludikultur Berkelanjutan',
    hDesc: 'Masyarakat dapat memanen ikan rawa, madu kelulut, purun untuk kerajinan anyaman, serta tanaman sagu dan jelutung tanpa merusak tanah.',
    bMetric: 'Sekolah Diliburkan & Transportasi Lumpuh',
    bDesc: 'Jarak pandang menurun drastis melumpuhkan penerbangan, pelayaran sungai, aktivitas belajar mengajar, serta menimbulkan kerugian ekonomi miliaran rupiah.'
  }
};

function switchCompare(key, btn) {
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('healthyMetric').textContent = compareData[key].hMetric;
  document.getElementById('healthyDesc').textContent = compareData[key].hDesc;
  document.getElementById('burnedMetric').textContent = compareData[key].bMetric;
  document.getElementById('burnedDesc').textContent = compareData[key].bDesc;
}
