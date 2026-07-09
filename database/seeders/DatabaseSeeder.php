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
            \Modules\About\Database\Seeders\AboutSeeder::class,
            \Modules\Testimonial\Database\Seeders\TestimonialSeeder::class,
            \Modules\Setting\Database\Seeders\SettingSeeder::class,
            \Modules\Faq\Database\Seeders\FaqSeeder::class,
        ]);
    }
}
