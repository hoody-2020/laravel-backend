<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie',
        'titre',
        'club_organisateur',
        'date_heure',
        'type',
        'description', 
        'programme',   
        'lieu',
        'lien_inscription',
        'image_path',
    ];

    protected $casts = [
        'date_heure' => 'datetime', // Très utile pour les dates
    ];
}
