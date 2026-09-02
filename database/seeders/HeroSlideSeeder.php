<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        if (HeroSlide::exists()) {
            return;
        }

        $slides = [
            [
                'eyebrow' => "Bureau d'études — Bénin & Afrique de l'Ouest",
                'title' => "Nous mesurons le terrain pour construire l'avenir durable.",
                'subtitle' => 'GRIDD Consulting et Services accompagne institutions, entreprises et collectivités dans leurs évaluations environnementales et sociales.',
                'button_text' => 'Découvrir nos services',
                'button_url' => '/services',
                'order' => 1,
            ],
            [
                'eyebrow' => 'Expertise multidisciplinaire',
                'title' => "Des études rigoureuses au service du développement durable.",
                'subtitle' => 'Évaluations environnementales et sociales, maîtrise d\'œuvre et exécution de travaux depuis 2022.',
                'button_text' => 'Voir nos réalisations',
                'button_url' => '/realisations',
                'order' => 2,
            ],
            [
                'eyebrow' => 'Afrique de l\'Ouest',
                'title' => "Un partenaire de confiance pour vos projets d'infrastructure.",
                'subtitle' => 'Plus de 40 projets réalisés dans 5 pays, avec une équipe de 20 experts mobilisables.',
                'button_text' => 'Nous contacter',
                'button_url' => '/contact',
                'order' => 3,
            ],
        ];

        $images = $this->seedImages();

        foreach ($slides as $index => $data) {
            $imagePath = null;
            if (isset($images[$index])) {
                $imagePath = 'hero/'.Str::random(12).'.jpg';
                Storage::disk('public')->put($imagePath, file_get_contents($images[$index]));
            }

            HeroSlide::create($data + [
                'image' => $imagePath ?? 'hero/default.jpg',
                'is_published' => true,
            ]);
        }
    }

    private function seedImages(): array
    {
        $fromSeed = glob(base_path('storage_seed_images/*.jpg')) ?: [];
        $fromProjects = glob(storage_path('app/public/projects/*.jpg')) ?: [];
        $fromGallery = glob(storage_path('app/public/gallery/*.jpg')) ?: [];

        return array_values(array_unique(array_merge($fromProjects, $fromGallery, $fromSeed)));
    }
}
