<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['first_name' => 'Innocent', 'last_name' => 'AKPACA', 'position' => 'Directeur Général', 'order' => 1, 'linkedin_url' => 'https://www.linkedin.com/in/innocent-akpaca-51b028280/', 'whatsapp_url' => 'https://wa.me/2290196425383'],
            ['first_name' => 'Aminata', 'last_name' => 'Diallo', 'position' => 'Responsable Études Environnementales', 'order' => 2],
            ['first_name' => 'Germain', 'last_name' => 'NAGONOU', 'position' => 'Directeur Technique', 'order' => 3, 'linkedin_url' => 'https://www.linkedin.com/in/germain-nagonou-a1a75a26b', 'whatsapp_url' => 'https://wa.me/2290197847948'],
            ['first_name' => 'Fatou', 'last_name' => 'Sow', 'position' => 'Ingénieure SIG & Cartographie', 'order' => 4],
        ];

        $seedImages = $this->seedImages();

        foreach ($members as $index => $data) {
            if (TeamMember::where('first_name', $data['first_name'])->where('last_name', $data['last_name'])->exists()) {
                continue;
            }

            $photo = null;
            if (isset($seedImages[$index])) {
                $photo = 'team/'.basename($seedImages[$index]);
                if (! Storage::disk('public')->exists($photo)) {
                    Storage::disk('public')->put($photo, file_get_contents($seedImages[$index]));
                }
            }

            TeamMember::create($data + [
                'photo' => $photo,
                'linkedin_url' => 'https://linkedin.com',
                'whatsapp_url' => 'https://wa.me/22900000000',
                'is_published' => true,
            ]);
        }
    }

    private function seedImages(): array
    {
        $fromSeed = glob(base_path('storage_seed_images/*.jpg')) ?: [];
        $fromStorage = glob(storage_path('app/public/projects/*.jpg')) ?: [];

        return array_values(array_unique(array_merge($fromSeed, $fromStorage)));
    }
}
