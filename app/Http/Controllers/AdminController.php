<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return "Espace Admin : Bienvenue " . Auth::user()->email;
    }
}
