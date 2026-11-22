let score = 0;
let solvedCount = 0;
let selectedCardEl = null;
let TOTAL_CARDS = 0;
let DANGER_TOTAL = 0;
let HINT_TEXT = '';

function shakeElement(el) {
  if (!el || !el.animate) return;
  el.animate(
    [
      { transform: 'translateX(0)' },
      { transform: 'translateX(-7px)' },
      { transform: 'translateX(7px)' },
      { transform: 'translateX(-5px)' },
      { transform: 'translateX(5px)' },
      { transform: 'translateX(0)' }
    ],
    { duration: 360, easing: 'ease-in-out' }
  );
}

function initDragAndDrop() {
  TOTAL_CARDS = document.querySelectorAll('.action-card').length;
  DANGER_TOTAL = document.querySelectorAll('.action-card[data-target="zona-larangan"]').length;
  HINT_TEXT = document.getElementById('gameFeedback').textContent.trim();

  document.querySelectorAll('.action-card').forEach(card => {
    card.addEventListener('dragstart', (e) => {
      e.dataTransfer.setData('text/plain', card.dataset.id);
      selectCard(card);
    });
  });

  document.querySelectorAll('.drop-zone').forEach(zone => {
    zone.addEventListener('dragover', (e) => {
      e.preventDefault();
      zone.classList.add('drag-over');
    });
    zone.addEventListener('dragleave', () => {
      zone.classList.remove('drag-over');
    });
    zone.addEventListener('drop', (e) => {
      e.preventDefault();
      zone.classList.remove('drag-over');
      const cardId = e.dataTransfer.getData('text/plain');
      const card = document.querySelector(`.action-card[data-id="${cardId}"]`);
      if (card) evaluateDrop(card, zone);
    });
  });
}

function selectCard(card) {
  if (card.classList.contains('used')) return;
  document.querySelectorAll('.action-card').forEach(c => c.classList.remove('selected'));
  card.classList.add('selected');
  selectedCardEl = card;
}

function tapZone(zone) {
  if (!selectedCardEl) return;
  evaluateDrop(selectedCardEl, zone);
}

async function evaluateDrop(card, zone) {
  if (card.classList.contains('used')) return;
  const feedback = document.getElementById('gameFeedback');
  const targetZone = card.dataset.target;
  const chosenZone = zone.dataset.zone;

  if (targetZone === chosenZone) {
    card.classList.remove('selected');
    card.classList.add('used');
    selectedCardEl = null;

    score += 100;
    solvedCount += 1;
    document.getElementById('gameScore').textContent = score;
    document.getElementById('gameProgressText').textContent = `${solvedCount} / ${TOTAL_CARDS}`;
    document.getElementById('gameProgressBar').style.width = `${(solvedCount / TOTAL_CARDS) * 100}%`;

    const badge = document.createElement('span');
    badge.className = 'dropped-badge';
    badge.textContent = card.querySelector('h4').textContent;
    document.getElementById(`list-${chosenZone}`).appendChild(badge);

    if (chosenZone === 'zona-larangan') {
      if (document.getElementById('list-zona-larangan').children.length === DANGER_TOTAL) {
        zone.classList.add('solved-danger');
      }
    } else {
      zone.classList.add('solved-eco');
    }

    feedback.className = 'game-feedback success';
    feedback.textContent = card.dataset.exp;

    if (solvedCount === TOTAL_CARDS) {
      document.getElementById('victoryBanner').classList.add('show');
      const note = document.getElementById('victoryNote');
      note.textContent = `Skor akhir: ${Math.max(score, 0)}. `;
      const res = await postScore({ type: 'dragdrop', points: Math.max(score, 0) });
      const span = document.createElement('span');
      span.innerHTML = saveNoteHtml(res);
      note.appendChild(span);
    }
  } else {
    score -= 20;
    document.getElementById('gameScore').textContent = score;

    shakeElement(zone);
    shakeElement(card);

    const prevBorder = zone.style.borderColor;
    const prevBg = zone.style.backgroundColor;
    zone.style.borderColor = '#ef4444';
    zone.style.backgroundColor = 'rgba(239, 68, 68, 0.16)';
    setTimeout(() => {
      zone.style.borderColor = prevBorder;
      zone.style.backgroundColor = prevBg;
    }, 550);

    feedback.className = 'game-feedback error';
    if (targetZone === 'zona-larangan' && chosenZone !== 'zona-larangan') {
      feedback.textContent = 'Salah Zona (-20 Poin)! Tindakan ini berbahaya dan memicu kebakaran gambut—seharusnya diblokir ke Zona Larangan!';
    } else if (targetZone !== 'zona-larangan' && chosenZone === 'zona-larangan') {
      feedback.textContent = 'Salah Zona (-20 Poin)! Ini adalah aksi pemulihan lahan yang bermanfaat, bukan tindakan terlarang.';
    } else {
      feedback.textContent = 'Salah Kategori (-20 Poin)! Kartu ini memang solusi restorasi, tetapi kurang sesuai dengan fungsi zona tersebut.';
    }
  }
}

function resetGame() {
  score = 0;
  solvedCount = 0;
  selectedCardEl = null;
  document.getElementById('gameScore').textContent = '0';
  document.getElementById('gameProgressText').textContent = `0 / ${TOTAL_CARDS}`;
  document.getElementById('gameProgressBar').style.width = '0%';
  document.getElementById('victoryBanner').classList.remove('show');
  document.getElementById('victoryNote').textContent = '';

  const feedback = document.getElementById('gameFeedback');
  feedback.className = 'game-feedback';
  feedback.textContent = HINT_TEXT;

  document.querySelectorAll('.action-card').forEach(c => {
    c.classList.remove('used', 'selected');
  });
  document.querySelectorAll('.drop-zone').forEach(z => {
    z.classList.remove('solved-eco', 'solved-danger', 'drag-over');
  });
  document.querySelectorAll('.zone-dropped-list').forEach(list => {
    list.innerHTML = '';
  });
}

document.addEventListener('DOMContentLoaded', initDragAndDrop);
