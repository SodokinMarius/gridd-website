<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $seedImages = glob(base_path('storage_seed_images/*.jpg'));

        if (! $seedImages || GalleryImage::count() > 0) {
            return;
        }

        $categories = ['equipement', 'mission', 'chantier'];

        foreach ($seedImages as $i => $image) {
            $path = 'gallery/'.Str::random(12).'.jpg';
            Storage::disk('public')->put($path, file_get_contents($image));

            GalleryImage::create([
                'path' => $path,
                'category' => $categories[$i % count($categories)],
                'order' => $i + 1,
                'is_published' => true,
            ]);
        }
    }
}
