<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{
    public function dashboard($id)
    {
        return "Espace Responsable : Bienvenue " . Auth::user()->email;
    }
}
