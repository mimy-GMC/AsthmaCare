<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptome extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'nom',
        'intensite',
        'declencheurs',
        'commentaires',
        'user_id' // important pour lier l'utilisateur à ses symptômes
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'nom'         => 'string',
        'intensite' => 'integer',
        'declencheurs' => 'array', // pour gérer le champ JSON comme tableau
    ];

    // Scope pour récupérer les symptômes sévères
    public function scopeSevere($query)
    {
        return $query->where('intensite', '>=', 7);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
