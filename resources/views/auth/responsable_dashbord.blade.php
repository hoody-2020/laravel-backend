@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mt-4">Espace Responsable de Club</h1>
    <div class="card shadow">
        <div class="card-body">
            <p>Bienvenue <strong>{{ Auth::user()->club->nom }}</strong></p>
            <!-- Contenu spécifique responsable -->
            <a href="{{ route('club.evenements') }}" class="btn btn-success">
                Gérer les événements
            </a>
        </div>
    </div>
</div>
@endsection