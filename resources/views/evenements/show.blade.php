@extends('layouts.layout')

@section('title', 'Détails de l\'événement : ' . $evenement->titre)

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h1 class="mb-0 h4">{{ $evenement->titre }}</h1>
            </div>
            <div class="card-body">
                @if ($evenement->image_path)
                    <img src="{{ asset('storage/' . $evenement->image_path) }}" alt="Image de l'événement" class="img-fluid mb-3">
                @endif

                <p><strong>Catégorie :</strong> {{ $evenement->categorie }}</p>
                <p><strong>Club organisateur :</strong> {{ $evenement->club_organisateur }}</p>
                <p><strong>Date et heure :</strong> {{ $evenement->date_heure }}</p>
                <p><strong>Type :</strong> {{ $evenement->type }}</p>
                <p><strong>Lieu :</strong> {{ $evenement->lieu }}</p>
                <p><strong>Description :</strong> {{ $evenement->description }}</p>
                <p><strong>Programme :</strong> {{ $evenement->programme }}</p>
                <p>
                    <strong>Lien d'inscription :</strong>
                    @if ($evenement->lien_inscription)
                        <a href="{{ $evenement->lien_inscription }}" target="_blank">S'inscrire</a>
                    @else
                        Pas de lien d'inscription
                    @endif
                </p>
                <a href="{{ route('calendrier') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-1"></i> Retour à la liste 
                </a>
                <a href="{{ route('calendrier.edit', $evenement) }}" class="btn btn-sm btn-outline-warning me-1">Modifier</a>
            </div> {{-- card-body --}}
        </div> {{-- card --}}
    </div> {{-- container --}}
@endsection
