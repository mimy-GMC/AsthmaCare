<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptome extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'intensite',
        'declencheurs',
        'commentaires',
        'user_id' // important pour lier l'utilisateur à ses symptômes
    ];

    protected $casts = [
        'declencheurs' => 'array', // pour gérer le champ JSON comme tableau
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
