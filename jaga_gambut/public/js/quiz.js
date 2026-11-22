const quizQuestions = window.GAMBUT.quiz;
let quizAnswers = [];

function renderQuiz() {
  quizAnswers = [];
  document.getElementById('quizResult').style.display = 'none';
  const container = document.getElementById('quizContainer');
  container.innerHTML = quizQuestions.map((item, qIdx) => `
    <div class="quiz-item">
      <div class="quiz-q">${item.q}</div>
      <div class="quiz-options">
        ${item.options.map((opt, oIdx) => `
          <button class="quiz-opt" onclick="answerQuiz(${qIdx}, ${oIdx}, this)">${opt}</button>
        `).join('')}
      </div>
      <div class="quiz-exp" id="exp-${qIdx}">${item.exp}</div>
    </div>
  `).join('');
}

async function answerQuiz(qIdx, oIdx, btn) {
  const item = quizQuestions[qIdx];
  const buttons = btn.parentElement.querySelectorAll('.quiz-opt');
  buttons.forEach((b, idx) => {
    b.disabled = true;
    if (idx === item.answer) b.classList.add('correct');
    else if (idx === oIdx) b.classList.add('wrong');
  });
  document.getElementById(`exp-${qIdx}`).classList.add('show');
  quizAnswers[qIdx] = oIdx;

  const done = quizQuestions.every((_, i) => quizAnswers[i] !== undefined);
  if (!done) return;

  const correct = quizQuestions.filter((q, i) => quizAnswers[i] === q.answer).length;
  const box = document.getElementById('quizResult');
  box.className = 'game-feedback success';
  box.style.display = 'block';
  box.textContent = `Kuis selesai! Benar ${correct} dari ${quizQuestions.length} (skor ${correct * 100}). `;
  const res = await postScore({ type: 'quiz', answers: quizAnswers });
  const span = document.createElement('span');
  span.innerHTML = saveNoteHtml(res);
  box.appendChild(span);
}

document.addEventListener('DOMContentLoaded', renderQuiz);
