<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'first_name' => 'Marie',
                'last_name' => 'Kouassi',
                'position' => 'Directrice de programme',
                'content' => "L'équipe de GRIDD a mené notre étude d'impact avec une rigueur et une réactivité rares dans la sous-région.",
                'order' => 1,
            ],
            [
                'first_name' => 'Ibrahim',
                'last_name' => 'Traoré',
                'position' => 'Chef de projet infrastructures',
                'content' => "Un accompagnement sérieux, de la conception à la réception des travaux. Nous recommandons GRIDD sans hésiter.",
                'order' => 2,
            ],
            [
                'first_name' => 'Sophie',
                'last_name' => 'Adjanohoun',
                'position' => 'Responsable environnement',
                'content' => "Une expertise multidisciplinaire précieuse pour sécuriser la conformité environnementale de nos projets.",
                'order' => 3,
            ],
        ];

        $seedImages = $this->seedImages();

        foreach ($items as $index => $data) {
            if (Testimonial::where('first_name', $data['first_name'])->where('last_name', $data['last_name'])->exists()) {
                continue;
            }

            $photo = null;
            if (isset($seedImages[$index])) {
                $photo = 'testimonials/'.basename($seedImages[$index]);
                if (! Storage::disk('public')->exists($photo)) {
                    Storage::disk('public')->put($photo, file_get_contents($seedImages[$index]));
                }
            }

            Testimonial::create($data + [
                'photo' => $photo,
                'is_published' => true,
            ]);
        }
    }

    private function seedImages(): array
    {
        $fromSeed = glob(base_path('storage_seed_images/*.jpg')) ?: [];
        $fromStorage = glob(storage_path('app/public/gallery/*.jpg')) ?: [];

        return array_values(array_unique(array_merge($fromSeed, $fromStorage)));
    }
}
