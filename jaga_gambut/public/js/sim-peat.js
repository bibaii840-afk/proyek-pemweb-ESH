let currentTMA = 10;
let isBurning = false;
let damActive = false;
let hydroTimer = null;

function stopHydroFlow() {
  if (hydroTimer) {
    clearInterval(hydroTimer);
    hydroTimer = null;
  }
}

function updateSimulatorUI() {
  const slider = document.getElementById('tmaSlider');
  slider.value = currentTMA;
  document.getElementById('sliderValText').textContent = `-${currentTMA} cm`;

  const waterY = 148 + (currentTMA / 90) * 127;
  const waterH = 290 - waterY;

  const peatWater = document.getElementById('peatWater');
  const waterLine = document.getElementById('waterLine');
  const canalWater = document.getElementById('canalWater');
  const tmaLabel = document.getElementById('tmaLabel');

  peatWater.setAttribute('y', waterY);
  peatWater.setAttribute('height', waterH);
  waterLine.setAttribute('y1', waterY);
  waterLine.setAttribute('y2', waterY);

  tmaLabel.textContent = `Muka Air Tanah (TMA): -${currentTMA} cm`;
  tmaLabel.setAttribute('y', currentTMA > 75 ? waterY - 8 : waterY + 18);

  const canalY = damActive ? Math.max(155, waterY - 14) : Math.min(282, waterY + 18);
  canalWater.setAttribute('y', canalY);
  canalWater.setAttribute('height', 290 - canalY);

  const soilCracks = document.getElementById('soilCracks');
  const peatUpper = document.getElementById('peatUpper');
  const canopy1 = document.getElementById('canopy1');
  const canopy2 = document.getElementById('canopy2');

  if (currentTMA > 40) {
    soilCracks.style.display = 'block';
    peatUpper.setAttribute('fill', '#5d3a2e');
    canopy1.setAttribute('fill', isBurning ? '#44403c' : '#ca8a04');
    canopy2.setAttribute('fill', isBurning ? '#292524' : '#a16207');
  } else {
    soilCracks.style.display = 'none';
    peatUpper.setAttribute('fill', '#3e2723');
    canopy1.setAttribute('fill', '#10b981');
    canopy2.setAttribute('fill', '#059669');
  }

  if (currentTMA <= 40 && isBurning) {
    isBurning = false;
  }

  document.getElementById('fireGroup').style.display = isBurning ? 'block' : 'none';
  document.getElementById('smokeGroup').style.display = isBurning ? 'block' : 'none';
  document.getElementById('skyTop').setAttribute('stop-color', isBurning ? '#431407' : '#0f2e2b');
  document.getElementById('skyBot').setAttribute('stop-color', isBurning ? '#9a3412' : '#1e4e48');

  document.getElementById('canalDam').style.display = damActive ? 'block' : 'none';
  document.getElementById('btnToggleDam').textContent = damActive ? 'Lepas Sekat Kanal' : 'Pasang Sekat Kanal';

  const banner = document.getElementById('simStatusBanner');
  const statusText = document.getElementById('statusText');
  const riskBadge = document.getElementById('riskBadge');
  const narration = document.getElementById('simNarration');

  banner.className = 'status-banner';
  if (isBurning) {
    banner.classList.add('status-fire');
    statusText.textContent = `BAHAYA: KEBAKARAN BAWAH TANAH (TMA -${currentTMA} cm)`;
    riskBadge.textContent = 'Risiko: AKTIF TERBAKAR';
    narration.innerHTML = '<strong>Api Bawah Tanah Menyala!</strong> Bara api membakar serat gambut kering di bawah permukaan dan menghasilkan kabut asap tebal. Pasang sekat kanal untuk menaikkan muka air tanah hingga api padam.';
  } else if (currentTMA > 40) {
    banner.classList.add('status-warn');
    statusText.textContent = `WASPADA: GAMBUT KERING KRITIS (TMA -${currentTMA} cm)`;
    riskBadge.textContent = 'Risiko Kebakaran: SANGAT TINGGI';
    narration.innerHTML = '<strong>Kanal Terbuka Menguras Air (-40 cm Terlewati):</strong> Tanpa sekat, air gambut terus mengalir keluar ke kanal. Lapisan atas retak, mengering, dan sangat mudah terbakar jika terkena percikan api.';
  } else {
    banner.classList.add('status-safe');
    statusText.textContent = `STATUS: AMAN & BASAH (TMA -${currentTMA} cm)`;
    riskBadge.textContent = 'Risiko Kebakaran: RENDAH';
    narration.innerHTML = damActive
      ? '<strong>Sekat Kanal Aktif (Rewetting):</strong> Sekat menahan air di dalam kanal sehingga meresap kembali membasahi gambut dan menjaga TMA tetap aman di atas -40 cm.'
      : '<strong>Kondisi Basah:</strong> Tinggi muka air masih berada di atas batas kritis (-40 cm). Namun karena sekat kanal terbuka, air akan perlahan surut ke saluran drainase.';
  }
}

function setStage(stage) {
  stopHydroFlow();
  document.querySelectorAll('.btn-stage').forEach(btn => {
    btn.classList.toggle('active', Number(btn.dataset.stage) === stage);
  });
  document.getElementById('sparkSizzle').style.display = 'none';

  if (stage === 1) {
    currentTMA = 10;
    damActive = false;
    isBurning = false;
  } else if (stage === 2) {
    currentTMA = 55;
    damActive = false;
    isBurning = false;
  } else if (stage === 3) {
    currentTMA = 78;
    damActive = false;
    isBurning = true;
  } else if (stage === 4) {
    currentTMA = 15;
    damActive = true;
    isBurning = false;
  }
  updateSimulatorUI();
}

function onSliderChange(val) {
  stopHydroFlow();
  currentTMA = Number(val);
  document.querySelectorAll('.btn-stage').forEach(btn => btn.classList.remove('active'));
  document.getElementById('sparkSizzle').style.display = 'none';
  updateSimulatorUI();
}

function igniteSpark() {
  const sizzle = document.getElementById('sparkSizzle');
  if (currentTMA > 40) {
    isBurning = true;
    sizzle.style.display = 'none';
    updateSimulatorUI();
  } else {
    isBurning = false;
    sizzle.style.display = 'block';
    setTimeout(() => {
      sizzle.style.display = 'none';
    }, 2600);
  }
}

function toggleDam() {
  stopHydroFlow();
  damActive = !damActive;
  document.querySelectorAll('.btn-stage').forEach(btn => btn.classList.remove('active'));
  document.getElementById('sparkSizzle').style.display = 'none';
  updateSimulatorUI();

  if (damActive) {
    hydroTimer = setInterval(() => {
      if (currentTMA > 15) {
        currentTMA = Math.max(15, currentTMA - 2);
        updateSimulatorUI();
      } else {
        stopHydroFlow();
      }
    }, 90);
  } else {
    hydroTimer = setInterval(() => {
      if (currentTMA < 65) {
        currentTMA = Math.min(65, currentTMA + 2);
        updateSimulatorUI();
      } else {
        stopHydroFlow();
      }
    }, 110);
  }
}

document.addEventListener('DOMContentLoaded', updateSimulatorUI);
