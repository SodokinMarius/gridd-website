<?php

namespace Database\Seeders;

use App\Models\JobPosting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobPostingSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Ingénieur environnementaliste',
                'contract_type' => 'CDI',
                'location' => 'Cotonou, Bénin',
                'description' => "GRIDD Consulting et Services recrute un(e) ingénieur(e) environnementaliste pour renforcer son pôle Études et Audits. Profil recherché : Bac+5 en sciences de l'environnement, 3 ans d'expérience minimum en EIES.",
                'deadline' => now()->addDays(30)->toDateString(),
            ],
            [
                'title' => 'Consultant(e) en maîtrise d\'œuvre',
                'contract_type' => 'Consultance',
                'location' => 'Bénin / sous-région',
                'description' => "Mission de consultance pour l'accompagnement de projets d'infrastructures, de la conception à la réception des travaux.",
                'deadline' => now()->addDays(45)->toDateString(),
            ],
        ];

        foreach ($items as $data) {
            JobPosting::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                $data + ['slug' => Str::slug($data['title']), 'is_published' => true]
            );
        }
    }
}
