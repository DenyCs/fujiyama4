<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            \Modules\Menu\Database\Seeders\MenuDatabaseSeeder::class,
            \Modules\Setting\Database\Seeders\SettingSeeder::class,
            \Modules\Setting\Database\Seeders\SocialLinkSeeder::class,
            \Modules\Banner\Database\Seeders\BannerDatabaseSeeder::class,
            \Modules\About\Database\Seeders\GalleryCategorySeeder::class,
            \Modules\About\Database\Seeders\AboutSeeder::class,
            \Modules\Event\Database\Seeders\EventDatabaseSeeder::class,
            \Modules\Testimonial\Database\Seeders\TestimonialSeeder::class,
            \Modules\Faq\Database\Seeders\FaqSeeder::class,
            \Modules\SectionContent\Database\Seeders\SectionContentSeeder::class,
        ]);
    }
}