<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function actualite()
    {
        return view('actualite');
    }

    public function apropos()
    {
        return view('apropos');
    }

    public function calendrier()
    {
        return view('calendrier');
    }

    public function annuaire()
    {
        return view('annuaire');
    }
}
