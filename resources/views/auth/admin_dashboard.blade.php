@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mt-4">Tableau de Bord Administrateur</h1>
    <div class="card shadow">
        <div class="card-body">
            <p>Bienvenue <strong>{{ Auth::user()->name }}</strong> (Rôle: Administrateur)</p>
            <!-- Contenu spécifique admin -->
            <a href="{{ route('gestion.utilisateurs') }}" class="btn btn-primary">
                Gérer les utilisateurs
            </a>
        </div>
    </div>
</div>
@endsection