@extends('layouts.layout')
@section('title', 'Calendrier des Événements')
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- Utilisation de classes Bootstrap pour l'espacement et l'alignement --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Calendrier des événements</h1>
        <div class="d-flex justify-content-end">
    <form method="GET" action="{{ route('calendrier') }}" class="mb-4">
        <div class="d-flex flex-column align-items-end">
            <input type="text" name="titre" class="form-control mb-2" placeholder="Titre de l'événement" value="{{ request('titre') }}">
            <input type="date" name="date" class="form-control mb-2" value="{{ request('date') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>
</div>

        <a href="{{ route('calendrier.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Ajouter un nouvel événement 
        </a>
    </div>

    {{-- Boucle @forelse pour afficher les événements ou un message si vide --}}
    @forelse ($evenements as $evenement)
        {{-- Utilisation de la classe Card de Bootstrap pour structurer chaque événement --}}
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                {{-- Titre et Catégorie --}}
                <h5 class="card-title">{{ $evenement->titre }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $evenement->categorie }}</h6> {{-- CHAMP AJOUTÉ --}}

                {{-- Détails de l'événement --}}
                <p class="card-text mb-2"> 
                    <strong>Club Organisateur :</strong> {{ $evenement->club_organisateur }} <br>
                    {{-- Formatage de la date/heure avec Carbon (grâce aux $casts dans le Model) --}}
                    <strong>Date et Heure :</strong> {{ $evenement->date_heure->format('d/m/Y H:i') }} <br> {{-- FORMATAGE DATE --}}
                    <strong>Type :</strong> {{ $evenement->type }} <br>
                    {{-- Affiche le lieu seulement s'il n'est pas vide --}}
                    @if($evenement->lieu)
                        <strong>Lieu :</strong> {{ $evenement->lieu }} <br> {{-- CHAMP AJOUTÉ --}}
                    @endif
                    {{-- Affiche la description (tronquée pour la liste) --}}
                    <strong>Description :</strong> {{ \Illuminate\Support\Str::limit($evenement->description, 150, '...') }} <br> {{-- CHAMP AJOUTÉ (tronqué) --}}
                    {{-- Vous pouvez décommenter ceci si vous voulez afficher un aperçu du programme ici --}}
                    {{-- <strong>Programme :</strong> {{ \Illuminate\Support\Str::limit($evenement->programme, 100, '...') }} <br> --}} {{-- CHAMP AJOUTÉ (tronqué) --}}

                    {{-- Affiche le lien d'inscription seulement s'il n'est pas vide --}}
                    @if($evenement->lien_inscription)
                         {{-- CORRIGÉ : Nom du champ et rendu comme un lien --}}
                        <strong>Inscription :</strong> <a href="{{ $evenement->lien_inscription }}" target="_blank" rel="noopener noreferrer">Lien pour s'inscrire</a> <br>
                    @endif
                </p>

                {{-- Actions pour cet événement --}}
                <div class="event-actions mt-2">
                <a href="{{ route('calendrier.show', $evenement) }}" class="btn btn-sm btn-outline-info me-1">Voir Détails</a>
                <a href="{{ route('calendrier.edit', $evenement) }}" class="btn btn-sm btn-outline-warning me-1">Modifier</a>
                    {{-- Formulaire de suppression - Inchangé mais j'ajoute une classe au bouton --}}
                    <form action="{{ route('calendrier.destroy', $evenement) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer l\'événement : \'{{ $evenement->titre }}\' ?');">
                    @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- Fin du bloc pour un événement --}}
    {{-- Section @empty : s'affiche si $evenements est vide --}}
    @empty
        {{-- Utilisation d'une alerte Bootstrap pour le message --}}
        <div class="alert alert-secondary" role="alert">
            Il n'y a aucun événement programmé pour le moment.
        </div>

    @endforelse

@endsection
