<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /** Simpan skor (dipanggil lewat fetch dari halaman utama). */
    public function store(Request $request)
    {
        $d = $request->validate([
            'type' => 'required|in:dragdrop,quiz',
            'points' => 'nullable|integer',
            'answers' => 'nullable|array',
        ]);

        if ($d['type'] === 'quiz') {
            // Kuis dinilai di server agar skor tidak bisa dipalsukan.
            $quiz = config('gambut.quiz');
            $correct = 0;
            foreach ($quiz as $i => $q) {
                if (($d['answers'][$i] ?? null) === $q['answer']) $correct++;
            }
            $points = $correct * 100;
            $max = count($quiz) * 100;
        } else {
            $max = count(config('gambut.cards')) * 100;
            $points = max(0, min((int) ($d['points'] ?? 0), $max));
        }

        Score::create(['user_id' => $request->user()->id, 'type' => $d['type'], 'points' => $points, 'max_points' => $max]);

        return response()->json(['ok' => true, 'points' => $points, 'max' => $max]);
    }

    public function dashboard(Request $request)
    {
        $uid = $request->user()->id;
        $best = fn ($t) => (int) Score::where('user_id', $uid)->where('type', $t)->max('points');
        $board = Score::leaderboard();
        $rank = $board->search(fn ($r) => $r['user_id'] == $uid);

        return view('dashboard', [
            'dragdrop' => $best('dragdrop'),
            'quiz' => $best('quiz'),
            'plays' => Score::where('user_id', $uid)->count(),
            'rank' => $rank === false ? null : $rank + 1,
            'players' => $board->count(),
            'maxDrag' => count(config('gambut.cards')) * 100,
            'maxQuiz' => count(config('gambut.quiz')) * 100,
            'history' => Score::where('user_id', $uid)->latest()->limit(10)->get(),
        ]);
    }

    public function leaderboard()
    {
        return view('leaderboard', ['rows' => Score::leaderboard()->take(20)]);
    }
}
