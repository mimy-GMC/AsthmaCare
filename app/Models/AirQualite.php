<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirQualite extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_mesure',
        'aqi',
        'pollen',
        'pm2_5',
        'pm10',
        'localite',
    ];

    // Accesseur personnalisé pour l'interprétation de l'AQI
    public function getNiveauAqiAttribute()
    {
        return match (true) {
            $this->aqi <= 50 => 'Bon',
            $this->aqi <= 100 => 'Modéré',
            $this->aqi <= 150 => 'Malsain pour les groupes sensibles',
            $this->aqi <= 200 => 'Malsain',
            $this->aqi <= 300 => 'Très malsain',
            default => 'Dangereux'
        };
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
