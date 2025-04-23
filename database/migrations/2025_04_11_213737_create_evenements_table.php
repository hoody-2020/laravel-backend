<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id(); // Colonne ID (clé primaire, auto-incrément)
            $table->string('categorie'); // Colonne pour la catégorie (texte court) 
            $table->string('titre'); // Colonne pour le titre (texte court)
            $table->string('club_organisateur'); // Colonne pour le nom du club (texte court)
            $table->dateTime('date_heure'); // Colonne pour la date ET l'heure
            $table->string('type'); // Colonne pour le type (présentiel, en ligne...)
            $table->text('description'); // Colonne pour la description (texte long),
            $table->text('programme'); // Colonne pour programme  (texte long),
            $table->string('lieu')->nullable(); // Colonne pour le lieu (texte court), peut être vide
            $table->string('lien_inscription')->nullable(); // Colonne pour le lien (texte court), peut être vide
            $table->timestamps(); // Crée automatiquement les colonnes `created_at` et `updated_at`
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
