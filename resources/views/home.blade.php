@extends('layouts.layout')
@section('title')  home @endsection
@section('content')
<div class="container">
    @auth
        {{-- Si connecté --}}
        <div class="alert alert-success mt-4">
            Bienvenue, <strong>{{ Auth::user()->name }}</strong> !
            @if(Auth::user()->role === 'admin')
                (Administrateur)
            @elseif(Auth::user()->role === 'responsable')
                (Responsable de Club)
            @endif
        </div>
    @else
        {{-- Si non connecté --}}
        <div class="alert alert-info mt-4">
        <h1> Bienvenue sur notre plateforme.  </h1>
        
            pour les administrateurs et responsables des clubs Connectez-vous pour accéder à votre espace.
        </div>
    @endauth

    {{-- Contenu normal de la page d'accueil --}}
    <!-- ... -->
</div>
@endsection
