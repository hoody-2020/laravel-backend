@extends('layouts.layout')

@section('title', 'Modifier l\'événement : ' . $evenement->titre)

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h1 class="mb-0 h4">Modifier l'événement : {{ $evenement->titre }}</h1>
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

                <form action="{{ route('calendrier.update', $evenement) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('evenements._form')

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Mettre à jour l'événement
                        </button>
                        <a href="{{ url()->previous() ?? route('calendrier') }}" class="btn btn-secondary ms-2">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
