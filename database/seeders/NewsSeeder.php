<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => "GRIDD Consulting et Services participe à la Semaine Nationale de l'Environnement",
                'content' => "L'équipe de GRIDD a pris part à la Semaine Nationale de l'Environnement, l'occasion d'échanger avec d'autres acteurs du secteur sur les enjeux de développement durable au Bénin.",
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => "Signature d'un nouveau partenariat pour l'accompagnement des collectivités",
                'content' => "GRIDD Consulting et Services renforce son accompagnement des collectivités territoriales à travers un nouveau partenariat technique dédié à la gestion environnementale des projets d'infrastructures.",
                'published_at' => now()->subDays(30),
            ],
            [
                'title' => "Lancement d'une mission de surveillance environnementale au Togo",
                'content' => "Une nouvelle mission de surveillance environnementale de chantier démarre au Togo, confirmant le rayonnement sous-régional de GRIDD Consulting et Services.",
                'published_at' => now()->subDays(60),
            ],
        ];

        $seedImages = glob(base_path('storage_seed_images/*.jpg')) ?: [];

        foreach ($items as $index => $data) {
            $news = News::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                $data + ['slug' => Str::slug($data['title']), 'is_published' => true]
            );

            if (! $news->cover_image && isset($seedImages[$index])) {
                $coverPath = 'news/'.Str::random(12).'.jpg';
                Storage::disk('public')->put($coverPath, file_get_contents($seedImages[$index]));
                $news->update(['cover_image' => $coverPath]);
            }
        }
    }
}
