<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conseil;

class ConseilSeeder extends Seeder
{
    public function run(): void
    {
        $conseils = [
            // Conseils pour qualité d'air bonne
            [
                'categorie' => 'Qualité Air',
                'contenu' => 'Profitez de l\'air extérieur pour vos activités. Idéal pour les exercices respiratoires.',
                'niveau_alerte' => 1
            ],
            [
                'categorie' => 'Activité Physique',
                'contenu' => 'Conditions parfaites pour la marche ou le jogging en extérieur.',
                'niveau_alerte' => 1
            ],
            
            // Conseils pour qualité d'air modérée
            [
                'categorie' => 'Prévention',
                'contenu' => 'Les personnes sensibles peuvent ressentir une gêne légère. Ayez votre inhalateur à portée de main.',
                'niveau_alerte' => 3
            ],
            
            // Conseils pour qualité d'air mauvaise
            [
                'categorie' => 'Urgence',
                'contenu' => 'Évitez les activités extérieures. Restez dans des espaces bien ventilés avec purificateur d\'air.',
                'niveau_alerte' => 5
            ],
            [
                'categorie' => 'Médication',
                'contenu' => 'Suivez scrupuleusement votre plan d\'action contre l\'asthme. Contactez votre médecin si les symptômes persistent.',
                'niveau_alerte' => 5
            ]
        ];

        foreach ($conseils as $conseil) {
            Conseil::create($conseil);
        }
    }
}