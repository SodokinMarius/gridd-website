<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            ProjectSeeder::class,
            GallerySeeder::class,
            NewsSeeder::class,
            JobPostingSeeder::class,
            HeroSlideSeeder::class,
            TeamMemberSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
