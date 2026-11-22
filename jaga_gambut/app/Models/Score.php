<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['user_id', 'type', 'points', 'max_points'];

    /** Skor terbaik per jenis (drag & drop + kuis) untuk setiap pengguna, urut dari tertinggi. */
    public static function leaderboard()
    {
        $rows = static::selectRaw('user_id, type, MAX(points) as best')
            ->groupBy('user_id', 'type')->get()->groupBy('user_id');
        $names = User::whereIn('id', $rows->keys())->pluck('name', 'id');

        return $rows->map(function ($g, $id) use ($names) {
            $dd = (int) ($g->firstWhere('type', 'dragdrop')?->best ?? 0);
            $qz = (int) ($g->firstWhere('type', 'quiz')?->best ?? 0);
            return ['user_id' => $id, 'name' => $names[$id] ?? '-', 'dragdrop' => $dd, 'quiz' => $qz, 'total' => $dd + $qz];
        })->sortByDesc('total')->values();
    }
}
