@extends('layouts.layout')

@section('title', 'Ajouter un nouvel événement')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h1 class="mb-0 h4">Ajouter un nouvel événement</h1>
            </div>
            <div class="card-body">
                {{-- Affichage des erreurs générales (si nécessaire) --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oups !</strong> Il y a eu des problèmes avec votre saisie.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('calendrier.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('evenements._form')

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus me-1"></i> Enregistrer l'événement
                        </button>
                        <a href="{{ route('calendrier') }}" class="btn btn-secondary ms-2">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
