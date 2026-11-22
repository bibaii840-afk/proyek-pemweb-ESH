<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function materi()
    {
        return view('materi', ['materi' => config('gambut.materi')]);
    }
}
