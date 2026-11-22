// Helper bersama: kirim skor ke server (hanya untuk pengguna yang sudah login).
async function postScore(payload) {
  if (!window.APP.auth) return { guest: true };
  try {
    const r = await fetch(APP.scoreUrl, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': APP.csrf },
      body: JSON.stringify(payload)
    });
    return await r.json();
  } catch (e) {
    return { error: true };
  }
}

function saveNoteHtml(res) {
  if (res.guest) return `<a href="${APP.loginUrl}" style="color:var(--teal-light)">Masuk</a> agar skor tersimpan di leaderboard.`;
  if (res.error || !res.ok) return '(Skor gagal disimpan.)';
  return 'Skor tersimpan ke leaderboard!';
}
