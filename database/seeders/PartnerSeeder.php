<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        if (Partner::exists()) {
            return;
        }

        foreach (config('partners', []) as $index => $partner) {
            Partner::create([
                'name' => $partner['nom'],
                'logo' => isset($partner['logo']) && file_exists(public_path($partner['logo'])) ? $partner['logo'] : null,
                'url' => $partner['lien'] ?? null,
                'order' => $index + 1,
                'is_published' => true,
            ]);
        }
    }
}
