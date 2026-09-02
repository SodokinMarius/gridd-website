<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => "Étude d'impact environnemental et social — Corridor routier",
                'country' => 'Bénin',
                'client' => "Ministère du Cadre de Vie",
                'year' => 2024,
                'description' => "Réalisation de l'étude d'impact environnemental et social préalable à la réhabilitation d'un corridor routier, incluant la consultation des populations riveraines et l'élaboration du plan de gestion environnementale et sociale.",
            ],
            [
                'title' => "Surveillance environnementale de chantier",
                'country' => 'Togo',
                'client' => "Entreprise de BTP",
                'year' => 2023,
                'description' => "Mission de surveillance environnementale continue durant les travaux de construction, avec suivi de la qualité de l'air, du bruit et de la gestion des déchets de chantier.",
            ],
            [
                'title' => "Élaboration d'un plan de gestion des catastrophes",
                'country' => "Côte d'Ivoire",
                'client' => "Collectivité territoriale",
                'year' => 2023,
                'description' => "Élaboration d'un plan d'intervention d'urgence et de gestion des catastrophes pour une collectivité exposée aux risques d'inondation.",
            ],
            [
                'title' => "Audit de conformité environnementale et sociale",
                'country' => 'Bénin',
                'client' => "Industrie agroalimentaire",
                'year' => 2022,
                'description' => "Audit de conformité réglementaire environnementale et sociale d'un site industriel, avec recommandations de mise à niveau.",
            ],
        ];

        $seedImages = glob(base_path('storage_seed_images/*.jpg'));

        foreach ($projects as $data) {
            $project = Project::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                $data + ['slug' => Str::slug($data['title']), 'is_published' => true]
            );

            if ($project->images()->count() === 0 && $seedImages) {
                $image = $seedImages[array_rand($seedImages)];
                $path = 'projects/'.Str::random(12).'.jpg';
                Storage::disk('public')->put($path, file_get_contents($image));
                $project->images()->create(['path' => $path, 'order' => 1]);
            }
        }
    }
}
