<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conseil extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie',
        'contenu',
        'niveau_alerte',
        'user_id'
    ];

    protected $casts = [
        'niveau_alerte' => 'integer',
    ];

    // Accessor pour la couleur
    public function getCouleurAttribute()
    {
        return match(true) {
            $this->niveau_alerte <= 1 => 'vert',
            $this->niveau_alerte <= 3 => 'jaune',
            $this->niveau_alerte <= 5 => 'orange',
            default => 'rouge'
        };
    }

    // Scope pour filtrer par niveau d'alerte
    public function scopeParNiveau($query, $niveau)
    {
        return $query->where('niveau_alerte', $niveau);
    }

    // Scope pour filtrer par niveau minimum
    public function scopeAlerteMin($query, $min)
    {
        return $query->where('niveau_alerte', '>=', $min);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}